<?php

namespace Tests\Feature;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
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
            'amount' => -1,
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
            'amount' => 100,
            'success_url' => 'https://example.com/success',
            'failure_url' => 'https://example.com/failure',
        ]);
    }

    public function test_it_should_throw_an_exception_when_success_url_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $esewa = new Esewa('EPAYTEST', '3282733');
        $this->expectExceptionMessage('Invalid success URL');
        $esewa->payment([
            'amount' => 100,
            'transaction_uuid' => uniqid(),
            'failure_url' => 'https://example.com/failure',
        ]);
    }

    public function test_it_should_throw_an_exception_when_failure_url_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Invalid failure URL');
        $esewa = new Esewa('EPAYTEST', '3282733');
        $esewa->payment([
            'amount' => 100,
            'transaction_uuid' => uniqid(),
            'success_url' => 'https://example.com/success',
        ]);
    }

    public function test_it_should_throw_an_exception_when_success_url_is_invalid()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Invalid success URL');
        $esewa = new Esewa('EPAYTEST', '3282733');
        $esewa->payment([
            'amount' => 100,
            'transaction_uuid' => uniqid(),
            'success_url' => 'It should fail',
            'failure_url' => 'https://example.com/failure',
        ]);
    }

    public function test_it_should_throw_an_exception_when_total_amount_is_non_numeric()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Total Amount is required and must be a numeric value.');
        $esewa = new Esewa('EPAYTEST', '3282733');
        $esewa->verify([
            'totalAmount' => -1,
            'transactionUuid' => uniqid(),
        ]);
    }

    public function test_it_should_throw_an_exception_when_total_amount_is_non_numeric_in_validation()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Total Amount is required and must be a numeric value.');
        $esewa = new Esewa('EPAYTEST', '3282733');
        $esewa->verify([
            'totalAmount' => -1,
            'transactionUuid' => uniqid(),
        ]);
    }

    public function test_it_should_throw_an_exception_when_total_amount_is_missing_in_validation()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Total Amount is required and must be a numeric value.');
        $esewa = new Esewa('EPAYTEST', '3282733');
        $esewa->verify([
            'transactionUuid' => uniqid(),
        ]);
    }

    public function test_it_should_throw_an_exception_when_transaction_uuid_is_missing_in_validation()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Transaction Uuid is required');
        $esewa = new Esewa('EPAYTEST', '3282733');
        $esewa->verify([
            'total_amount' => 100,
        ]);
    }

    public function test_it_should_return_correct_base_verify_response_class()
    {
        $esewa = new Esewa('EPAYTEST', '3282733');
        $response = $esewa->verify([
            'total_amount' => 100,
            'transaction_uuid' => '123',
        ]);

        $this->assertInstanceOf(BasePaymentVerifyResponse::class, $response);
    }
}