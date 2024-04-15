<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image_path', 'publisher', 'release_year', 'description', 'console_id', 'stock', 'price'
    ];

    public function basket()
    {
        return $this->morphMany(Basket::class, 'product');
    }
    public function console()
    {
        return $this->belongsTo(Console::class);
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genres')->withTimeStamps();
    }
}
