<?php

namespace App\Imports;

use App\Models\Categorize;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportCategorize implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Categorize([
            'cat_name'=>$row('cat_name'),
            'cat_descript'=>$row('cat_descript'),
        ]);
    }
}
