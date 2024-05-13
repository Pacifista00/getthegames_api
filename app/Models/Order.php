<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'transaction_id',
        'email',
        'amount',
        'phone',
        'status'
    ];
    use HasFactory;
}
