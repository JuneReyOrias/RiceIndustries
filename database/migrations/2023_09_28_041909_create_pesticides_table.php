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
        Schema::create('pesticides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('personal_informations_id')->nullable();
            $table->string('pesticides_name',30)->nullable();
            $table->string('type_ofpesticides',30)->nullable();
            $table->double('no_of_l_kg',15,2);
            $table->double('unitprice_ofpesticides',15,2);
            $table->double('total_cost_pesticides',15,2);
            $table->timestamps();
            
            
            // $table->id();
            // $table->string('pesticides_name',30)->nullable();
            // $table->string('type_ofpesticides',30)->nullable();
            // $table->double('no_of_l_kg',15,2);
            // $table->double('unitprice_ofpesticides',15,2);
            // $table->double('total_cost_pesticides',15,2);
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
        Schema::dropIfExists('pesticides');
    }
};
