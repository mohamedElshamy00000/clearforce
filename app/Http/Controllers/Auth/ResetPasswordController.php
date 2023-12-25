<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = "/dashboard";
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
}
