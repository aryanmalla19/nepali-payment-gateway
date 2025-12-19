<?php

namespace Kbk\NepaliPaymentGateway\Validators;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;

class ConnectIpsConfig
{
    /**
     * @throws InvalidPayloadException
     */
    public static function construct(array $config): void
    {
        if(!filter_var($config['base_url'], FILTER_VALIDATE_URL)){
            throw new InvalidPayloadException('Base Url must be a valid url');
        }

        if(empty($config['merchant_id'])){
            throw new InvalidPayloadException('Merchant Id is required');
        }

        if(empty($config['app_id'])){
            throw new InvalidPayloadException('App Id is required');
        }

        if(empty($config['app_name'])){
            throw new InvalidPayloadException('App Name is required');
        }

        if(!file_exists($config['private_key_path'])){
            throw new InvalidPayloadException('Private Key Path - File does not exists');
        }

        if(empty($config['password'])){
            throw new InvalidPayloadException('Password is required');
        }
    }
}