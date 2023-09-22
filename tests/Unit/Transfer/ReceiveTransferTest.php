<?php

use App\Models\Identification;
use App\Models\Natural;
use App\Models\User;
use App\Models\Wallet;
use Domain\Wallet\Actions\ReceiveTransferAction;
use function PHPUnit\Framework\assertEquals;

test('Validate value received on wallet of recipient', function () {

    /** @var User $user */
    $user = User::factory()
        ->has(Natural::factory()
            ->has(Wallet::factory()->withBalance(500))
            ->for(Identification::factory()))
        ->create();

    $wallet = $user->natural->wallet;

    $receiveTransferAction = resolve(ReceiveTransferAction::class);
    $receiveTransferAction($wallet, 100);

    assertEquals(600, $wallet->balance);

})->group('Unit', 'Transfer');
