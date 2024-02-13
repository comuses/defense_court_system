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
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('caseHearID');
            $table->string('empID');
            $table->string('modID');
            $table->string('fullname');
            $table->string('chargeType');
            $table->dateTime('appointmentDate');
            $table->text('description');
            $table->unsignedBigInteger('mod_id');
            $table->unsignedBigInteger('case_hearing_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
