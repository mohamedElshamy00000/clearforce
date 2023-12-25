<?php

namespace Database\Seeders;

use App\Models\ShipingMode;
use Illuminate\Database\Seeder;

class ShipingModeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShipingMode::create(['name' => 'Land','status' => 1,]);
        ShipingMode::create(['name' => 'Air','status' => 1,]);
        ShipingMode::create(['name' => 'Sea','status' => 1,]);
    }
}
