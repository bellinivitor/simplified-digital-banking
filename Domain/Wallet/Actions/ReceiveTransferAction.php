<?php

namespace Domain\Wallet\Actions;

use App\Models\Wallet;

class ReceiveTransferAction
{
    /**
     * @param Wallet $wallet
     * @param float $amount
     * @return void
     */
    public function __invoke(Wallet $wallet, float $amount): void
    {
        $wallet->balance = $wallet->balance + $amount;
        $wallet->save();
    }
}
