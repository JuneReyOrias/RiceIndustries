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
        Schema::create('crops_farm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->nullable();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('agri_districts_id')->nullable();
            $table->foreignId('crop_category_id')->nullable();
            $table->foreignId('farm_profiles_id')->nullable();
            $table->string('crop_name', 100)->nullable();
            $table->string('type_of_variety_planted', 50)->nullable();
            $table->string('prefered_variety', 50)->nullable();
            $table->date('plant_schedule_wetseason')->nullable();
            $table->date('plant_schedule_dryseason')->nullable();
            $table->string('no_of_cropping_per_year', 50)->nullable();
            $table->double('quantity',10,2)->nullable();
            $table->double('yield_kg_ha',10,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crops_farm');
    }
};
