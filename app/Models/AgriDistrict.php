<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgriDistrict extends Model
{
    use HasFactory; 
    protected $table= 'agri_districts';
    protected $fillable=[
        'users_id',
        'district',
        'description',
        'latitude',
        'longitude',

    ];
    public function Lastproduction()
    {
        return $this->hasMany(LastProductionDatas::class, 'agri_districts_id');
    }
    public function farmProfiles()
    {
        return $this->hasMany(FarmProfile::class, 'agri_districts_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id' )->withDefault();
    }
    public function categorizes()
    {
        return $this->hasMany(Categorize::class,'categorize_id','id' );
    }
    public function polygon()
    {
        return $this->hasOne(Polygon::class,'id','agri_districts_id' );
    }
    public function farmprofile()
    {
        return $this->hasOne(FarmProfile::class,'id','agri_districts_id' );
    }
     // Define the relationship with User
     public function users()
     {
         return $this->hasMany(User::class, 'agri_district_id');
     }
     public function barangay()
     {
         return $this->belongsTo(Barangay::class,'barangay_id','id' );
     }
}
