<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Make user_id nullable since reports can now be from gurus
            $table->foreignId('user_id')->nullable()->change();

            // Add guru_id column
            $table->foreignId('guru_id')->nullable()->after('user_id')
                ->references('id_guru')->on('gurus')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Make user_id required again
            $table->foreignId('user_id')->nullable(false)->change();

            // Drop guru_id column
            $table->dropForeign(['guru_id']);
            $table->dropColumn('guru_id');
        });
    }
};
