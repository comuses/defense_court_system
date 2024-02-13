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
        Schema::create('witnesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('witnessID');
            $table->string('name');
            $table->string('address');
            $table->string('state');
            $table->string('attorneyWitness');
            $table->text('Description');
            $table->string('accusedWitness');
            $table->string('attoneyID');
            $table->string('caseChargedID');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('witnesses');
    }
};
