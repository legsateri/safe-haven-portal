<?php

namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Code\UserObject;
use App\Phone;
use App\Address;
use App\State;
use App\User;
use App\ObjectType;
use Validator;
use Hash;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }


    /**
     * user account page
     */
    public function index()
    {
        $currentUser = UserObject::get(Auth::user()->email, 'email');

        $userPhone = Phone::where([
            ['entity_type', '=', 'user'],
            ['entity_id', '=', $currentUser->id]
        ])->first();

        $userAddress = Address::where([
            ['entity_type', '=', 'user'],
            ['entity_id', '=', $currentUser->id]
        ])->first();

        $states = State::all();

        $phoneTypes = ObjectType::where('type', 'phone')->get();
        
        return view('auth.shared.userAccount', compact('currentUser', 'userPhone', 'userAddress', 'states', 'phoneTypes'));
    }

    /**
     *  UPDATING ACCOUNT INFO
     */

    public function updateInfo(Request $request){

            //validate data from form
            $validator = Validator::make($request->all(),[          
            'first_name'        => 'required|max:255',
            'last_name'         => 'required|max:255',                         
            'email'             => 'required|email|max:255',
            'phone_number'      => 'required|max:10',
            'phone_number_type' => 'nullable',
            'street'            => 'nullable|max:255',
            'city'              => 'nullable|max:255',
            'zip_code'          => 'nullable|integer',
            'state'             => 'nullable',

            ]);
            
            if (!($validator->fails()))                               
            {   
                // die('Proslo');

                //find user's account
                $user = User::where('id', Auth()->user()->id)->first();

                //check if email from request allready exists for some other user
                $check_email = User::where('email', $request->email)->first();
                
                if($check_email == null || ($check_email != null && $check_email->id == $user->id)) 
                {
                    //update user's info
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->email = $request->email;
                    $user->update();

                    //update user's phone
                    $user_phone = Phone::where([
                        ['entity_type', '=', 'user'],
                        ['entity_id', '=', $user->id]
                    ])->first();

                    if ($user_phone){
                        $user_phone->number = $request->phone_number;
                        $user_phone->phone_type_id = $request->phone_number_type;
                        $user_phone->update();
                    } else {
                        $user_phone = new Phone();
                        $user_phone->entity_type = 'user';
                        $user_phone->entity_id = $user->id;
                        $user_phone->number = $request->phone_number;
                        $user_phone->phone_type_id = $request->phone_number_type;
                        $user_phone->save();
                    }
                                       
                    $address_type = ObjectType::where([
                        ['type', '=', 'address'],
                        ['value', '=', 'office']                        
                    ])->first();

                    //update user's address
                    $user_address = Address::where([
                        ['entity_type', '=', 'user'],
                        ['entity_id', '=', $user->id]
                    ])->first();

                    if(!isset($user_address->id)){
                        $user_address = new Address();
                        $user_address->entity_type = 'user';
                        $user_address->entity_id = $user->id;
                    }
                        $user_address->address_type_id = $address_type->id;
                        $user_address->street = $request->street;
                        $user_address->state = $request->state;
                        $user_address->city = $request->city;
                        $user_address->zip_code = $request->zip_code;
                        $user_address->save();
                    
                    
                    return redirect()->back()->with('success', 'Account successfully updated!');

                } elseif ($check_user->id != $user->id) {
                    return redirect()->back()->with('error', 'User with this email address already exists!');
                }
            }
            // die('Nije proslo');
    }

    public function updatePassword(Request $request){

        //
        $validator = Validator::make($request->all(), [
            'old_password'  =>  'required|string|min:6|max:40',
            'new_password'  =>  'required|string|min:6|max:40',
            'repeat_new_password' =>  'required|same:new_password',
        ]);

        if (!($validator->fails()))
        {
            // find user's account
            $user = User::where('id', Auth()->user()->id)->first();

            // check if old password is valid
            if (Hash::check($request->old_password, $user->password))
            {                  
                // update database
                $hashed = Hash::make($request->new_password);
                $user->password = $hashed;
                $user->update();
                
                return redirect()->back()->with('success', 'Password updated!');

            } else {
                // invalid old password
                return redirect()->back()->with('error', 'Invalid old password!');
            }
        }

        else 
        {
            // invalid entries in password fields
            $errors = $validator->errors();

            if ( $errors->first('old_password') != null ){
                return redirect()->back()->with('error', $errors->first('old_password'));
            }

            if ( $errors->first('new_password') != null ){
                return redirect()->back()->with('error', $errors->first('new_password'));
            }

            if ( $errors->first('repeat_new_password') != null ){
                return redirect()->back()->with('error', $errors->first('repeat_new_password'));
            }
        }
    }

}
