<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('puzzles', function (Blueprint $table) {
            // Drop the invalid creator_id column if it exists
            if (Schema::hasColumn('puzzles', 'creator_id')) {
                $table->dropColumn('creator_id');
            }
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('puzzles', function (Blueprint $table) {
            // This rollback is not fully reversible since we removed creator_id
            // The schema will revert to the state before the fix
        });
    }
};
