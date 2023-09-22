<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Identification extends Model
{
    use HasFactory;

    public function natural(): HasOne
    {
        return $this->hasOne(Natural::class);
    }

    public function shopkeeper(): HasOne
    {
        return $this->hasOne(Shopkeeper::class);
    }
}
