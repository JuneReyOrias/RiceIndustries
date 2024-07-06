<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fertilizer extends Model
{
    use HasFactory;
    protected $table="fertilizers";
    protected $fillable=[
        'name_of_fertilizer',
        'type_of_fertilizer',
        'no_ofsacks',
        'unitprice_per_sacks',
        'total_cost_fertilizers',
        'users_id',
        'personal_informations_id',
        'farm_profiles_id',
    ];

     public function variablecosts(){
        return$this->hasMany(VariableCost::class, 'fertilizers_id');
    }
}
