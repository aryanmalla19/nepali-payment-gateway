<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Epay;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentGateway;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Kbk\NepaliPaymentGateway\DTOs\EsewaRequestDTO;
use Kbk\NepaliPaymentGateway\DTOs\EsewaVerifyResponseDTO;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Http\CurlHttpClient;

final class Esewa extends BasePaymentGateway
{
    private readonly string $environment;

    const BASE_URLS = [
        'live' => [
            'url' => 'https://epay.esewa.com.np/api/epay/',
            'token' => '',
        ],
        'test' => [
            'url' => 'https://rc-epay.esewa.com.np/api/epay/',
            'token' => '',
        ]
    ];

    public function __construct(
        private readonly string $productCode,
        private readonly string $secretKey
    ) {
        parent::__construct(new CurlHttpClient()); // Use DI in future but right now we don't need it
        $this->environment = $this->productCode === 'EPAYTEST' ? 'test' : 'live';
    }

    /**
     * @throws InvalidPayloadException
     */
    public function payment(array $data): void
    {
        $dto = EsewaRequestDTO::fromArray($data);
        $url = self::BASE_URLS[$this->environment]['url'];

        $payload = [
            'product_code' => $this->productCode,
            ...$dto->toArray(),
        ];

        $payload['signature'] = esewa_signature_hash(
            $payload,
            $this->secretKey
        );

        $this->submitForm($url, $payload);
    }

    public function verify(array $data): BasePaymentVerifyResponse
    {
        $url = self::BASE_URLS[$this->environment]['url'] . 'transaction/status?' . http_build_query([
            'product_code' => $this->productCode,
            ...$data,
        ]);

        $response = $this->httpClient->get($url);

        return new EsewaVerifyResponseDTO($response);
    }
}