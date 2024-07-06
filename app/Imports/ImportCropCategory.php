<?php

namespace App\Imports;

use App\Models\CropCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportCropCategory implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CropCategory([
           'crop_name'=>$row('crop_name'),
            'crop_descrIpt'=>$row('crop_descript'),
        ]);
    }
}
