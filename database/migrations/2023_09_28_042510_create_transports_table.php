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
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('personal_informations_id')->nullable();
            $table->string('name_of_vehicle',30)->nullable();
            $table->string('type_of_vehicle',30)->nullable();
            $table->double('total_transport_per_deliverycost',15,2);
            $table->timestamps(); 
           
            // $table->id();
            // $table->string('name_of_vehicle',30)->nullable();
            // $table->string('type_of_vehicle',30)->nullable();
            // $table->double('total_transport_per_deliverycost',15,2);
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
        Schema::dropIfExists('transports');
    }
};
