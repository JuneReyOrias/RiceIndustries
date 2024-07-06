<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ricefield_boarders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('agri_districts_id')->nullable();
            $table->string('ricefield_name',50);
            $table->string('land_use',50);
            $table->string('zoning',50);
            $table->string('used_type',50);
            $table->string('lu_code',50);
            $table->string('zone_code',50);
            $table->double('area',15,6)->nullable();
            $table->string('location',50)->nullable();
            $table->string('soil_type',50)->nullable();
            $table->string('ricefield_description',100);
            $table->double('ricefieldone_latitude',15,8)->nullable();
            $table->double('ricefieldone_longitude',15,8)->nullable();
            $table->double('ricefieldtwo_latitude',15,8)->nullable();
            $table->double('ricefieldtwo_longitude',15,8)->nullable();
            $table->double('ricefieldthree_latitude',15,8)->nullable();
            $table->double('ricefieldthree_longitude',15,8)->nullable();
            $table->double('ricefieldfour_latitude',15,8)->nullable();
            $table->double('ricefieldfour_longitude',15,8)->nullable();
            $table->double('ricefieldfive_latitude',15,8)->nullable();
            $table->double('ricefieldfive_longitude',15,8)->nullable();
            $table->double('ricefieldsix_latitude',15,8)->nullable();
            $table->double('ricefieldsix_longitude',15,8)->nullable();
            $table->double('ricefieldseven_latitude',15,8)->nullable();
            $table->double('ricefieldseven_longitude',15,8)->nullable();
            $table->double('ricefieldeight_latitude',15,8)->nullable();
            $table->double('ricefieldeight_longitude',15,8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rice_boundaries');
    }
};
