<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // add roles
        $adminRole = Role::create([
            'name'          => 'admin',
            'display_name'  => 'administrator',
            'description'   => 'system administrator',
            'allowed_route' => 'dashboard',
        ]);

        $supervisorRole = Role::create([
            'name'          => 'supervisor',
            'display_name'  => 'supervisor',
            'description'   => 'system supervisor',
            'allowed_route' => 'dashboard',
        ]);

        $clientRole = Role::create([
            'name'          => 'client',
            'display_name'  => 'client',
            'description'   => 'system client',
            'allowed_route' => 'dashboard',
        ]);

        $clientEmployeeRole = Role::create([
            'name'          => 'cEmployee',
            'display_name'  => 'cEmployee',
            'description'   => 'cEmployee',
            'allowed_route' => 'dashboard',
        ]);

        $agentRole = Role::create([
            'name'          => 'agent',
            'display_name'  => 'agent',
            'description'   => 'system agent',
            'allowed_route' => 'dashboard',
        ]);

        // add users --------------------

        $admin = User::create([
            'name'              => 'mohamed elshamy',
            'email'             => 'mhamedelshamy48@gmail.com',
            'phone'             => '01062478951',
            'country'           => 'SA',
            'email_verified_at' => Carbon::now(),
            'password'          => bcrypt('password'),
            'status'            => 1,
            'type'              => 0,
            
        ]);
        $admin2 = User::create([
            'name'              => 'badr',
            'email'             => 'clearforce24@gmail.com',
            'phone'             => '+966569416821',
            'country'           => 'SA',
            'email_verified_at' => Carbon::now(),
            'password'          => bcrypt('password'),
            'status'            => 1,
            'type'              => 0,
            
        ]);
        // asign roles to users
        $admin->attachRole($adminRole);
        $admin2->attachRole($adminRole);

        $supervisor = User::create([

            'name'              => 'editor',
            'email'             => 'editor@clearforce.com',
            'phone'             => '002',
            'country'           => 'SA',
            'email_verified_at' => Carbon::now(),
            'password'          => bcrypt('password'),
            'status'            => 1,
            'type'              => 0,

        ]);

        // asign roles to users
        $supervisor->attachRole($supervisorRole);

        $client = User::create([

            'name'              => 'client',
            'email'             => 'client@clearforce.com',
            'phone'             => '001',
            'country'           => 'SA',
            'email_verified_at' => Carbon::now(),
            'password'          => bcrypt('password'),
            'status'            => 1,
            'type'              => 1,

        ]);
        $company = Company::create([
            'user_id' => $client->id,
            'name'  => 'company name',
            'industry' => 'food',
        ]);
        $company->users()->sync($client);
        // asign roles to users
        $client->attachRole($clientRole);


        $agent = User::create([

            'name'              => 'agent',
            'email'             => 'agent@clearforce.com',
            'phone'             => '004',
            'country'           => 'SA',
            'email_verified_at' => Carbon::now(),
            'password'          => bcrypt('password'),
            'status'            => 1,
            'type'              => 2,

        ]);

        // asign roles to users
        $agent->attachRole($agentRole);

    }
}
