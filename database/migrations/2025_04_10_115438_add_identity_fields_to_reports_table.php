<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->boolean('is_anonymous')->default(true);
            $table->string('reporter_name')->nullable();
            $table->string('reporter_class')->nullable();
            $table->string('reporter_major')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['is_anonymous', 'reporter_name', 'reporter_class', 'reporter_major']);
        });
    }
};
