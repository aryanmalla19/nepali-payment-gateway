<?php

namespace Kbk\NepaliPaymentGateway\Epay;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentGateway;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Kbk\NepaliPaymentGateway\DTOs\ConnectIpsDefaultDTO;
use Kbk\NepaliPaymentGateway\DTOs\ConnectIpsRequestDTO;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Http\CurlHttpClient;
use Kbk\NepaliPaymentGateway\Validators\ConnectIpsConfig;

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
    public function payment(array $data)
    {
        $requestDto = ConnectIpsRequestDTO::fromArray($data);
        $data = array_merge($requestDto->toArray(), $this->defaultDTO->toArray());
        $token = connectips_signature_hash($data, $this->defaultDTO->getPrivateKeyPath());

        $this->submitForm($this->defaultDTO->getBaseUrl(), ['TOKEN' => $token, ...$data]);
    }

    /**
     * @param array $data
     * @return BasePaymentVerifyResponse
     */
    public function verify(array $data): BasePaymentVerifyResponse
    {
        // TODO: Implement verify() method.
    }
}