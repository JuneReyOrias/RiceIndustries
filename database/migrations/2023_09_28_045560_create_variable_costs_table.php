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
        Schema::create('variable_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('personal_informations_id')->nullable();
            $table->foreignId('farm_profiles_id')->nullable();
            $table->foreignId('seeds_id')->nullable();
            $table->foreignId('labors_id')->nullable();
            $table->foreignId('fertilizers_id')->nullable();
            $table->foreignId('pesticides_id')->nullable();
            $table->foreignId('transports_id')->nullable();
            $table->double('total_machinery_fuel_cost', 15, 4);
            $table->double('total_variable_cost', 15, 4);
            $table->double('chicken_variable_cost', 15, 4)->nullable();
            $table->double('corn_variable_cost', 15, 4)->nullable();
            $table->double('coconut_variable_cost', 15, 4)->nullable();
            $table->double('pig_variable_cost', 15, 4)->nullable();
            $table->timestamps();
          
          
            // $table->id();
            // $table->foreignId('seed_id')->unique()->nullable();
            // $table->foreignId('labor_id')->unique()->nullable();
            // $table->foreignId('fertilizer_id')->unique()->nullable();
            // $table->foreignId('pesticides_id')->unique()->nullable();
            // $table->foreignId('tranport_id')->unique()->nullable();
            // $table->double('total_machinery_fuel_cost',15,4);
            // $table->double('total_variable_cost',15,4);
            // $table->foreignId('personal_informations_id')->nullable()->constrained('personal_informations');
            // $table->foreignId('farm_profiles_id')->nullable()->constrained('farm_profiles');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variable_costs');
    }
};
