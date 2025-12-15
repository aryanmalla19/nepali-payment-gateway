<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;

class EsewaRequestDTO
{
    private function __construct(
        public readonly string $successUrl,
        public readonly string $failureUrl,
        public readonly float $totalAmount,
        public readonly string $transactionId,
        public readonly float $taxAmount,
        public readonly float $amount,
        public readonly float $productServiceCharge,
        public readonly float $productDeliveryCharge,
    )
    {}

    /**
     * @throws InvalidPayloadException
     */
    public static function fromArray(array $data): self
    {
        if (!isset($data['total_amount'])) {
            throw new InvalidPayloadException('Total Amount is required');
        }

        if (!is_numeric($data['total_amount']) || $data['total_amount'] <= 0) {
            throw new InvalidPayloadException('Amount must be a positive integer');
        }

        if (empty($data['transaction_uuid'])) {
            throw new InvalidPayloadException('Transaction UUID is required');
        }

        if (empty($data['failure_url']) || !filter_var($data['failure_url'], FILTER_VALIDATE_URL)) {
            throw new InvalidPayloadException('Invalid failure URL');
        }

        if(empty($data['success_url']) || !filter_var($data['success_url'], FILTER_VALIDATE_URL)) {
            throw new InvalidPayloadException('Invalid success URL');
        }

        return new self(
            successUrl: $data['success_url'],
            failureUrl: $data['failure_url'],
            totalAmount: (float) $data['total_amount'],
            transactionId: (string) $data['transaction_uuid'],
            taxAmount: (float) ($data['tax_amount'] ?? 0),
            amount: (float) ($data['amount'] ?? 0),
            productServiceCharge: (float) ($data['product_service_charge'] ?? 0),
            productDeliveryCharge: (float) ($data['product_delivery_charge'] ?? 0),
        );

    }

    public function toArray(): array
    {
        return [
            'success_url' => $this->successUrl,
            'failure_url' => $this->failureUrl,
            'total_amount' => $this->totalAmount,
            'amount' => $this->amount,
            'tax_amount' => $this->taxAmount,
            'product_service_charge' => $this->productServiceCharge,
            'product_delivery_charge' => $this->productDeliveryCharge,
            'transaction_uuid' => $this->transactionId,
            'signed_field_names' => 'total_amount,transaction_uuid,product_code',
        ];
    }
}