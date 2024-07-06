<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $table= 'barangay';


    public function agridistrict()
    {
        return $this->hasMany(FarmProfile::class, 'personal_informations_id');
    }
}
