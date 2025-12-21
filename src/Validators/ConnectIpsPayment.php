<?php

namespace Kbk\NepaliPaymentGateway\Validators;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;

class ConnectIpsPayment
{
    /**
     * @throws InvalidPayloadException
     */
    public static function validate(array $config): void
    {
        if(empty($config['transaction_id'])){
            throw new InvalidPayloadException('Transaction Id is required');
        }

        if(empty($config['transaction_date'])){
            throw new InvalidPayloadException('Transaction Date is required');
        }

        if(empty($config['transaction_currency'])){
            throw new InvalidPayloadException('Transaction Currency is required');
        }

        if(empty($config['transaction_amount']) || is_numeric($config['transaction_amount'])){
            throw new InvalidPayloadException('Transaction Amount is required and must be numeric');
        }

        if(empty($config['remarks'])){
            throw new InvalidPayloadException('Remarks is required');
        }

        if(empty($config['particulars'])){
            throw new InvalidPayloadException('Particulars is required');
        }

        if (empty($config['reference_id'])) {
            throw new InvalidPayloadException('Reference Id is required');
        }
    }
}