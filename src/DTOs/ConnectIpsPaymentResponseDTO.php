<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentResponse;

class ConnectIpsPaymentResponseDTO extends BasePaymentResponse
{
    /**
     * @return never
     */
    public function redirect(): never
    {
        $this->submitForm($this->data['url'], $this->data);
    }

    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->data['url'];
    }
}
