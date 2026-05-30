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
        Schema::disableForeignKeyConstraints();

        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('white_player_id')->constrained('users');
            $table->foreignId('black_player_id')->constrained('');
            $table->foreignId('winner_id')->nullable()->constrained('');
            $table->text('current_fen');
            $table->enum('status', ["pending","active","completed","aborted"])->default('pending');
            $table->string('result')->nullable();
            $table->string('time_control');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
