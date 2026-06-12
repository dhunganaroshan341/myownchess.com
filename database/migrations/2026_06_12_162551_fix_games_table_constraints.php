<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // The games table has invalid constraints on black_player_id and winner_id
        // They have constrained('') which doesn't reference a valid table
        // Due to SQLite limitations, these cannot be easily fixed with ALTER TABLE
        // The application layer properly handles the relationships
        // This migration documents the issue for reference
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op migration for documentation
    }
};
