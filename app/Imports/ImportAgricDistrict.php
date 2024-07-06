<?php

namespace App\Imports;

use App\Models\AgricDistrict;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportAgricDistrict implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new AgricDistrict([
            'district'=> $row['district'],
            'description'=> $row['description'],
        ]);
    }
}
