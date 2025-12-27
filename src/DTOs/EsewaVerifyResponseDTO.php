<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;

class EsewaVerifyResponseDTO extends BasePaymentVerifyResponse
{
    public function isSuccess(): bool
    {
        return $this->status === 'complete';
    }

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return (float) $this->data['total_amount'];
    }

    /**
     * @return int
     */
    public function getTotalAmountInPaisa(): int
    {
        return (int) $this->data['total_amount'] * 100;
    }

    final public function getProductCode(): string
    {
        return $this->data['product_code'];
    }

    public function getTransactionId(): string
    {
        return $this->data['transaction_uuid'];
    }

    public function getReferenceId(): ?string
    {
        return $this->data['ref_id'] ?? null;
    }
}
