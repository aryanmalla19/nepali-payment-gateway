<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Validators\ConnectIpsConfig;

class ConnectIpsDefaultDTO
{
    private function __construct(
        private readonly string $baseUrl,
        private readonly string $merchantId,
        private readonly string $appId,
        private readonly string $appName,
        private readonly string $privateKeyPath,
        private readonly string $password,
    ) {}

    /**
     * @param array<string, mixed> $data
     * @throws InvalidPayloadException
     * @return self
     */
    public static function fromArray(array $data): self
    {
        ConnectIpsConfig::validate($data);
        return new self(
            baseUrl: $data['base_url'],
            merchantId: $data['merchant_id'],
            appId: $data['app_id'],
            appName: $data['app_name'],
            privateKeyPath: $data['private_key_path'],
            password: $data['password'],
        );
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'MERCHANTID' => $this->merchantId,
            'APPID' => $this->appId,
            'APPNAME' => $this->appName,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArrayForVerify(): array
    {
        return [
            'merchantId' => $this->merchantId,
            'appId' => $this->appId,
        ];
    }

    /**
     * @return array<string>
     */
    public function getDefaultHeaders(): array
    {
        return [
            'Authorization: Basic ' . base64_encode($this->appId . ':' . $this->password),
        ];
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getPrivateKeyPath(): string
    {
        return $this->privateKeyPath;
    }
}
