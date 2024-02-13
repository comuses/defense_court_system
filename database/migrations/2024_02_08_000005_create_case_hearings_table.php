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
        Schema::create('case_hearings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('casehearingID');
            $table->string('modID');
            $table->string('courtID');
            $table->string('judgeID');
            $table->string('attorneyID');
            $table->string('attoneryWitnessID');
            $table->string('accusedWitnessID');
            $table->string('chilotname');
            $table->string('accEmpID');
            $table->string('fileNumber');
            $table->dateTime('caseStartDate');
            $table->string('address');
            $table->string('state');
            $table->string('location');
            $table->text('description');
            $table->unsignedBigInteger('attorney_id');
            $table->unsignedBigInteger('court_id');
            $table->unsignedBigInteger('mod_id');
            $table->unsignedBigInteger('judge_id');
            $table->unsignedBigInteger('witness_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_hearings');
    }
};
