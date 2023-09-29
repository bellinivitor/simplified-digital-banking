<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest;
use App\Models\Identification;
use Domain\Transfers\Actions\TransferAction;
use Domain\Transfers\Exceptions\{InsufficientBalanceException, InvalidTransferValueException, NotAllowedToTransferExeption, OwnerNotRegistredException};
use Domain\Transfers\Resources\TransferResource;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @param TransferRequest $request
     * @param Identification $sender
     * @param Identification $recipient
     * @param TransferAction $transferAction
     * @return TransferResource
     * @throws InsufficientBalanceException
     * @throws InvalidTransferValueException
     * @throws NotAllowedToTransferExeption
     * @throws OwnerNotRegistredException
     */
    public function store(TransferRequest $request, Identification $sender, Identification $recipient, TransferAction $transferAction): TransferResource
    {
        return TransferResource::make(
            $transferAction($sender->accountHolder(), $recipient->accountHolder(), $request->validated('amount'), $request->user())
        );
    }
}
