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
        Schema::create('polygons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('agri_districts_id')->nullable();
            $table->string('strokecolor',50)->nullable();
            $table->double('verone_latitude',15,8)->nullable();
            $table->double('verone_longitude',15,8)->nullable();
            $table->double('vertwo_latitude',15,8)->nullable();
            $table->double('vertwo_longitude',15,8)->nullable();
            $table->double('verthree_latitude',15,8)->nullable();
            $table->double('verthree_longitude',15,8)->nullable();
            $table->double('vertfour_latitude',15,8)->nullable();
            $table->double('vertfour_longitude',15,8)->nullable();
            $table->double('verfive_latitude',15,8)->nullable();
            $table->double('verfive_longitude',15,8)->nullable();
            $table->double('versix_latitude',15,8)->nullable();
            $table->double('versix_longitude',15,8)->nullable();
            $table->double('verseven_latitude',15,8)->nullable();
            $table->double('verseven_longitude',15,8)->nullable();
            $table->double('vereight_latitude',15,8)->nullable();
            $table->double('verteight_longitude',15,8)->nullable();
            $table->json('coordinates')->nullable();
            $table->double('area',15,7)->nullable();
            $table->double('perimeter',15,7)->nullable();
   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polygons');
    }
};
