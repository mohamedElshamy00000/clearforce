<?php

namespace App\Imports;

use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CountryImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Country([
            'name'        => $row['name'],
            'code'        => $row['code'],
            'import'      => $row['import'],
            'export'      => $row['export'], 
            'status'      => $row['status'], 
        ]);
    }
    public function rules(): array
    {
        return [
            'name' => 'required|unique:countries',
            'code' => 'required|unique:countries',
        ];
    }
}
