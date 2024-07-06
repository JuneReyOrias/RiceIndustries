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
        Schema::create('crop_farm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('agri_districts_id')->nullable();
            $table->foreignId('crop_category_id')->nullable();
            $table->foreignId('farm_profiles_id')->nullable();
            $table->string('type_of_variety', 50)->nullable();
            $table->string('prefered_variety', 50)->nullable();
            $table->string('plant_schedule_wetseason', 50)->nullable();
            $table->string('plant_schedule_dryseason', 50)->nullable();
            $table->string('no_of_cropping_yr', 50)->nullable();
            $table->double('quantity',10,2);
          
            
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop_farm');
    }
};
