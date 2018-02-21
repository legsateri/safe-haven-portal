<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Phone;
use App\Address;
use App\ObjectType;
use App\State;
use Validator;
use App\User;
use Hash;

class UserEditController extends Controller
{
    /**
     * display edit user page
     */
    public function editUserPage($id, $slug)
    {
        // get user data
        $user = DB::table('users')
        ->leftJoin('organisations', 'users.organisation_id', '=', 'organisations.id')
        ->where([
            ['users.id', '=', $id],
            ['users.slug', '=', $slug]
        ])
        ->select([
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.email as email',
            'users.slug as slug',
            'users.verified as verified',
            'users.banned as banned',
            'organisations.id as organisation_id',
            'organisations.name as organisation_name',
            'organisations.slug as organisation_slug'
        ])
        ->first();

        if ( !isset($user->id) )
        {
            // user not found, return error
            return "404 error<br>resource not found";
        }

        // get user phone
        $userPhone = Phone::where([
            ['entity_type', '=', 'user'],
            ['entity_id', '=', $user->id]
        ])->first();

        // get user address
        $userAddress = Address::where([
            ['entity_type', '=', 'user'],
            ['entity_id', '=', $user->id]
        ])->first();

        $organisations = DB::table('organisations')
        ->select([
            'organisations.name as name', 
            'organisations.id as id'
        ])
        ->get();

        $phoneTypes = ObjectType::where([
            ['type', '=', 'phone']
        ])->get();

        $addressTypes = ObjectType::where([
            ['type', '=', 'address']
        ])->get();

        $states = State::all();

        return  view('admin.users.user.edit_user', 
                compact('user', 'userPhone', 'userAddress', 'organisations', 'phoneTypes', 'addressTypes', 'states'));
    }


    /**
     * submit action
     * update user general information
     */
    public function submitGeneral($id, $slug, Request $request)
    {   
        //validate data from form
        $validator = Validator::make($request->all(),[
            'first_name'    => 'required|string|max:25',
            'last_name'     => 'required|string|max:25',
            'email'         => 'required|email|max:255',
            'organisation'  => 'exists:organisations,id'
        ]);
            
        if (!($validator->fails())){
            
            //find user to edit
            $user = User::where([
                ['id', '=', $id],
                ['slug', '=', $slug]
            ])->first();

            //check if email from request allready exists for some other user
            $checkEmail = User::where('email', $request->email)->first();
            
            if($checkEmail == null || ($checkEmail != null && $checkEmail->id == $user->id)){
                
                //update user
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->organisation_id = $request->organisation;
                //kada updateujemo tip organizacije moramo da updateujemo i tip usera

                $user->slug = str_slug($user['first_name'] . ' ' . $user['last_name'], '-');
                
                $user->update();

                return redirect()
                    ->route('admin.user.edit.page', ['id' => $user->id, 'slug' => $user->slug])
                    ->with('success-general', ' General information successfully changed!');

            } elseif ($checkEmail->id != $user->id) {
                return redirect()->back()->with('email-error-general', 'User with this email address already exists.');
            }
        }
        // invalid entries
        return redirect()->back()->withErrors($validator)->withInput();
    }


    /**
     * submit action
     * update user contact information
     */
    public function submitContact($id, $slug, Request $request)
    {  
        //validate data from form
        $validator = Validator::make($request->all(),[
            'phone_type'    => 'nullable|exists:object_types,id',
            'phone_number'  => 'required|regex:/^\d{3}\d{3}\d{4}$/',
            'address_type'  => 'nullable|exists:object_types,id',  
            'city'          => 'nullable|string|max:255',
            'zip_code'      => 'nullable|integer|regex:/^\d{5}$/',
            'street'        => 'nullable|string|max:255',
            'state'         => 'nullable|exists:states,id',             
        ]);
        
        if (!($validator->fails())){

            //find user to edit
            $user = User::where([
                ['id', '=', $id],
                ['slug', '=', $slug]
            ])->first();

            //update user's phone
            $userPhone = Phone::where([
                ['entity_type', '=', 'user'],
                ['entity_id', '=', $user->id]
            ])->first();

            if (!isset($userPhone->id)){
                $userPhone = new Phone();
                $userPhone->entity_type = 'user';
                $userPhone->entity_id = $user->id;
            } 
                $userPhone->number = $request->phone_number;
                $userPhone->phone_type_id = $request->phone_type;
                $userPhone->save();

            //update user's address
            $userAddress = Address::where([
                ['entity_type', '=', 'user'],
                ['entity_id', '=', $user->id]
            ])->first();

            $userState = State::where('id', $request->state)->first();
            
            if(!isset($userAddress->id)){
                $userAddress = new Address();
                $userAddress->entity_type = 'user';
                $userAddress->entity_id = $user->id;
            }
                $userAddress->address_type_id = $request->address_type;
                $userAddress->street = $request->street;
                $userAddress->state = $userState->name;
                $userAddress->city = $request->city;
                $userAddress->zip_code = $request->zip_code;
                $userAddress->save();
            
                return redirect()
                    ->route('admin.user.edit.page', ['id' => $user->id, 'slug' => $user->slug])
                    ->with('success-contact', ' Contact information successfully changed!');
        }
        
        // invalid entries
        return redirect()->back()->withErrors($validator)->withInput();
    }


    /**
     * submit action
     * reset user password
     */
    public function submitPassword($id, $slug, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password'  =>  'required|string|min:6|max:40',
            'new_password'  =>  'required|string|min:6|max:40',
            'repeat_new_password' =>  'required|same:new_password',
        ]);

        if (!($validator->fails()))
        {
            //find user to edit
             $user = User::where([
                ['id', '=', $id],
                ['slug', '=', $slug]
            ])->first();

            // check if old password is valid
            if (Hash::check($request->old_password, $user->password)){ 

                // update database
                $hashed = Hash::make($request->new_password);
                $user->password = $hashed;
                $user->update();
                
                return redirect()
                    ->route('admin.user.edit.page', ['id' => $user->id, 'slug' => $user->slug])
                    ->with('success-password', ' Password was successfully changed!');

            } else {
                // invalid old password
                return redirect()->back()->with('error-old-password', 'Invalid old password!');
            }
        } else {

            // invalid entries in password fields
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }


    /**
     * submit action
     * verify/unverify user email address
     */
    public function submitVerified($id, $slug, Request $request)
    {

    }


    /**
     * submit action
     * ban/unbun user
     */
    public function submitBan(Request $request)
    {

    }
}
