<?php

namespace App\Models;

use Domain\Transfers\Exceptions\OwnerNotRegistredException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Natural $natural
 * @property Shopkeeper $shopkeeper
 */
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

    /**
     * @return Shopkeeper|Natural
     * @throws OwnerNotRegistredException
     */
    public function accountHolder(): Shopkeeper|Natural
    {
        if ($this->natural()->exists()) {
            return $this->natural;
        }

        if ($this->shopkeeper()->exists()) {
            return $this->shopkeeper;
        }

        throw new OwnerNotRegistredException(__('This identification key does not belong to any account holder'));
    }
}
