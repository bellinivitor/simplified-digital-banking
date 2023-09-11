<?php

use App\Models\User;
use function Pest\Laravel\post;

test('Authenticated login with valid credentials', function () {

    $user = User::factory()->create();

    $response = post('/api/v1/login', [
        "email" => $user->getAttribute('email'),
        "password" => "password"
    ]);

    $response->assertOk();

})->group('Feature', 'Login');

test('Authenticated login with invalid credentials', function () {

    $response = post('/api/v1/login', [
        "email" => 'random@email.com',
        "password" => "password_wrong"
    ]);

    $response->assertUnauthorized();

})->group('Feature', 'Login');
