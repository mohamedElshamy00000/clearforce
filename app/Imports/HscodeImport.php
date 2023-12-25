<?php

namespace App\Imports;

use App\Models\HsCode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class HscodeImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HsCode([
            'hs_code'        => $row['hs_code'],
            'item_ar'        => $row['item_ar'],
            'item_en'        => $row['item_en'],
            'duty'           => $row['duty'],
            'procedures'     => $row['procedures'],
            'effective_date' => $row['effective_date'],
        ]);
    }
    public function rules(): array
    {
        return [
            'hs_code' => 'required|unique:hs_codes',
        ];
    }

}
