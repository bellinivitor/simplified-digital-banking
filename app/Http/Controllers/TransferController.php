<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest;
use Domain\Transfers\Actions\TransferAction;
use Domain\Transfers\Resources\TransferResource;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function store(TransferRequest $request, TransferAction $transferAction)
    {
        return TransferResource::make(
            $transferAction()
        );
    }
}
