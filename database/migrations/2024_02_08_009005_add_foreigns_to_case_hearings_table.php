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
        Schema::table('case_hearings', function (Blueprint $table) {
            $table
                ->foreign('attorney_id')
                ->references('id')
                ->on('attorneys')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('court_id')
                ->references('id')
                ->on('courts')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('mod_id')
                ->references('id')
                ->on('mods')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('judge_id')
                ->references('id')
                ->on('judges')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('witness_id')
                ->references('id')
                ->on('witnesses')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('case_hearings', function (Blueprint $table) {
            $table->dropForeign(['attorney_id']);
            $table->dropForeign(['court_id']);
            $table->dropForeign(['mod_id']);
            $table->dropForeign(['judge_id']);
            $table->dropForeign(['witness_id']);
        });
    }
};
