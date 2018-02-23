<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ObjectType;
use Validator;
use App\Phone;
use App\User;
use DB;
use Hash;
use App\Organisation;

class UsersController extends Controller
{

    /**
     * display advocates list page
     */
    public function advocates()
    {
        $users = DB::table('users')
        ->join('object_types', 'users.user_type_id', '=', 'object_types.id')
        ->leftJoin('organisations', 'users.organisation_id', '=', 'organisations.id')
        ->where([
            ['object_types.type', '=', 'user'],
            ['object_types.value', '=', 'advocate'],
        ])
        ->select([
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.slug as slug',
            'users.email as email',
            'users.verified as verified',
            'users.banned as banned',
            'organisations.id as organisation_id',
            'organisations.name as organisation_name',
            'organisations.slug as organisation_slug'
        ])
        ->paginate(10);
        
        return view('admin.users.advocates.list', compact('users'));
    }

    /**
     * display advocates list page
     */
    public function shelters()
    {
        $users = DB::table('users')
        ->join('object_types', 'users.user_type_id', '=', 'object_types.id')
        ->leftJoin('organisations', 'users.organisation_id', '=', 'organisations.id')
        ->where([
            ['object_types.type', '=', 'user'],
            ['object_types.value', '=', 'shelter'],
        ])
        ->select([
            'users.id as id',
            'users.first_name as first_name',
            'users.last_name as last_name',
            'users.slug as slug',
            'users.email as email',
            'users.verified as verified',
            'users.banned as banned',
            'organisations.id as organisation_id',
            'organisations.name as organisation_name',
            'organisations.slug as organisation_slug'
        ])
        ->paginate(10);
        
        return view('admin.users.shelters.list', compact('users'));
    }

    /**
     * display add user page (form)
     */
    public function add()
    {
        $userTypes = DB::table('object_types')->where('type', 'user')->get();

        $organisations = DB::table('organisations')
        ->select([
            'organisations.name as name', 
            'organisations.id as id'
        ])
        ->get();
        
        return view('admin.users.user.add_user', compact('userTypes', 'organisations'));
    }

    /**
     * Submit add user page (form)
     */
    public function addSubmit(Request $request)
    {
        //validate data from form
        $validator = Validator::make($request->all(),[
            'first_name'        => 'required|string|max:25',
            'last_name'         => 'required|string|max:25',                         
            'user_type'         => 'required|exists:object_types,id',
            'email'             => 'required|email|max:255|unique:users,email',
            'phone'             => 'required|regex:/^\d{3}\d{3}\d{4}$/',
            'password'          => 'required|string|min:6|max:40',
            'repeat-password'   => 'required|same:password',
            'organisation'      => 'required|exists:organisations,id'
        ]);

        if (!($validator->fails())){

            //check if user type fits organisation type
            $userType = ObjectType::where([
                ['id', '=', $request->user_type],
                ['type', '=', 'user']
            ])->first();

            // get organisation data
            $organisation = Organisation::where('id', $request->organisation)->first();

            $organisationType = ObjectType::where([
                ['id', '=', $organisation->org_type_id],
                ['type', '=', 'organisation']
            ])->first();

            if($userType['value'] == $organisationType['value']) {
                
                //save user info
                $user = new User();
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->slug = str_slug($request->first_name . ' ' . $request->last_name, '-');
                $user->user_type_id = $userType->id;
                $user->organisation_id = $request->organisation;
                $user->verified = 1;
                $user->banned = 1;
                $user->email = $request->email;
                
                //save password
                $user->password = Hash::make($request->password);

                $user->save();

                //save user phone
                $userPhoneType = ObjectType::where([
                    ['type', '=', 'phone'],
                    ['value', '=', 'office']                        
                ])->first();

                $userPhone = new Phone();
                $userPhone->entity_type = 'user';
                $userPhone->entity_id = $user->id;
                $userPhone->number = $request->phone;
                $userPhone->phone_type_id = $userPhoneType->id;
                $userPhone->save();
                
                // redirect to user edit page with success message
                return redirect()
                    ->route('admin.user.edit.general.page', [
                        'id' => $user->id,
                        'slug' => $user->slug
                    ])
                    ->with('success', 'User account successfully created!');
            } else {
                return redirect()->back()->with('error', 'User type and Organisation type must match!');
            }            
        }  

        // invalid entries
        return redirect()->back()->withErrors($validator)->withInput();
        
        
    } 

}
