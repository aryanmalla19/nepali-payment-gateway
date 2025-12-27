<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;

final class ConnectIpsResponseDTO extends BasePaymentVerifyResponse
{
    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return (float) $this->data['txnAmt'] / 100;
    }

    /**
     * @return int
     */
    public function getTotalAmountInPaisa(): int
    {
        return (int) $this->data['txnAmt'];
    }

    public function getStatusDescription(): string
    {
        return $this->data['statusDesc'];
    }

    public function getReferenceId(): string
    {
        return $this->data['referenceId'];
    }

    public function getToken(): string
    {
        return $this->data['token'];
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->status === 'completed';
    }
}
