<?php

namespace Domain\Users\Interfaces;

use App\Models\Wallet;

interface AccountHolderInterface
{
    public function getWallet(): Wallet;
}
