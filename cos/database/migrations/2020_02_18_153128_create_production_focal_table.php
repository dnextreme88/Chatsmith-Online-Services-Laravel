<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionFocalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_focal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('user_id')->references('id')->on('users'); // Foreign key: User model
            $table->foreign('employee_id')->references('id')->on('employees'); // Foreign key: Employees model
            $table->string('account_used')->nullable();
            $table->string('time_range')->nullable();
            $table->integer('minutes_worked')->nullable();
            $table->integer('oos_count')->nullable()->default(0);
            $table->integer('not_oos_count')->nullable()->default(0);
            $table->integer('discard_count')->nullable()->default(0);
            $table->integer('total_count')->nullable();
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
        Schema::dropIfExists('production_focal');
    }
}
