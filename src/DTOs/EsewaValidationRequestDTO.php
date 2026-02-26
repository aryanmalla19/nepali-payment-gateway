<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;

class EsewaValidationRequestDTO
{
    private function __construct(
        public readonly int $totalAmount,
        public readonly string $transactionUuid,
    ) {}

    /**
     * @param array<string, mixed> $data
     * @throws InvalidPayloadException
     * @return self
     */
    public static function fromArray(array $data): self
    {
        if (!isset($data['total_amount']) || !is_numeric($data['total_amount'])) {
            throw new InvalidPayloadException('Total Amount is required and must be a numeric value.');
        }

        if ($data['total_amount'] < 0) {
            throw new InvalidPayloadException('Total Amount must be grater than 0');
        }

        if (empty($data['transaction_uuid'])) {
            throw new InvalidPayloadException('Transaction Uuid is required');
        }

        return new self(
            totalAmount: (int) $data['total_amount'],
            transactionUuid: $data['transaction_uuid'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'total_amount' => $this->totalAmount,
            'transaction_uuid' => $this->transactionUuid,
        ];
    }
}
