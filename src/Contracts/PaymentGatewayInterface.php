<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Contracts;

interface PaymentGatewayInterface
{
    public function payment(array $data): BasePaymentVerifyResponse;
    public function verify(array $data): BasePaymentVerifyResponse;
}