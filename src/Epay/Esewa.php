<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Epay;

use JetBrains\PhpStorm\NoReturn;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentGateway;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Kbk\NepaliPaymentGateway\Contracts\HttpClientInterface;
use Kbk\NepaliPaymentGateway\DTOs\EsewaRequestDTO;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Http\CurlHttpClient;

final class Esewa extends BasePaymentGateway
{
    private string $environment;

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
        private string $productCode,
        private string $secretKey
    ) {
        parent::__construct(new CurlHttpClient()); // Use DI in future but right now we don't need it
        $this->environment = $this->productCode === 'EPAYTEST' ? 'test' : 'live';
    }

    /**
     * @throws InvalidPayloadException
     */
    #[NoReturn]
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
        // TODO: Implement verify() method.
    }
}