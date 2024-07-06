<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withHeadingRow;
class ImportUser implements ToModel,withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {  
        return new User([
            'name'=>$row['name'],
            'email'=>$row['email'],
            'agri_district'=>$row['agri_district'],
            'photo'=>$row['photo'],
            'password'=>$row['password'],
            'role'=>$row['role'],
            
        ]);
    }
}
