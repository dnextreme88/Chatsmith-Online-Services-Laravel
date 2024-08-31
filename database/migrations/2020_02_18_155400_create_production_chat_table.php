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
		Schema::create('production_chat', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('employee_id');
			$table->unsignedBigInteger('time_range_id');
			$table->foreign('user_id')->references('id')->on('users'); // Foreign key: Users model
			$table->foreign('employee_id')->references('id')->on('employees'); // Foreign key: Employees model
			$table->foreign('time_range_id')->references('id')->on('time_ranges'); // Foreign key: TimeRanges model
			$table->string('account_used')->nullable();
			$table->integer('minutes_worked')->nullable();
			$table->string('chat_account_tool')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('production_chat');
	}
};
