<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'developer', 'release_year', 'stock', 'price'
    ];

    public function genre()
    {
        return $this->belongsToMany(Genre::class);
    }
    public function basket()
    {
        return $this->morphMany(Basket::class, 'product');
    }
}
