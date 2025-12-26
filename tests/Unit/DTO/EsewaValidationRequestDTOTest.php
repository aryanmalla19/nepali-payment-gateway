<?php

declare(strict_types=1);

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Epay\Esewa;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use PHPUnit\Framework\TestCase;

class EsewaValidationRequestDTOTest extends TestCase
{
    public function test_it_should_throw_an_exception_when_total_amount_is_non_numeric()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Total Amount is required and must be a numeric value.');
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $esewa->verify([
            'totalAmount' => -1,
            'transactionUuid' => uniqid(),
        ]);
    }

    public function test_it_should_throw_an_exception_when_total_amount_is_non_numeric_in_validation()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Total Amount is required and must be a numeric value.');
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $esewa->verify([
            'totalAmount' => -1,
            'transactionUuid' => uniqid(),
        ]);
    }

    public function test_it_should_throw_an_exception_when_total_amount_is_missing_in_validation()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Total Amount is required and must be a numeric value.');
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $esewa->verify([
            'transactionUuid' => uniqid(),
        ]);
    }

    public function test_it_should_throw_an_exception_when_transaction_uuid_is_missing_in_validation()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Transaction Uuid is required');
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $esewa->verify([
            'total_amount' => 100,
        ]);
    }
}
