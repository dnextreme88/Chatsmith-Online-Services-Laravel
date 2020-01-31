<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('time_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('time_of_shift');
            $table->date('date_of_shift');
            $table->integer('employee_id');
            $table->string('employee_name');
            $table->dateTime('timestamp_in', 0);
            $table->dateTime('timestamp_out', 0);
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
        Schema::dropIfExists('time_records');
    }
}
