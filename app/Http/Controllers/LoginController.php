<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Domain\Login\Actions\GenerateAccessToken;
use Domain\Login\Resources\LoginResource;
use Illuminate\Auth\AuthenticationException;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $loginRequest
     * @param GenerateAccessToken $generateAccessToken
     * @return LoginResource
     * @throws AuthenticationException
     */
    public function login(LoginRequest $loginRequest, GenerateAccessToken $generateAccessToken): LoginResource
    {
        return LoginResource::make(
            $generateAccessToken($loginRequest->validated()),
        );
    }
}
