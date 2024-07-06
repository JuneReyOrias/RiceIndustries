<?php

namespace App\Imports;

use App\Models\Fertilizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportFertilizer implements ToModel,WithHeadingRow
{
    // /**
    // * @param array $row
    // *
    // * @return \Illuminate\Database\Eloquent\Model|null
    // */
    // public function model(array $row)
    // {
    //     return new Fertilizer([
    //         'no_ofsacks'=>$row ['no_ofsacks'],
    //         'unitprice_per_sacks'=>$row ['unitprice_per_sacks'],
    //         'total_cost_fertilizers'=> $row ['total_cost_fertilizers'],
    //     ]);
    // }
    protected $personalInformationId;
    protected $farmProfileId;
        private $fertilizerModel;
    public function __construct($personalInformationId, $farmProfileId)
    {
        $this->personalInformationId = $personalInformationId;
        $this->farmProfileId = $farmProfileId;
    }


    public function model(array $row)
    {
        // Get the ID of the currently authenticated user
        $userId = Auth::id();
        // Find the user based on the retrieved ID
        $user = auth()->user();
        $agri_districts_id = $user->agri_districts_id;
        $agri_district = $user->agri_district;

        // Check if all required keys exist in the row
        $requiredKeys = ['no_ofsacks', 'unitprice_per_sacks', 'total_cost_fertilizers'];
        foreach ($requiredKeys as $key) {
            if (!isset($row[$key])) {
                Log::error("Undefined array key '$key'. Row: " . json_encode($row));
                return null; // Skip this row
            }
        }

        // Debug to check the state of data before creating FixedCost instance
        // dd([
        //     'users_id' => $userId,
            
        //     // 'personalInformationId' => $this->personalInformationId,
        //     'farmProfileId' => $this->farmProfileId,
        //     'row' => $row
        // ]);

        // Create or update FixedCost instance
       $this->fertilizerModel= Fertilizer::firstOrCreate([
            'personal_informations_id' => $this->personalInformationId,
            'users_id' => $userId,
        
         
        ], [
                     'no_ofsacks'=>$row ['no_ofsacks'],
                    'unitprice_per_sacks'=>$row ['unitprice_per_sacks'],
                    'total_cost_fertilizers'=>$row ['total_cost_fertilizers'],
                
                    'farm_profiles_id' => $this->farmProfileId,
        ]);
        $this->fertilizerModel->save();
    }

    public function getfertilizerId(){
        return $this->fertilizerModel->id;
    }
}
