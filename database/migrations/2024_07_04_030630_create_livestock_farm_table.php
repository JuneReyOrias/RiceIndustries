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
        Schema::create('livestock_farms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('agri_districts_id')->nullable();
            $table->foreignId('livestock_category_id')->nullable();
            $table->foreignId('farm_profiles_id')->nullable();
            $table->string('family',50);
            $table->string('breed',50);
            $table->double('age',10,2);
            $table->string('gender',50);
            $table->double('quantity',10,2);
            $table->date('date_adopted');
            $table->date('date_harvested');
         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestock_farm');
    }
};
