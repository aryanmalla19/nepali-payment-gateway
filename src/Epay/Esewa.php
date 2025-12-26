<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Epay;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentGateway;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentResponse;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Kbk\NepaliPaymentGateway\DTOs\EsewaPaymentResponseDTO;
use Kbk\NepaliPaymentGateway\DTOs\EsewaRequestDTO;
use Kbk\NepaliPaymentGateway\DTOs\EsewaValidationRequestDTO;
use Kbk\NepaliPaymentGateway\DTOs\EsewaVerifyResponseDTO;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Http\CurlHttpClient;

final class Esewa extends BasePaymentGateway
{
    private readonly string $environment;

    public const BASE_URLS = [
        'live' => [
            'url' => 'https://epay.esewa.com.np/api/epay/',
        ],
        'test' => [
            'url' => 'https://rc-epay.esewa.com.np/api/epay/',
        ],
    ];

    /**
     * @throws InvalidPayloadException
     */
    public function __construct(
        private readonly string $productCode,
        private readonly string $secretKey,
    ) {
        parent::__construct(new CurlHttpClient()); // Use DI in future but right now we don't need it

        if (empty($this->productCode)) {
            throw new InvalidPayloadException('Product Code is required');
        }

        if (empty($this->secretKey)) {
            throw new InvalidPayloadException('Secret Key is required');
        }

        $this->environment = $this->productCode === 'EPAYTEST' ? 'test' : 'live';
    }

    /**
     * @throws InvalidPayloadException
     */
    public function payment(array $data): BasePaymentResponse
    {
        $dto = EsewaRequestDTO::fromArray($data);
        $url = self::BASE_URLS[$this->environment]['url'] . 'main/v2/form';

        $payload = [
            'product_code' => $this->productCode,
            ...$dto->toArray(),
        ];

        $payload['signature'] = esewa_signature_hash(
            $payload,
            $this->secretKey,
        );

        return new EsewaPaymentResponseDTO(['url' => $url, ...$payload,]);
    }

    /**
     * @throws InvalidPayloadException
     */
    public function verify(array $data): BasePaymentVerifyResponse
    {
        $dto = EsewaValidationRequestDTO::fromArray($data);

        $url = self::BASE_URLS[$this->environment]['url'] . 'transaction/status?' . http_build_query([
            'product_code' => $this->productCode,
            ...$dto->toArray(),
        ]);

        $response = $this->httpClient->get($url);

        return new EsewaVerifyResponseDTO($response);
    }
}
