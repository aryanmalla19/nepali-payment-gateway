<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;

class EsewaValidationRequestDTO
{
    private function __construct(
        public readonly float $totalAmount,
        public readonly string $transactionUuid,
    ) {}

    /**
     * @throws InvalidPayloadException
     */
    public static function fromArray(array $data): self
    {
        if (!isset($data['total_amount']) || !is_numeric($data['total_amount'])) {
            throw new InvalidPayloadException('Total Amount is required and must be a numeric value.');
        }

        if (empty($data['transaction_uuid'])) {
            throw new InvalidPayloadException('Transaction Uuid is required');
        }

        return new self(
            totalAmount: (float) $data['total_amount'],
            transactionUuid: $data['transaction_uuid'],
        );
    }

    public function toArray(): array
    {
        return [
            'total_amount' => $this->totalAmount,
            'transaction_uuid' => $this->transactionUuid,
        ];
    }
}
