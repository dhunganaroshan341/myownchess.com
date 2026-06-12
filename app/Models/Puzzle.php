<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'starting_fen',
        'solution',
        'rating',
        'description',
        'created_by',
        'is_active',
    ];

    protected $attributes = [
        'rating' => 1200,
        'is_active' => true,
    ];

    protected $casts = [
        'solution' => 'array',
        'is_active' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class);
    }

    public function attempts()
    {
        return $this->hasMany(PuzzleAttempt::class);
    }
}
