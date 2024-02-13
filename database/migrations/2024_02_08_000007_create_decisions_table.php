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
        Schema::create('decisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('caseHearingID');
            $table->string('modID');
            $table->string('empID');
            $table->string('name');
            $table->string('chargeType');
            $table->dateTime('caseStartDate');
            $table->dateTime('decisionDate');
            $table->string('decisionType');
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
        Schema::dropIfExists('decisions');
    }
};
