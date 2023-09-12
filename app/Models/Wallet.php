<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property float $balance
 */
class Wallet extends Model
{
    use HasFactory;

    protected $casts = [
        'balance' => 'float'
    ];

    protected $fillable = [
        'natural_id',
        'shopkeeper_id',
        'balance',
    ];
}
