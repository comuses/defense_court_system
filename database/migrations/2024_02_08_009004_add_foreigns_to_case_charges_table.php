<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('case_charges', function (Blueprint $table) {
            $table
                ->foreign('mod_id')
                ->references('id')
                ->on('mods')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('mod_employee_id')
                ->references('id')
                ->on('mod_employees')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('registrar_id')
                ->references('id')
                ->on('registrars')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_charges', function (Blueprint $table) {
            $table->dropForeign(['mod_id']);
            $table->dropForeign(['mod_employee_id']);
            $table->dropForeign(['registrar_id']);
        });
    }
};
