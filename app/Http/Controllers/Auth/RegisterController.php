<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'    => ['required', 'numeric', 'unique:users'],
            'country'  => ['nullable', 'string'],
            'company'  => ['nullable', 'string'],
            'industry' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'country'  => $data['country'],
            'password' => Hash::make($data['password']),
        ]);

        // dd($role = Role::where('name', '=', 'client')->first());

        if ($data['type'] == 1) {
            $user->update(['type' => 1]);
            $role =  Role::where('name', '=', 'client')->first();  //choose the default role upon user creation.
            $company = Company::create([
                'user_id' => $user->id,
                'name'  => $data['company'],
                'industry' => $data['industry'],
            ]);
            $company->users()->sync($user);
        }elseif ($data['type'] == 2) {
            $user->update(['type' => 2]);
            $role =  Role::where('name', '=', 'agent')->first();  //choose the default role upon user creation.
        } else {
            $user->update(['type' => 1]);
            $role =  Role::where('name', '=', 'client')->first();  //choose the default role upon user creation.
            $company = Company::create([
                'user_id' => $user->id,
                'name'  => $data['company'],
                'industry' => $data['industry'],
            ]);
            $company->users()->sync($user);
        }
        $user->attachRole($role);

        // Notification::send($user, new WelcomeNotification);
        return $user;

    }
}
