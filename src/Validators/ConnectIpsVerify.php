<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Validators;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;

class ConnectIpsVerify
{
    /**
     * @throws InvalidPayloadException
     */
    public static function validate(array $data): void
    {
        if (empty($data['transaction_amount']) || !is_numeric($data['transaction_amount'])) {
            throw new InvalidPayloadException('Transaction Amount must be require and numeric');
        }

        if ($data['transaction_amount'] < 0) {
            throw new InvalidPayloadException('Transaction Amount must be require and numeric');
        }

        if (empty($data['reference_id'])) {
            throw new InvalidPayloadException('Reference Id is required');
        }
    }
}
