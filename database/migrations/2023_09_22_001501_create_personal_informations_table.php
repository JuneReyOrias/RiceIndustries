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
        Schema::create('personal_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('agri_districts_id')->nullable();
           
            $table->string('crop_type',20)->nullable();
            $table->string('livestock_type',20)->nullable();
            $table->string('first_name',50);
            $table->string('middle_name',50)->nullable();
            $table->string('last_name',50);
            $table->string('extension_name',50)->nullable();
            $table->string('country',50)->nullable();
            $table->string('province',50)->nullable();
            $table->string('city',50)->nullable();
            $table->string('district',50)->nullable();
            $table->string('barangay',50)->nullable();
            $table->string('street',50)->nullable();
            $table->string('zip_code',50)->nullable();
            $table->string('sex',50);
            $table->string('religion',50)->nullable();
            $table->string('date_of_birth',30);
            $table->string('place_of_birth',50)->nullable();
            $table->string('contact_no',30)->nullable();
            $table->string('civil_status',50);
            $table->string('name_legal_spouse',50)->nullable();
            $table->string('no_of_children',)->nullable();
            $table->string('mothers_maiden_name',50);
            $table->string('highest_formal_education',50)->nullable();
            $table->string('person_with_disability',5);
            $table->string('pwd_id_no',30)->nullable();
            $table->string('government_issued_id',5);
            $table->string('id_type',30);
            $table->string('gov_id_no',30);
            $table->string('member_ofany_farmers_ass_org_coop',5);
            $table->string('nameof_farmers_ass_org_coop',50);//id 
            $table->string('name_contact_person',30)->nullable();
            $table->string('cp_tel_no',50)->nullable();
            $table->string('personal_photo')->nullable();
            $table->date('date_interview');
            $table->timestamps();
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_informations');
    }
};
