<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Contracts;

interface HttpClientInterface
{
    public function get(string $url, array $payload=[], array $headers=[]);
    public function post(string $url, array $payload=[], array $headers=[]);
}