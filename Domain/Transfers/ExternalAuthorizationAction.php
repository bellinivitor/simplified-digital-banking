<?php

namespace Domain\Transfers;

use Domain\Transfers\Exceptions\UnauthorizedTransfer;
use Illuminate\Support\Facades\Http;
use function rand;

class ExternalAuthorizationAction
{

    /**
     * @throws UnauthorizedTransfer
     */
    public function __invoke(): void
    {
        //links com status: [503, 200]
        $links = ['https://run.mocky.io/v3/9e06a782-a102-4473-9935-50e1acf28769', 'https://run.mocky.io/v3/25944129-a2c9-445e-ad20-b66048c8ec91'];

        $response = Http::get($links[rand(0, 1)]);

        if ($response->serverError() || $response->clientError()) {
            throw new UnauthorizedTransfer('Unauthorized Transfer');
        }
    }
}
