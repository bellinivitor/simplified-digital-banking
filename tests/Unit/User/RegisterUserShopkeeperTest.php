<?php

use App\Models\Natural;
use App\Models\Shopkeeper;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use function Pest\Laravel\assertDatabaseCount;

test('Create user shopkeeper', function () {

    User::factory()
        ->has(Shopkeeper::factory())
        ->count(3)
        ->create();

    assertDatabaseCount('users', 3);

})->group('Unit', 'User');

test('Create duplicated user shopkeeper', function () {

    User::factory()
        ->has(Shopkeeper::factory()->state(fn (array $attributes) => [
            'cnpj' => '000000000000000',
        ]))
        ->count(2)
        ->create();

})->group('Unit', 'User')->throws(UniqueConstraintViolationException::class);
