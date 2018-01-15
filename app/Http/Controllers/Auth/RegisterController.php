<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;

use App\User;
use App\UserType;
use App\Organisation;
use App\OrganisationType;
use App\PhoneType;
use App\Phone;
use App\OrgHasPhone;


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
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'email' => 'required|string|email|max:45|unique:users',
            'password' => 'required|string|min:6|max:20|confirmed',

            'already_with_org' => 'nullable|in:on',
            'org_name' => 'nullable|max:40|required_without:already_with_org',
            'org_code' => 'nullable|required_with:already_with_org',
            'tax_id' => 'nullable|required_without:already_with_org|regex:/^\d{2}-\d{7}$/',
            'org_phone_number' => 'nullable|required_without:already_with_org|regex:/^\d{3}\d{3}\d{4}$/',
            
            'contact_phone_number' => 'required|regex:/^\d{3}\d{3}\d{4}$/',
            'sign_up_form_user_type' => 'required|in:advocate,shelter',
            'terms_of_use' => 'required|in:on',
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

        if ( !isset( $data['already_with_org'] ) )
        {
            // take organisation type
            $orgType = OrganisationType::where('org_type', $data['sign_up_form_user_type'])->first();

            // create new organisation entry
            $organisation = new Organisation();
            $organisation->name = $data['org_name'];
            $organisation->org_type_id = $orgType->org_id;
            $organisation->org_status_id = 1;
            $organisation->slug = str_slug($data['org_name'], '-');
            $organisation->tax_id = $data['tax_id'];
            $organisation->save();
            
            // get phone type id for office phone
            $phoneType = PhoneType::where('phone_type', 'office')->first();

            // save organisation phone number
            $orgPhone = new Phone();
            $orgPhone->phone_type_id = $phoneType->phone_type_id;
            $orgPhone->number = $data['org_phone_number'];
            $orgPhone->save();

            // add phone number to organisation
            OrgHasPhone::create([
                'organisation_id' => $organisation->id,
                'phone_id' => $orgPhone->id,
            ]);
        }

        // dd($data);

        // get user type
        $userType = UserType::where('type', $data['sign_up_form_user_type'])->first();

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


        // add user phone number to user
        

        return $user;
    }


}
