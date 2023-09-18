<?php

use App\Models\Natural;
use App\Models\Shopkeeper;
use App\Models\User;
use App\Models\Wallet;
use Domain\Transfers\Actions\TransferAction;
use Domain\Transfers\Exceptions\NotAllowedToTransferExeption;
use function PHPUnit\Framework\assertEquals;

test('Validate shopkeeper cannot transfer', function () {

    $userShopkeeper = User::factory()
        ->has(Shopkeeper::factory()->has(Wallet::factory()->withBalance(1000)))
        ->create();
    $userNatural = User::factory()
        ->has(Natural::factory()->has(Wallet::factory()))
        ->create();

    $trasnfer = resolve(TransferAction::class);
    $trasnfer($userShopkeeper->shopkeeper, $userNatural->natural, 500);

})->group('Unit', 'Transfer')->throws(NotAllowedToTransferExeption::class);


test('Validate Natural to Shoopkeeper', function () {

    $userNatural = User::factory()
        ->has(Natural::factory()->has(Wallet::factory()->withBalance(1000)))
        ->create();
    $userShopkeeper = User::factory()
        ->has(Shopkeeper::factory()->has(Wallet::factory()))
        ->create();

    $trasnfer = resolve(TransferAction::class);
    $trasnfer($userNatural->natural, $userShopkeeper->shopkeeper, 500);

    assertEquals(500, $userShopkeeper->shopkeeper->wallet->balance);

})->group('Unit', 'Transfer');


test('Validate Natural to Natural', function () {

    $userNatural = User::factory()
        ->has(Natural::factory()->has(Wallet::factory()->withBalance(1000)))
        ->create();
    $userOtherNatural = User::factory()
        ->has(Natural::factory()->has(Wallet::factory()))
        ->create();

    $trasnfer = resolve(TransferAction::class);
    $trasnfer($userNatural->natural, $userOtherNatural->natural, 500);

    assertEquals(500, $userOtherNatural->natural->wallet->balance);

})->group('Unit', 'Transfer');
