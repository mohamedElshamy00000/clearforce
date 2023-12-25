<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectMillstone;

class MillestonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectMillstone::create(['name' => 'Delegation', 'status' => 1,]);
        ProjectMillstone::create(['name' => 'Write the Customs Delaration', 'status' => 1,]);
        ProjectMillstone::create(['name' => 'Editing the Customs Declaration', 'status' => 1,]);
        ProjectMillstone::create(['name' => 'Issuing a Customs Declaration', 'status' => 1,]);
        ProjectMillstone::create(['name' => 'Pay Bills', 'status' => 1,]);
    }
}
