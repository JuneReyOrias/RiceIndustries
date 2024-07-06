<?php

namespace App\Imports;

use App\Models\FixedCost;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

// class ImportFixedCost implements ToModel, WithHeadingRow
// {
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */




//     public function model(array $row)
//     {
      
//         // Log or dump $row to inspect its contents
//     Log::info($row); // Requires importing the Log facade: use Illuminate\Support\Facades\Log;
//     dd($row); // Use this to immediately halt execution and inspect $row

//     return [
//         'no_of_ha' => $row['no_of_ha'],
//         'cost_per_ha' => $row['cost_per_ha'],
//         'total_amount' => $row['total_amount'],
//         // Add other fields as needed
//     ];
// }
// }