<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Contracts;

abstract class BasePaymentGateway implements PaymentGatewayInterface
{
    public function __construct(private readonly HttpClientInterface $httpClient) {}
}
