<?php

namespace App\Imports;

use App\Models\Ports;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PortsImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ports([
            'name_ar'         => $row['name_ar'],
            'name_en'         => $row['name_en'],
            'shiping_mode_id' => null,
            'country_id'      => null,
            'country'         => $row['country_code'],
            'status'          => 1,
        ]);
    }
    public function rules(): array
    {
        return [
            // 'hs_code'               => 'required|unique:hs_codes',
        ];
    }
}
