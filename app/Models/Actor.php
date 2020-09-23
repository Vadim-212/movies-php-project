<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    public $fillable = [
        'name',	'original_name', 'date_of_birth', 'country_id', 'image_path'
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
