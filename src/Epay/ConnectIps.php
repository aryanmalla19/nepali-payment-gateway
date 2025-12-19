<?php

namespace Kbk\NepaliPaymentGateway\Epay;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentGateway;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Kbk\NepaliPaymentGateway\Http\CurlHttpClient;
use Kbk\NepaliPaymentGateway\Validators\ConnectIpsConfig;

final class ConnectIps extends BasePaymentGateway
{
    /**
     * @throws InvalidPayloadException
     */
    public function __construct(
        private readonly string $base_url,
        private readonly string $merchant_id,
        private readonly string $app_id,
        private readonly string $app_name,
        private readonly string $private_key_path,
        private readonly string $password,
    )
    {
        parent::__construct(new CurlHttpClient()); // Use DI but not right now in this package
        ConnectIpsConfig::construct(get_defined_vars());
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function payment(array $data)
    {
        // TODO: Implement payment() method.
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