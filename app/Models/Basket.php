<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'product_type', 'image_path', 'quantity'
    ];

    public function product()
    {
        return $this->morphTo();
    }
}
