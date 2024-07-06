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
        Schema::create('labors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('personal_informations_id')->nullable();
            $table->integer('no_of_person');
            $table->double('rate_per_person',15,2);
            $table->double('total_labor_cost',15,2);
            $table->timestamps();
            
            // $table->id();
            // $table->integer('no_of_person');
            // $table->double('rate_per_person',15,2);
            // $table->double('total_labor_cost',15,2);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labors');
    }
};
