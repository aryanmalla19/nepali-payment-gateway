<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentResponse;

class EsewaPaymentResponseDTO extends BasePaymentResponse
{
    /**
     * @return void
     */
    public function redirect(): void
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