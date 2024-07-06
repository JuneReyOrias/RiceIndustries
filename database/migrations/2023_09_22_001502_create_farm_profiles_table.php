<?php

use Doctrine\DBAL\Schema\Index;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('farm_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('personal_informations_id')->nullable();
            $table->foreignId('agri_districts_id')->nullable();
            $table->foreignId('polygons_id')->nullable();
            $table->foreignId('crop_categories_id')->nullable();
            $table->foreignId('livestock_categories_id')->nullable();
            $table->string('tenurial_status', 50);
            $table->string('rice_farm_address', 50);
            $table->double('no_of_years_as_farmers', 8, 2)->nullable();
            $table->double('gps_longitude', 15, 8)->nullable();
            $table->double('gps_latitude', 15, 8)->nullable();
            $table->double('total_physical_area', 15, 4)->nullable();
            $table->double('total_area_cultivated', 15, 4)->nullable();
         
            $table->string('land_title_no', 50)->nullable();
            $table->string('lot_no', 50)->nullable();
            $table->string('area_prone_to', 50)->nullable();
            $table->string('ecosystem', 50)->nullable();
            $table->string('type_of_variety', 50)->nullable();
            $table->string('prefered_variety', 50)->nullable();
            $table->string('plant_schedule_wetseason', 50)->nullable();
            $table->string('plant_schedule_dryseason', 50)->nullable();
            $table->string('no_of_cropping_yr', 50)->nullable();
            $table->double('yield_kg_ha', 15, 4)->nullable();
            $table->string('rsba_register', 50)->nullable();
            $table->string('pcic_insured', 50)->nullable();
            $table->string('government_assisted', 100)->nullable();
            $table->string('source_of_capital', 50)->nullable();
            $table->string('remarks_recommendation', 100)->nullable();
            $table->string('oca_district_office', 50)->nullable();
            $table->string('name_technicians', 50)->nullable();
            $table->string('date_interview', 50);
            $table->string('farm_images')->nullable();
            
         
        
        
            $table->timestamps();
              // $table->string('type_rice_variety', 50)->nullable();
            // $table->string('prefered_variety', 50)->nullable();
            // $table->string('plant_schedule_wetseason', 50)->nullable();
            // $table->string('plant_schedule_dryseason', 50)->nullable();
            // $table->string('no_of_cropping_yr', 50)->nullable();
            // $table->double('yield_kg_ha', 15, 4)->nullable();
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_profiles');
       
        
    }
};
