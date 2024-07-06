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
        Schema::create('agri_districts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->string('district',50);
            $table->string('description',200);
            $table->double('latitude',15,7)->nullable();
            $table->double('longitude',15,7)->nullable();
            $table->double('altitude',15,7)->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agri_districts');
    }
};
