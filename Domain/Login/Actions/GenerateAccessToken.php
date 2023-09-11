<?php

namespace Domain\Login\Actions;

use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

readonly class GenerateAccessToken
{

    /**
     * @param array $credentials
     * @return string
     * @throws AuthenticationException
     */
    public function __invoke(array $credentials): string
    {
        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException('invalid credentials');
        }

        $expiration = Carbon::now()->addMinutes(config('app.lifetime'));
        return Auth::user()->createToken(Auth::user()->name, expiresAt: $expiration)->plainTextToken;
    }

}
