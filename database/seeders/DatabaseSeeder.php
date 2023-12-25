<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RoleTableSeeder::class);
        $this->call(MillestonesTableSeeder::class);
        $this->call(ShipingModeTableSeeder::class);
        // $this->call(PortsTableSeeder::class);
        // $this->call(ProductTypeTableSeeder::class);
        $this->call(SettingSeeder::class);
        
    }
}
