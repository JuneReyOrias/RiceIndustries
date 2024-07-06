<?php

namespace App\Imports;

use App\Models\MachineriesUsed;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportMachineriesUsed implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MachineriesUsed([
            'plowing_cost'=>$row['plowing_cost'],
            'harrowing_cost'=>$row['harrowing_cost'],
            'harvesting_cost'=>$row['harvesting_cost'],
            'post_harvest_cost'=>$row['post_harvest_cost'],
            'total_cost_for_machineries'=>$row['total_cost_for_machineries'],
            
        ]);
    }
}
