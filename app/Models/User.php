<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
        'rapid_rating',
        'blitz_rating',
        'bullet_rating',
        'puzzle_rating',
        'last_seen_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_seen_at' => 'datetime',
            'password' => 'hashed',
            'rapid_rating' => 'integer',
            'blitz_rating' => 'integer',
            'bullet_rating' => 'integer',
            'puzzle_rating' => 'integer',
        ];
    }

    // Relationships
    public function gameAsWhitePlayer()
    {
        return $this->hasMany(Game::class, 'white_player_id');
    }

    public function gameAsBlackPlayer()
    {
        return $this->hasMany(Game::class, 'black_player_id');
    }

    public function wonGames()
    {
        return $this->hasMany(Game::class, 'winner_id');
    }

    public function puzzleAttempts()
    {
        return $this->hasMany(PuzzleAttempt::class);
    }

    public function createdPuzzles()
    {
        return $this->hasMany(Puzzle::class, 'created_by');
    }
}
