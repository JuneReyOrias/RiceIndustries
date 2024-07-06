<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $guard ="admin";


    protected $guarded=[];
     // define relationship with users
     public function users(){
        return $this->belongTo(User::class, 'id','users_id')->withDefault();
    }
}

