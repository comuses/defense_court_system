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
        Schema::create('case_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('modID');
            $table->string('MIDnumber');
            $table->string('rank');
            $table->string('fullName');
            $table->string('address');
            $table->string('state');
            $table->text('crimeType');
            $table->dateTime('crimeDate');
            $table->dateTime('chargeDate');
            $table->unsignedBigInteger('mod_id');
            $table->unsignedBigInteger('mod_employee_id');
            $table->unsignedBigInteger('registrar_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_charges');
    }
};
