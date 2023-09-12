<?php

namespace Domain\Wallet\Actions;

use App\Models\Wallet;
use Domain\Transfers\Exceptions\InsufficientBalanceException;
use function __;

class DescountValueOfTransferAction
{

    /**
     * @param Wallet $wallet
     * @param float $amount
     * @return void
     * @throws InsufficientBalanceException
     */
    public function __invoke(Wallet $wallet, float $amount): void
    {
        if ($wallet->balance < $amount) {
            throw new InsufficientBalanceException(__('Insufficient balance in your account'));
        }

        $wallet->balance = $wallet->balance - $amount;
        $wallet->save();
    }
}
