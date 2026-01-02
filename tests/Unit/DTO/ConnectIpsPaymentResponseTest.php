<?php

declare(strict_types=1);

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Tests\ConnectIpsTestCase;

class ConnectIpsPaymentResponseTest extends ConnectIpsTestCase
{
    public function test_it_should_thrown_an_exception_when_transaction_amount_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Transaction Amount is required and must be numeric');
        $this->makePayment(['transaction_amount' => null]);
    }

    public function test_it_should_thrown_an_exception_when_transaction_amount_is_invalid()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Transaction Amount is required and must be numeric');
        $this->makePayment(['transaction_amount' => -1]);
    }

    public function test_it_should_thrown_an_exception_when_remarks_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Remarks is required');
        $this->makePayment(['remarks' => null]);
    }

    public function test_it_should_thrown_an_exception_when_particulars_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Particulars is required');
        $this->makePayment(['particulars' => null]);
    }

    public function test_it_should_thrown_an_exception_when_reference_id_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Reference Id is required');
        $this->makePayment(['reference_id' => null]);
    }

    public function test_it_should_thrown_an_exception_when_transaction_date_is_invalid()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Transaction Date format is invalid. It should be DD-MM-YYYY');
        $this->makePayment(['transaction_date' => 'invalid-format']);
    }
}
