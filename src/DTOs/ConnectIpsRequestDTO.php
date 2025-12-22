<?php

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Validators\ConnectIpsPayment;

class ConnectIpsRequestDTO
{
    private function __construct(
        private readonly string $transactionId,
        private readonly string $transactionDate,
        private readonly string $transactionCurrency,
        private readonly string $transactionAmount,
        private readonly string $remarks,
        private readonly string $particulars,
        private readonly string $referenceId,
    )
    {}

    /**
     * @throws InvalidPayloadException
     */
    public static function fromArray(array $data): self
    {
        ConnectIpsPayment::validate($data);
        return new self(
            transactionId: $data['transaction_id'],
            transactionDate: $data['transaction_date'],
            transactionCurrency: strtoupper($data['transaction_currency']),
            transactionAmount: $data['transaction_amount'] * 100,
            remarks: $data['remarks'],
            particulars: $data['particulars'],
            referenceId: $data['reference_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'TXNID' => $this->transactionId,
            'TXNDATE' => $this->transactionDate,
            'TXNCRNCY' => $this->transactionCurrency,
            'TXNAMT' => $this->transactionAmount,
            'REFERENCEID' => $this->referenceId,
            'REMARKS' => $this->remarks,
            'PARTICULARS' => $this->particulars,
        ];
    }
}