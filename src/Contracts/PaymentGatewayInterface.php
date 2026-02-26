<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Contracts;

interface PaymentGatewayInterface
{
    /**
     * @param array<string, mixed> $data
     * @return BasePaymentResponse
     */
    public function payment(array $data): BasePaymentResponse;

    /**
     * @param array<string, mixed> $data
     * @return BasePaymentVerifyResponse
     */
    public function verify(array $data): BasePaymentVerifyResponse;
}
