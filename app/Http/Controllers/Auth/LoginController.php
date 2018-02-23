<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }


    protected function authenticated(Request $request, $user)
    {
        if (!$user->verified) 
        {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email');
        }
        if ($user->banned == 1) 
        {
            auth()->logout();
            return back()->with('warning', 'Account is currently suspended, please contact Safe Haven Network administrator');
        }
        if ($user->organisation_id == "" || $user->organisation_id == null)
        {
            auth()->logout();
            return back()->with('warning', 'Account don\'t belong to any organzation, please contact your former organization or Safe Haven Network administrator');
        }
        else
        {
            $organisation = DB::table('organisations')
            ->join('statuses', 'organisations.org_status_id', '=', 'statuses.id')
            ->where([
                ['organisations.id', '=', $user->organisation_id]
            ])
            ->select('statuses.value as status')
            ->first();
            if ( $organisation->status != 'approved' )
            {
                auth()->logout();
                return back()->with('warning', 'Organization you belong is not active, please contact Safe Haven Network administrator');
            }
        }

        return redirect()->intended($this->redirectPath());
    }
 
}
