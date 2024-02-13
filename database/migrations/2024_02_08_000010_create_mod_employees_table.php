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
        Schema::create('mod_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('modID');
            $table->string('EmpID');
            $table->string('rank');
            $table->string('fullName');
            $table->string('address');
            $table->string('state');
            $table->string('empType');
            $table->unsignedBigInteger('mod_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_employees');
    }
};
