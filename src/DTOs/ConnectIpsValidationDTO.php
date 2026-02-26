<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Validators\ConnectIpsVerify;

class ConnectIpsValidationDTO
{
    private function __construct(
        private readonly string $referenceId,
        private readonly int $transactionAmount,
    ) {}

    /**
     * @param array<string, mixed> $data
     * @throws InvalidPayloadException
     * @return self
     */
    public static function fromArray(array $data): self
    {
        ConnectIpsVerify::validate($data);

        return new self(
            referenceId: $data['reference_id'],
            transactionAmount: $data['transaction_amount'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'referenceId' => $this->referenceId,
            'txnAmt' => $this->transactionAmount,
        ];
    }
}
