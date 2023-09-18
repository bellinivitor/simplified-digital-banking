<?php

namespace Domain\Transfers\Actions;

use App\Models\Shopkeeper;
use Domain\Transfers\Exceptions\InsufficientBalanceException;
use Domain\Transfers\Exceptions\InvalidTransferValueException;
use Domain\Transfers\Exceptions\NotAllowedToTransferExeption;
use Domain\Users\Interfaces\AccountHolderInterface;
use Domain\Wallet\Actions\DescountValueOfTransferAction;
use Domain\Wallet\Actions\ReceiveTransferAction;
use Exception;
use Illuminate\Support\Facades\DB;
use function __;

readonly class TransferAction
{
    public function __construct(
        public ReceiveTransferAction         $receiveTransferAction,
        public DescountValueOfTransferAction $descountValueOfTransferAction,
    )
    {
    }

    /**
     * @param AccountHolderInterface $sender
     * @param AccountHolderInterface $recipient
     * @param float $amount
     * @return float
     * @throws InsufficientBalanceException
     * @throws InvalidTransferValueException
     * @throws NotAllowedToTransferExeption
     */
    public function __invoke(AccountHolderInterface $sender, AccountHolderInterface $recipient, float $amount): float
    {
        if ($sender instanceof Shopkeeper) {
            throw new NotAllowedToTransferExeption('Shopkeepers cannot make transfers');
        }

        if ($amount <= 0) {
            throw  new InvalidTransferValueException(__('The amount must be greater than zero to make the transfer'));
        }

        try {
            DB::beginTransaction();

            ($this->descountValueOfTransferAction)($sender->getWallet(), $amount);
            ($this->receiveTransferAction)($recipient->getWallet(), $amount);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $sender->getWallet()->balance;
    }
}
