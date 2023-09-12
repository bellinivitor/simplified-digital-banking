<?php

use App\Models\Natural;
use App\Models\Shopkeeper;
use App\Models\User;
use App\Models\Wallet;
use Domain\Transfers\Exceptions\InsufficientBalanceException;
use Domain\Wallet\Actions\DescountValueOfTransferAction;
use function PHPUnit\Framework\assertEquals;

test('Discount test on the amount transferred from a shopkeeper', function () {

    /** @var User $user */
    $user = User::factory()
        ->has(Shopkeeper::factory()
            ->has(Wallet::factory()->withBalance(500))
        )
        ->create();

    $wallet = $user->shopkeeper->wallet;

    $descountValueOfTransfer = resolve(DescountValueOfTransferAction::class);
    $descountValueOfTransfer($wallet, 200);

    assertEquals(300, $wallet->balance);

})->group('Unit', 'Wallet');

test('Discount test on the amount transferred from a shopkeeper without suficient balance', function () {

    /** @var User $user */
    $user = User::factory()
        ->has(Shopkeeper::factory()
            ->has(Wallet::factory()->withBalance(500))
        )
        ->create();

    $wallet = $user->shopkeeper->wallet;

    $descountValueOfTransfer = resolve(DescountValueOfTransferAction::class);
    $descountValueOfTransfer($wallet, 600);

})->group('Unit', 'Wallet')->throws(InsufficientBalanceException::class);

test('Discount test on the amount transferred from a natural', function () {

    /** @var User $user */
    $user = User::factory()
        ->has(Natural::factory()
            ->has(Wallet::factory()->withBalance(500))
        )
        ->create();

    $wallet = $user->natural->wallet;

    $descountValueOfTransfer = resolve(DescountValueOfTransferAction::class);
    $descountValueOfTransfer($wallet, 200);

    assertEquals(300, $wallet->balance);

})->group('Unit', 'Wallet');

test('Discount test on the amount transferred from a natural without suficient balance', function () {

    /** @var User $user */
    $user = User::factory()
        ->has(Natural::factory()
            ->has(Wallet::factory()->withBalance(500))
        )
        ->create();

    $wallet = $user->natural->wallet;

    $descountValueOfTransfer = resolve(DescountValueOfTransferAction::class);
    $descountValueOfTransfer($wallet, 600);

})->group('Unit', 'Wallet')->throws(InsufficientBalanceException::class);
