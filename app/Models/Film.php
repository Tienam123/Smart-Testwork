<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Film extends Model
{
    /** @use HasFactory<\Database\Factories\FilmFactory> */
    use HasFactory;
    const POSTER_URL = 'films/placeholder.png';

    protected $table = 'films';
    protected $fillable = [
        'title',
        'status',
        'thumbnail'
    ];

    public function genres():BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
