<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('name');
            $table->string('department');
            $table->string('designation');
            $table->string('personal_email');
            $table->string('official_email');
            $table->string('personal_number');
            $table->string('official_number')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('home_address');

            $table->string('ename')->nullable();
            $table->string('ephone')->nullable();
            $table->string('erelation')->nullable();

            $table->string('gender');
            $table->string('company_name');
            $table->string('dob');
            $table->string('blood_group');
            $table->string('marital_status');

            $table->string('image')->nullable();
            $table->string('qrimage')->nullable();
            $table->date('expiry_date')->nullable();
            $table->boolean('active')->nullable()->default(true);
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
        Schema::dropIfExists('employees');
    }
}
