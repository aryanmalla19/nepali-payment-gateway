<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Validators\ConnectIpsVerify;

class ConnectIpsValidationDTO
{
    private function __construct(
        private readonly string $referenceId,
        private readonly float $transactionAmount,
    ) {}

    /**
     * @throws InvalidPayloadException
     */
    public static function fromArray(array $data): self
    {
        ConnectIpsVerify::validate($data);

        return new self(
            referenceId: $data['reference_id'],
            transactionAmount: $data['transaction_amount'],
        );
    }

    public function toArray(): array
    {
        return [
            'referenceId' => $this->referenceId,
            'txmAmt' => $this->transactionAmount,
        ];
    }
}
