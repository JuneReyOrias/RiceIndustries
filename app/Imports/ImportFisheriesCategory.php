<?php

namespace App\Imports;

use App\Models\FisheriesCategory;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportFisheriesCategory implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FisheriesCategory([
            //
        ]);
    }
}
