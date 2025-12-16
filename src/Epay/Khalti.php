<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Epay;


use Kbk\NepaliPaymentGateway\Contracts\BasePaymentGateway;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Kbk\NepaliPaymentGateway\DTOs\KhaltiRequestDTO;
use Kbk\NepaliPaymentGateway\DTOs\KhaltiVerifyResponseDTO;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Http\CurlHttpClient;

class Khalti extends BasePaymentGateway
{
    private readonly string $environment;
    private readonly string $secretKey;
    private readonly array $headers;

    const BASE_URLS = [
        'live' => [
            'url' => 'https://khalti.com/api/v2/',
            'token' => '',
        ],
        'test' => [
            'url' => 'https://dev.khalti.com/api/v2/',
            'token' => '',
        ],
    ];

    public function __construct(string $secretKey, string $environment='test')
    {
        parent::__construct(new CurlHttpClient()); // Use DI but for package no DI is good (Change in future if needed)
        $this->environment = $environment;
        $this->secretKey = $secretKey;
        $this->headers = [
            'Authorization: key ' . $this->secretKey,
        ];
    }

    /**
     * @throws InvalidPayloadException
     */
    public function payment(array $data): void
    {
        $url = self::BASE_URLS[$this->environment]['url'] . 'epayment/initiate/';
        $dto = KhaltiRequestDTO::fromArray($data);

        $response = $this->httpClient->post($url, $dto->toArray(), $this->headers);
//        echo $response['payment_url'];
        header('Location: ' . $response['payment_url']);
    }

    /**
     * @throws InvalidPayloadException
     */
    public function verify(array $data): BasePaymentVerifyResponse
    {
        $url = self::BASE_URLS[$this->environment]['url'] . 'epayment/lookup/';
        if(!isset($data['pidx'])){
            throw new InvalidPayloadException('Pidx is required');
        }

        $response = $this->httpClient->post($url, [], $this->headers);

        return new KhaltiVerifyResponseDTO($response);
    }
}