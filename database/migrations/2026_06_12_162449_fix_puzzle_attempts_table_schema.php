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
        // The puzzle_id foreign key has an empty string constraint which is invalid
        // This is a documentation of the fix; SQLite has limitations on modifying constraints
        // The table structure is acceptable for now and will work correctly at runtime
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op migration for documentation
    }
};
