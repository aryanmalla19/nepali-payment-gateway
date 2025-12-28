<?php

declare(strict_types=1);

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Tests\EsewaTestCase;

class EsewaValidationRequestDTOTest extends EsewaTestCase
{
    public function test_it_should_throw_an_exception_when_total_amount_is_non_numeric_in_validation()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Total Amount must be grater than 0');

        $this->verifyPayment(['total_amount' => -1]);
    }

    public function test_it_should_throw_an_exception_when_total_amount_is_missing_in_validation()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Total Amount is required and must be a numeric value.');
        $this->verifyPayment(['total_amount' => null]);
    }

    public function test_it_should_throw_an_exception_when_transaction_uuid_is_missing_in_validation()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Transaction Uuid is required');

        $this->verifyPayment(['transaction_uuid' => null]);
    }
}
