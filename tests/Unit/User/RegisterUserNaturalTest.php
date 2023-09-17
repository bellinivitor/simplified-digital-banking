<?php

use App\Models\Natural;
use App\Models\User;
use Domain\Shared\Exceptions\DuplicatedValueException;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use function Pest\Laravel\assertDatabaseCount;

test('Create user natural', function () {

    User::factory()
        ->has(Natural::factory())
        ->count(3)
        ->create();

    assertDatabaseCount('users', 3);

})->group('Unit', 'User');

test('Create duplicated user natural', function () {

    User::factory()
        ->has(Natural::factory()->state(fn (array $attributes) => [
            'cpf' => '00000000000',
        ]))
        ->count(2)
        ->create();

})->group('Unit', 'User')->throws(UniqueConstraintViolationException::class);
