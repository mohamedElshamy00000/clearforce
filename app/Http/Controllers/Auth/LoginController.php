<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = "/dashboard";  // RouteServiceProvider::HOME;

    public function redirectTo() {
        if (Auth::user()->hasRole('admin')) {
            return '/dashboard';
        } elseif(Auth::user()->hasRole('client')) {
            return '/dashboard/client';
        } elseif(Auth::user()->hasRole('agent')) {
            return '/dashboard/agent';
        } elseif(Auth::user()->hasRole('supervisor')) {
            return '/dashboard/supervisor';
        } else {
            return '/home'; 
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
