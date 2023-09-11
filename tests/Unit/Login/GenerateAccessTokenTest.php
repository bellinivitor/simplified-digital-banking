<?php

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Domain\Login\Actions\GenerateAccessToken;
use Illuminate\Auth\AuthenticationException;
use function PHPUnit\Framework\assertIsString;

test('Generate access token', function () {

    $user = User::factory()->create();
    $generateAccessToken = resolve(GenerateAccessToken::class);

    $text = $generateAccessToken([
        "email" => $user->getAttribute('email'),
        "password" => "password"
    ]);

    assertIsString($text);

})->group('Unit', 'Login');


test('Generate access token with wrong credentials', function () {

    $user = User::factory()->create();

    $generateAccessToken = resolve(GenerateAccessToken::class);
    $text = $generateAccessToken([
        "email" => $user->getAttribute('email'),
        "password" => "password-wrong"
    ]);

    assertIsString($text);

})->group('Unit', 'Login')->throws(AuthenticationException::class);


