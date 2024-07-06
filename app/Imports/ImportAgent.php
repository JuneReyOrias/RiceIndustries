<?php

namespace App\Imports;

use App\Models\Agent;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportAgent implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Agent([
            'first_name'=> $row('first_name'),
            'last_name'=> $row('last_name'),
            'id_number'=> $row('id_number'),
            'districts'=> $row('districts'),
            'role'=> $row('role'),
            'password'=> $row('password'),
        ]);
    }
}
