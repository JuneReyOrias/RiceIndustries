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
        Schema::create('crops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('categorizes_id')->nullable();
            $table->foreignId('crop_categorys_id')->nullable();
            $table->string('crop_name',50);
            $table->string('crop_variety',50)->nullable();
            $table->string('crop_planting_season',50)->nullable();
            $table->string('crop_harvesting_season',50)->nullable();
            $table->string('crop_type_soil',50)->nullable();
            $table->string('crop_description',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crop');
    }
};
