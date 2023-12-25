<?php

namespace Database\Seeders;

use App\Models\Ports;
use App\Models\Country;
use Illuminate\Database\Seeder;

class PortsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create(['name' => 'test', 'code' => 'test']);
        
        Ports::create(['name_ar' => 'port1 ', 'name_en' => 'port1 ','status' => 1,'country' => 'EG']);
        // Ports::create(['name' => 'port2' ,'status' => 1,'country_id' => 1,'shiping_mode_id' => 2,]);
        // Ports::create(['name' => 'port3' ,'status' => 1,'country_id' => 1,'shiping_mode_id' => 3,]);
    }
}
