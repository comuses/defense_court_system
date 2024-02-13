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
        Schema::create('registrars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MIDNumber');
            $table->string('Rank');
            $table->string('Name');
            $table->string('fieldType');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('courtID');
            $table->unsignedBigInteger('court_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrars');
    }
};
