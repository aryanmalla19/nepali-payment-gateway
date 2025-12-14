<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Http;

use Kbk\NepaliPaymentGateway\Contracts\HttpClientInterface;
use Kbk\NepaliPaymentGateway\Exceptions\HttpClientException;

class CurlHttpClient implements HttpClientInterface
{
    private array $headers = [
        'Content-Type: application/json',
        'Accept: application/json',
    ];

    /**
     * @throws HttpClientException
     */
    public function get(string $url, array $payload = [], array $headers = []): array
    {
        if(!empty($payload)){
            $url .= '?' . http_build_query($payload);
        }

        $ch = curl_init($url);

        if($ch === false){
            throw new HttpClientException('Failed to initialize cURL');
        }

        curl_setopt_array($ch, [
            CURLOPT_HTTPGET => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_HTTPHEADER => array(
                ...$this->headers,
                ...$headers,
            ),
        ]);

        return $this->executeRequest($ch);
    }

    /**
     * @throws HttpClientException
     */
    public function post(string $url, array $payload = [], array $headers = []): array
    {
        $ch = curl_init($url);

        if($ch === false){
            throw new HttpClientException('Failed to initialize cURL');
        }

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_HTTPHEADER => array(
                ...$this->headers,
                ...$headers,
            ),
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
        ]);

        return $this->executeRequest($ch);
    }

    /**
     * @throws HttpClientException
     */
    private function executeRequest($ch)
    {
        try {
            $response = curl_exec($ch);

            if($response === false){
                $errno = curl_errno($ch);
                $error = curl_error($ch);

                throw new HttpClientException("cURL transport error ({$errno}) $error");
            }

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if($httpCode >= 400){
                throw new HttpClientException("HTTP error {$httpCode}: {$response}");
            }

            $decode = json_decode($response, true);

            if(json_last_error() !== JSON_ERROR_NONE){
                throw new HttpClientException('Could not parse into JSON format: '. json_last_error_msg());
            }

            return $decode;
        } finally {
            curl_close($ch);
        }
    }
}