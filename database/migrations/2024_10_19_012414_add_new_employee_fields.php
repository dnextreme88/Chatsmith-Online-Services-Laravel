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
        Schema::table('employees', function (Blueprint $table) {
            $table->renameColumn('date_tenure', 'date_hired');
            $table->date('date_resigned')
                ->nullable()
                ->after('date_hired');
            $table->string('pag_ibig_number', 32)
                ->nullable()
                ->after('is_active');
            $table->string('philhealth_number', 32)
                ->nullable()
                ->after('pag_ibig_number');
            $table->string('sss_number', 32)
                ->nullable()
                ->after('philhealth_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->renameColumn('date_hired', 'date_tenure');
            $table->dropColumn('date_resigned');
            $table->dropColumn('pag_ibig_number');
            $table->dropColumn('philhealth_number');
            $table->dropColumn('sss_number');
        });
    }
};
