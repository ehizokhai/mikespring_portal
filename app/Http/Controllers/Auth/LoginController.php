<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function username(){
        $loginType = request()->input('reg_no');
        $this->reg_no = filter_var($loginType, FILTER_VALIDATE_EMAIL) ? 'email' : 'reg_no';
        request()->merge([$this->reg_no => $loginType]);
        return property_exists($this, 'reg_no') ? $this->reg_no : 'email';
    }

    public function redirectTo(){
        
        // User role
        $role = Auth::user()->role->id; 
        
        // Check user role
        switch ($role) {
            case 4:
                    return '/dashboard';
                break;
            case 3:
                    return '/student/home';
                break; 
            default:
                    return '/login'; 
                break;
        }
    }
}


