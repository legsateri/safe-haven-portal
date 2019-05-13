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
     * User account page.
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
     *  Update account info.
     */
    public function updateInfo(Request $request){

        //validate data from form
        $validator = Validator::make($request->all(),[          
        'first_name'        => 'required|string|max:25',
        'last_name'         => 'required|string|max:25',                         
        'email'             => 'required|string|email|max:45|unique:users,email,'.Auth()->user()->id.',id',
        'phone_number'      => 'required|regex:/^\d{3}-\d{3}-\d{4}$/',
        'phone_number_type' => 'nullable|exists:object_types,id',
        'street'            => 'nullable|string|max:255',
        'city'              => 'nullable|string|max:255',
        'zip_code'          => 'nullable|integer|regex:/^\d{5}$/',
        'state'             => 'nullable|exists:states,name',

        ]);
            
        if (!($validator->fails())){   
            // die('Proslo');

            //find user's account
            $user = User::where('id', Auth()->user()->id)->first();

            //check if email from request allready exists for some other user
            $checkEmail = User::where('email', $request->email)->first();
            
            if($checkEmail == null || ($checkEmail != null && $checkEmail->id == $user->id)){

                //update user's info
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->slug = str_slug($request->first_name . ' ' . $request->last_name, '-');
                $user->email = $request->email;
                $user->update();

                //update user's phone
                $userPhone = Phone::where([
                    ['entity_type', '=', 'user'],
                    ['entity_id', '=', $user->id]
                ])->first();

                if ($userPhone){
                    $userPhone->number = $request->phone_number;
                    $userPhone->phone_type_id = $request->phone_number_type;
                    $userPhone->update();
                } else {
                    $userPhone = new Phone();
                    $userPhone->entity_type = 'user';
                    $userPhone->entity_id = $user->id;
                    $userPhone->number = $request->phone_number;
                    $userPhone->phone_type_id = $request->phone_number_type;
                    $userPhone->save();
                }

                //update user's address
                $userAddress = Address::where([
                    ['entity_type', '=', 'user'],
                    ['entity_id', '=', $user->id]
                ])->first();
                
                $addressType = ObjectType::where([
                    ['type', '=', 'address'],
                    ['value', '=', 'office']                        
                ])->first();

                if(!isset($userAddress->id)){
                    $userAddress = new Address();
                    $userAddress->entity_type = 'user';
                    $userAddress->entity_id = $user->id;
                }
                    $userAddress->address_type_id = $addressType->id;
                    $userAddress->street = $request->street;
                    $userAddress->state = $request->state;
                    $userAddress->city = $request->city;
                    $userAddress->zip_code = $request->zip_code;
                    $userAddress->save();
                
                
                return redirect()->back()->with('success', 'Account successfully updated!');

            } elseif ($checkEmail->id != $user->id) {
                return redirect()->back()->with('error', 'User with this email address already exists!');
            }
        } 
        
        // invalid entries
        $errors = $validator->errors();

        return redirect()->back()->withErrors($validator)->withInput();
    
    }

    /**
     *  Update account password.
     */
    public function updatePassword(Request $request){

        //
        $validator = Validator::make($request->all(), [
            'old_password'  =>  'required|string|min:8|max:20',
            'new_password'  =>  'required|string|min:8|max:20|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
            'repeat_new_password' =>  'required|same:new_password',
        ]);

        if (!($validator->fails()))
        {
            // find user's account
            $user = User::where('id', Auth()->user()->id)->first();

            // check if old password is valid
            if (Hash::check($request->old_password, $user->password)){ 

                // update database
                $hashed = Hash::make($request->new_password);
                $user->password = $hashed;
                $user->update();
                
                return redirect()->back()->with('success', 'Password updated!');

            } else {
                // invalid old password
                return redirect()->back()->with('error', 'Invalid old password!');
            }
        } else {

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
