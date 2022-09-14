<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendences', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Date');
            $table->string('On_duty');
            $table->string('Off_duty');
            $table->string('Clock_In');
            $table->string('Clock_Out');
            $table->string('Work_Time');
            $table->string('ATT_Time');
            $table->string('Time');
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
        Schema::dropIfExists('attendences');
    }
}
