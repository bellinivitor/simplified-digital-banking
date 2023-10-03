<?php

namespace Domain\Transfers\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return ["new_balance" => $this->resource];
    }
}
