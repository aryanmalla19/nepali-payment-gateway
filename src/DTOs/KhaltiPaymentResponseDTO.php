<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentResponse;

class KhaltiPaymentResponseDTO extends BasePaymentResponse
{
    public function redirect(): void
    {
        header('Location: ' . $this->data['payment_url']);
        exit();
    }

    public function getRedirectUrl(): string
    {
        return $this->data['payment_url'];
    }

    public function getPidx(): string
    {
        return $this->data['pidx'];
    }

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
}
