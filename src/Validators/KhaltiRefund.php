<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Validators;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;

final class KhaltiRefund
{
    /**
     * @throws InvalidPayloadException
     */
    public static function validate(array $config): void
    {
        self::validateTransactionId($config);
        self::validateAmount($config);
        self::validateMobile($config);
    }

    /**
     * @throws InvalidPayloadException
     */
    private static function validateTransactionId(array $config): void
    {
        if (!array_key_exists('transaction_id', $config)) {
            throw new InvalidPayloadException('Transaction Id is required');
        }
    }

    /**
     * @throws InvalidPayloadException
     */
    private static function validateAmount(array $config): void
    {
        if (!array_key_exists('amount', $config)) {
            return;
        }

        if (!is_numeric($config['amount']) || $config['amount'] <= 0) {
            throw new InvalidPayloadException('Amount must be a positive number');
        }
    }

    /**
     * @throws InvalidPayloadException
     */
    private static function validateMobile(array $config): void
    {
        if (!array_key_exists('mobile', $config)) {
            return;
        }

        if (!preg_match('/^\d{10}$/', (string) $config['mobile'])) {
            throw new InvalidPayloadException('Mobile number must be exactly 10 digits');
        }
    }
}
