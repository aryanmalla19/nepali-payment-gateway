<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Epay;


use Kbk\NepaliPaymentGateway\Contracts\BasePaymentGateway;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Kbk\NepaliPaymentGateway\DTOs\KhaltiRequestDTO;
use Kbk\NepaliPaymentGateway\DTOs\KhaltiVerifyResponseDTO;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Http\CurlHttpClient;

final class Khalti extends BasePaymentGateway
{
    private readonly string $environment;
    private readonly string $secretKey;
    private readonly array $headers;

    const BASE_URLS = [
        'live' => [
            'url' => 'https://khalti.com/api/',
            'token' => '',
        ],
        'test' => [
            'url' => 'https://dev.khalti.com/api/',
            'token' => '',
        ],
    ];

    /**
     * @throws InvalidPayloadException
     */
    public function __construct(string $secretKey, string $environment='test')
    {
        parent::__construct(new CurlHttpClient()); // Use DI but for package no DI is good (Change in future if needed)

        if(!in_array($environment, ['live', 'test'])){
            throw new InvalidPayloadException('Environment must be either Live or Test');
        }

        if(empty($secretKey)){
            throw new InvalidPayloadException('Secret Key is required');
        }

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
        $url = self::BASE_URLS[$this->environment]['url'] . 'v2/epayment/initiate/';
        $dto = KhaltiRequestDTO::fromArray($data);

        $response = $this->httpClient->post($url, $dto->toArray(), $this->headers);

        header('Location: ' . $response['payment_url']);
    }

    /**
     * @throws InvalidPayloadException
     */
    public function verify(array $data): BasePaymentVerifyResponse
    {
        $url = self::BASE_URLS[$this->environment]['url'] . 'v2/epayment/lookup/';

        if(!isset($data['pidx'])){
            throw new InvalidPayloadException('Pidx is required');
        }

        $response = $this->httpClient->post($url, $data, $this->headers);

        return new KhaltiVerifyResponseDTO($response);
    }

    public function refund(string $transactionId, ?int $amount=null)
    {
        $url = self::BASE_URLS[$this->environment]['url'] . "merchant-transaction/{$transactionId}/refund/";

        return $this->httpClient->post($url, [
            'amount' => $amount,
        ], $this->headers);
    }

    /**
     * @throws InvalidPayloadException
     */
    public function getBankList(string $paymentType='ebanking')
    {
        if(!in_array($paymentType, ['ebanking', 'mobilecheckout'])){
            throw new InvalidPayloadException('Payment Type must be ebanking or mobilecheckout');
        }

        $url = self::BASE_URLS['live']['url'] . '/v5/bank/?payment_type=' . $paymentType;

        return $this->httpClient->get($url);
    }
}