<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;

final class KhaltiVerifyResponseDTO extends BasePaymentVerifyResponse
{
    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return (float) $this->data['total_amount'] / 100;
    }

    /**
     * @return mixed
     */
    public function getTotalAmountInPaisa(): int
    {
        return (int) $this->data['total_amount'];
    }

    public function getPidx(): string
    {
        return $this->data['pidx'];
    }

    public function getTransactionId(): string
    {
        return $this->data['transaction_id'];
    }

    public function getFee(): float
    {
        return (float) $this->data['fee'] / 100;
    }

    public function getFeeInPaisa(): int
    {
        return (int) $this->data['fee'];
    }

    public function isRefunded(): bool
    {
        return (bool) $this->data['refunded'];
    }

    public function isInitiated(): bool
    {
        return $this->status === 'initiated';
    }

    public function isExpired(): bool
    {
        return $this->status === 'expired';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'user canceled';
    }

    public function isPartiallyRefunded(): bool
    {
        return $this->status === 'partially refunded';
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->status == 'completed';
    }
}
