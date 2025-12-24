<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentResponse;

class KhaltiPaymentResponse extends BasePaymentResponse
{
    public function redirect(): void
    {
        header('Location :' . $this->data['payment_url']);
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