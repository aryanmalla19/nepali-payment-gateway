<?php

namespace Tests\Feature;

use Kbk\NepaliPaymentGateway\Epay\Esewa;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    public function test_it_should_throw_an_error_when_argument_is_not_passed()
    {
        $this->expectException(\ArgumentCountError::class);
        $esewa = new Esewa();
    }

    public function test_it_should_throw_an_error_when_secret_key_is_not_passed()
    {
        $this->expectException(\ArgumentCountError::class);
        $esewa = new Esewa('');
    }

    public function test_it_should_throw_an_exception_when_total_amount_is_negative()
    {
        $this->expectException(InvalidPayloadException::class);
        $esewa = new Esewa('EPAYTEST', '3282733');
        $esewa->payment([
            'total_amount' => -1,
            'transaction_uuid' => uniqid(),
            'success_url' => 'https://example.com/success',
            'failure_url' => 'https://example.com/failure',
        ]);
    }

    public function test_it_should_throw_an_exception_when_total_amount_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $esewa = new Esewa('EPAYTEST', '3282733');
        $esewa->payment([
            'transaction_uuid' => uniqid(),
            'success_url' => 'https://example.com/success',
            'failure_url' => 'https://example.com/failure',
        ]);
    }

    public function test_it_should_throw_an_exception_when_transaction_uuid_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $esewa = new Esewa('EPAYTEST', '3282733');
        $esewa->payment([
            'total_amount' => 100,
            'success_url' => 'https://example.com/success',
            'failure_url' => 'https://example.com/failure',
        ]);
    }
}