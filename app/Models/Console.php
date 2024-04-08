<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'developer', 'release_year', 'stock', 'price'
    ];
    public function basket()
    {
        return $this->morphMany(Basket::class, 'product');
    }
    public function game()
    {
        return $this->HasMany(Game::class);
    }
}
