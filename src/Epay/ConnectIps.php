<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Epay;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentGateway;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentResponse;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Kbk\NepaliPaymentGateway\DTOs\ConnectIpsDefaultDTO;
use Kbk\NepaliPaymentGateway\DTOs\ConnectIpsPaymentResponseDTO;
use Kbk\NepaliPaymentGateway\DTOs\ConnectIpsRequestDTO;
use Kbk\NepaliPaymentGateway\DTOs\ConnectIpsResponseDTO;
use Kbk\NepaliPaymentGateway\DTOs\ConnectIpsValidationDTO;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Http\CurlHttpClient;

final class ConnectIps extends BasePaymentGateway
{
    private ConnectIpsDefaultDTO $defaultDTO;
    /**
     * @throws InvalidPayloadException
     */
    public function __construct(array $data)
    {
        parent::__construct(new CurlHttpClient()); // Use DI but not right now in this package
        $this->defaultDTO = ConnectIpsDefaultDTO::fromArray($data);
    }

    /**
     * @param array $data
     * @return mixed
     * @throws InvalidPayloadException
     */
    public function payment(array $data): BasePaymentResponse
    {
        $requestDto = ConnectIpsRequestDTO::fromArray($data);
        $data = array_merge($requestDto->toArray(), $this->defaultDTO->toArray());
        $token = connectips_signature_hash($data, $this->defaultDTO->getPrivateKeyPath());
        $url = $this->defaultDTO->getBaseUrl() . '/connectipswebgw/loginpage';

        return new ConnectIpsPaymentResponseDTO([
            'url' => $url,
            'TOKEN' => $token,
            ...$data,
        ]);
    }

    /**
     * @param array $data
     * @return ConnectIpsResponseDTO
     * @throws InvalidPayloadException
     */
    public function verify(array $data): ConnectIpsResponseDTO
    {
        $url = $this->defaultDTO->getBaseUrl() . '/connectipswebws/api/creditor/validatetxn';
        $dto = ConnectIpsValidationDTO::fromArray($data);
        $data = array_merge($this->defaultDTO->toArrayForVerify(), $dto->toArray());
        $token = connectips_signature_hash_verify($data, $this->defaultDTO->getPrivateKeyPath());

        $payload = [
            'token' => $token,
            ...$data,
        ];

        $response = $this->httpClient->post($url, $payload, $this->defaultDTO->getDefaultHeaders());

        return new ConnectIpsResponseDTO($response);
    }

    public function detail(array $data): BasePaymentVerifyResponse
    {
        $url = $this->defaultDTO->getBaseUrl() . '/connectipswebws/api/creditor/gettxndetail';
        $dto = ConnectIpsValidationDTO::fromArray($data);
        $data = array_merge($this->defaultDTO->toArrayForVerify(), $dto->toArray());
        $token = connectips_signature_hash_verify($data, $this->defaultDTO->getPrivateKeyPath());

        $payload = [
            'token' => $token,
            ...$data,
        ];

        $response = $this->httpClient->post($url, $payload, $this->defaultDTO->getDefaultHeaders());

        return new ConnectIpsResponseDTO($response);
    }
}
