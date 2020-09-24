<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $fillable = [
        'name', 'original_name', 'description', 'year', 'country_id', 'genre_id', 'image_path'
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function actors() {
        return $this->belongsToMany(Actor::class, 'movie_actor');
    }
}
