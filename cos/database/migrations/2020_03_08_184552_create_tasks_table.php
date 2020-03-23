<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('time_range_id');
            $table->foreign('user_id')->references('id')->on('users'); // Foreign key: Users model
            $table->foreign('employee_id')->references('id')->on('employees'); // Foreign key: Employees model
            $table->foreign('time_range_id')->references('id')->on('time_ranges'); // Foreign key: TimeRanges model
            $table->string('task_name')->nullable();
            $table->date('task_date')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
