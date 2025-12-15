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
}