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
        Schema::create('landingpage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->string('home_title')->nullable();
            $table->string('home_description')->nullable();
            $table->string('home_logo')->nullable();
            $table->string('home_imageslider')->nullable();
            $table->string('agri_logo')->nullable();
            $table->string('feature_header')->nullable();
            $table->string('feature_description')->nullable();
            $table->string('agri_features')->nullable();
            $table->string('agri_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landingpage');
    }
};
