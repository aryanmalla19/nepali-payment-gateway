<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentResponse;

class KhaltiPaymentResponseDTO extends BasePaymentResponse
{
    public function redirect(): never
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
}
