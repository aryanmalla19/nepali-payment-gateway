<?php

declare(strict_types=1);

namespace Aryan\NepaliPaymentGateway\Http;

use Aryan\NepaliPaymentGateway\Contracts\HttpClientInterface;

class CurlHttpClient implements HttpClientInterface
{

    public function get(string $url, array $payload = [], array $headers = [])
    {
        // TODO: Implement get() method.
    }

    public function post(string $url, array $payload = [], array $headers = [])
    {
        // TODO: Implement post() method.
    }
}