<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Contracts;

interface HttpClientInterface
{
    /**
     * @param string $url
     * @param array<string, mixed> $payload
     * @param array<string|int, mixed> $headers
     * @return array<string, mixed>
     */
    public function get(string $url, array $payload = [], array $headers = []): array;

    /**
     * @param string $url
     * @param array<string, mixed> $payload
     * @param array<string|int, mixed> $headers
     * @return array<string, mixed>
     */
    public function post(string $url, array $payload = [], array $headers = []): array;
}
