<?php

namespace App\Models;

use Domain\Users\Interfaces\AccountHolderInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Wallet $wallet
 */
class Natural extends Model implements AccountHolderInterface
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cpf',
        'identification_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    public function getWallet(): Wallet
    {
        /** @var Wallet $wallet */
        $wallet = $this->hasOne(Wallet::class)->firstOrNew();

        return $wallet;
    }

    public function identification(): BelongsTo
    {
        return $this->belongsTo(Identification::class);
    }
}
