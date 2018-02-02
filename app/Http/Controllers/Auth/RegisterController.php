<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;

use Mail;

use App\User;
use App\ObjectType;
use App\Organisation;
use App\Phone;
use App\VerifyUser;

use App\Mail\VerifyMail;

use App\Code\AppConfig;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        return Validator::make($data, [
            // uncomment latter
            //'g-recaptcha-response' => 'required|recaptcha',
            'first_name'        => 'required|string|max:25',
            'last_name'         => 'required|string|max:25',
            'email'             => 'required|string|email|max:45|unique:users',
            'password'          => 'required|string|min:6|max:20|confirmed',

            'already_with_org'  => 'nullable|in:on',
            'org_name'          => 'nullable|max:40|required_without:already_with_org',
            'organization_code' => 'nullable|required_with:already_with_org|exists:organisations,code',
            'tax_id'            => 'nullable|required_without:already_with_org|regex:/^\d{2}-\d{7}$/|unique:organisations',
            'org_phone_number'  => 'nullable|required_without:already_with_org|regex:/^\d{3}\d{3}\d{4}$/',

            'contact_phone_number'      => 'required|regex:/^\d{3}\d{3}\d{4}$/',
            'sign_up_form_user_type'    => 'required|in:advocate,shelter',
            'terms_of_use'              => 'required|in:on',
        ]);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        // get phone type for office phone
        $phoneType = ObjectType::where([
                        ['type', '=', 'phone'],
                        ['value', '=', 'office']
                    ])->first();
        
        // check does user belong to existing organisation
        // or create new organisation
        if ( !isset( $data['already_with_org'] ) )
        {
            /**
             * create new organisation
             */
        
            // take organisation type
            $orgType = ObjectType::where([
                        ['type', '=', 'organisation'],
                        ['value', '=', $data['sign_up_form_user_type']]
                    ])->first();

            // create new organisation entry
            $organisation = new Organisation();
            $organisation->name = $data['org_name'];
            $organisation->org_type_id = $orgType->id;
            $organisation->org_status_id = 1;
            $organisation->slug = str_slug($data['org_name'], '-');
            $organisation->tax_id = $data['tax_id'];
            $organisation->save();

            // save organisation phone number
            $orgPhone = new Phone();
            $orgPhone->entity_type = "organisation";
            $orgPhone->entity_id = $organisation->id;
            $orgPhone->phone_type_id = $phoneType->id;
            $orgPhone->number = $data['org_phone_number'];
            $orgPhone->save();

        }
        else
        {
            /**
             * take data for existing organisation
             * based on organisation code
             */
            $organisation = Organisation::where('code', $data['organization_code'])->first();
            
            // compare organisation type and desiered user type
            // if not same:  level user type to organisation type

            $orgType = ObjectType::where([
                            ['type', '=', 'organisation'],
                            ['id', '=', $organisation->org_type_id]
                        ])->first();

            if ( $data['sign_up_form_user_type'] != $orgType->value )
            {
                if ( in_array($orgType->value, [ 'advocate' ]) )
                {
                    $data['sign_up_form_user_type'] = 'advocate';
                }
                elseif( in_array($orgType->value, [ 'shelter', 'foster' ]) )
                {
                    $data['sign_up_form_user_type'] = 'shelter';
                }
            }
        }

        // get user type
        $userType = ObjectType::where([
                    ['type', '=', 'user'],
                    ['value', '=', $data['sign_up_form_user_type']]
                ])->first();


        // create user
        $user = new User();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->slug = str_slug($data['first_name'] . ' ' . $data['last_name'] , '-');
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->user_type_id = $userType->id;
        $user->organisation_id = $organisation->id;
        $user->save();


        // save user phone number
        $userPhone = new Phone();
        $userPhone->entity_type = "user";
        $userPhone->entity_id = $user->id;
        $userPhone->phone_type_id = $phoneType->id;
        $userPhone->number = $data['contact_phone_number'];
        $userPhone->save();

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);
 
        Mail::to($user->email)->send(new VerifyMail($user));

        return $user;
    }

     
    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }
    
        return redirect('/login')->with('status', $status);
    }


    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }

    public function showRegistrationForm()
    {
        $config = AppConfig::get();
        return view('auth.register', compact('config'));
    }


}
