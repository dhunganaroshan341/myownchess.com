<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'move_number',
        'side',
        'uci_move',
        'san_move',
        'fen_before',
        'fen_after',
        'move_time_ms',
    ];

    protected $casts = [
        'move_time_ms' => 'integer',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
