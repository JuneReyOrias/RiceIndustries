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
        Schema::create('fertilizers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('personal_informations_id')->nullable();
            $table->string('name_of_fertilizer',30)->nullable();
            $table->string('type_of_fertilizer',30)->nullable();
            $table->double('no_ofsacks',15,4);
            $table->double('unitprice_per_sacks',15,4);
            $table->double('total_cost_fertilizers',15,4);
            $table->timestamps();
            
            
            // $table->id();
            // $table->string('name_of_fertilizer',30)->nullable();
            // $table->string('type_of_fertilizer',30)->nullable();
            // $table->double('no_ofsacks',15,4);
            // $table->double('unitprice_per_sacks',15,4);
            // $table->double('total_cost_fertilizers',15,4);
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
        Schema::dropIfExists('fertilizers');
    }
};
