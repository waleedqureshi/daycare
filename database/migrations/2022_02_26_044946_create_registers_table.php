<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->id();

            //Child
            $table->string('child_name')->nullable();
            $table->date('child_date_of_birth')->nullable();
            $table->string('child_sex')->nullable();
            $table->text('child_address')->nullable();
            $table->string('child_postcode')->nullable();
            $table->string('child_homephone')->nullable();
            $table->string('child_school')->nullable();
            $table->string('child_year')->nullable();
            $table->date('child_start_date')->nullable();
            $table->string('child_group')->nullable();
            
            //Family One
            $table->string('family1_name')->nullable();
            $table->string('family1_relation')->nullable();
            $table->string('family1_occupation')->nullable();
            $table->string('family1_employer')->nullable();
            $table->string('family1_work_phone')->nullable();
            $table->string('family1_mobile_phone')->nullable();
            $table->string('family1_email')->nullable();
            $table->text('family1_address')->nullable();
            $table->string('family1_postcode')->nullable();

            //Family 2
            $table->string('family2_name')->nullable();
            $table->string('family2_relation')->nullable();
            $table->string('family2_occupation')->nullable();
            $table->string('family2_employer')->nullable();
            $table->string('family2_work_phone')->nullable();
            $table->string('family2_mobile_phone')->nullable();
            $table->string('family2_email')->nullable();
            $table->text('family2_address')->nullable();
            $table->string('family2_postcode')->nullable();

            //Provider
            $table->string('provider_name')->nullable();
            $table->text('provider_address')->nullable();
            $table->string('provider_telephone')->nullable();
            $table->string('provider_emergency_tel_no')->nullable();
            $table->string('provider_email')->nullable();
            $table->string('provider_registration_no')->nullable();

            //Emergency
            $table->string('emergency_name')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_relation')->nullable();

            //Other Details
            $table->string('other_allergy')->nullable();
            $table->text('other_allergy_details')->nullable();
            $table->string('other_condition')->nullable();
            $table->text('other_condition_details')->nullable();
            $table->string('other_vaccination')->nullable();
            $table->text('other_vaccination_details')->nullable();
            $table->string('other_name')->nullable();
            $table->string('other_tel')->nullable();
            $table->string('other_address')->nullable();

            //Footer
            $table->date('date')->nullable();
            $table->string('signature')->nullable();
            $table->string('registration_no')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registers');
    }
}
