<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerOrg extends Model
{
    use HasFactory;
    protected $table= 'farmer_organization';


    public function agridistrict()
    {
        return $this->hasMany(FarmProfile::class, 'personal_informations_id');
    }
}
