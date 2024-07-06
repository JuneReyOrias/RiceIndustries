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
        Schema::create('fixed_costs', function (Blueprint $table) {
            $table->Id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('personal_informations_id')->nullable();
            $table->foreignId('farm_profiles_id')->nullable();
            $table->string('particular', 30)->nullable();
            $table->double('no_of_ha', 15, 4)->nullable();
            $table->double('cost_per_ha', 15, 4)->nullable();
            $table->double('total_amount', 15, 4)->nullable();
            $table->double('coconut_fixed_cost', 15, 4)->nullable();
            $table->double('corn_fixed_cost', 15, 4)->nullable();
            $table->double('chicken_fixed_cost', 15, 4)->nullable();
            $table->double('pig_fixed_cost', 15, 4)->nullable();
            $table->timestamps();
        

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixed_costs');
    }
};
