<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Ports;
use Ramsey\Uuid\Uuid;
use App\Models\HsCode;
use App\Models\Company;
use App\Models\Country;
use App\Models\Project;

use App\Models\ProductType;
use App\Models\ShipingMode;
use Illuminate\Support\Carbon;
use App\Models\ProductFileType;
use Illuminate\Database\Seeder;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker       = Factory::create();
        // $ShipingMode = collect(ShipingMode::all()->modelKeys());
        // $port        = collect(Ports::all()->modelKeys());
        // $user        = collect(User::where('id', 4)->get()->modelKeys());
        // $company     = collect(Company::get()->modelKeys());

        // $type = ProductType::create([
        //     'name'   => 'food',
        //     'status' => 1,
        // ]);
        // $HsCode = HsCode::create([
        //     'hs_code'             => '0',
        //     'item_en'             => 'test HS code',
        //     'item_ar'             => 'test HS code',
        //     'duty'                => null,
        //     'procedures'          => null,
        //     'specific_details'    => null,
        //     'effective_date'      => Carbon::now(),
        //     'status'              => 1,
        // ]);
        // $country  = Country::create(['name' => 'test3','code' => 'EG',]);
        // $country2 = Country::create(['name' => 'test2','code' => 'EG',]);

        // $project  = Project::create([
        //     'type' => $type->id,
        //     'countryFrom' => $country->id,
        //     'countryTo'   =>  $country2->id,
        //     'arrivalDate' => Carbon::now(),
        //     'status' => 0,
        //     'Waybill' => 0023020302323,
        //     'user_id' => $user->random(),
        //     'port_id' => $port->random(),
        //     'shiping_mode_id' => $ShipingMode->random(),
        //     'hs_code_id' => $HsCode->id,
        //     'company_id' => $company->random(),
        //     // 'shiping_mode_id' => $ShipingMode->random(),
        // ]);
        // $project->hscodes()->sync($HsCode->id);

        $FileType1  = ProductFileType::create(['name_en' => 'Bill of lading','name_ar' => 'بوليصة الشحن']);
        $FileType2  = ProductFileType::create(['name_en' => 'Commercial invoice','name_ar' => 'الفاتورة التجارية ']);
        $FileType3  = ProductFileType::create(['name_en' => 'Certificate of Origin','name_ar' => 'شهادة المنشأ']);
        $FileType4  = ProductFileType::create(['name_en' => 'Saber certificate','name_ar' => 'شهادة سابر']);
        $FileType5  = ProductFileType::create(['name_en' => 'Food and Drug Administration request','name_ar' => 'طلب هيئة الغذاء و الدواء']);
        $FileType6  = ProductFileType::create(['name_en' => 'Exemption decision','name_ar' => 'قرار إعفاء']);
        $FileType7  = ProductFileType::create(['name_en' => 'Chemical Fasah','name_ar' => 'فسح كيميائي']);

    }
}
