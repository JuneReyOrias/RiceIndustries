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
        Schema::create('livestock_production', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agri_districts_id')->nullable();
            $table->foreignId('livestock_category_id')->nullable();
            $table->date('date_harvested');
            $table->date('date_adopted');
            $table->string('feeds_type',100);
            $table->double('feeds_cost',10,2);
            $table->string('solds_to',50);
            $table->double('unit',10,2);
            $table->double('quantity',10,2);
            $table->double('market_unit_price',10,2);
            $table->double('production_cost',10,2);
            $table->double('gross_income',10,2);
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestock_production');
    }
};
