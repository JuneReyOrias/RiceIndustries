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
        Schema::create('seeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('personal_informations_id')->nullable();
            $table->string('seed_name',30)->nullable();
            $table->string('seed_type',30)->nullable();
            $table->string('unit',30);
            $table->double('quantity',15,4);
            $table->double('unit_price',15.4);
            $table->double('total_seed_cost',15,4);
            $table->timestamps();

            
            
            // $table->id();
            // $table->string('seed_name',30)->nullable();
            // $table->string('seed_type',30)->nullable();
            // $table->string('unit',30);
            // $table->double('quantity',15,4);
            // $table->double('unit_price',15.4);
            // $table->double('total_seed_cost',15,4);
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
        Schema::dropIfExists('seeds');
    }
};
