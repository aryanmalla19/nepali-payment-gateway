<?php

namespace Tests\Feature;

use http\Encoding\Stream\Enbrotli;
use Kbk\NepaliPaymentGateway\Epay\Esewa;
use Kbk\NepaliPaymentGateway\Epay\Khalti;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    public function test_it_should_throw_an_error_when_argument_is_not_passed()
    {
        $this->expectException(\ArgumentCountError::class);
        new Esewa();
    }

    public function test_it_should_throw_an_error_when_secret_key_is_not_passed()
    {
        $this->expectException(\ArgumentCountError::class);
        new Esewa('');
    }

    public function test_esewa_should_throw_an_exception_when_product_code_is_empty()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Product Code is required');
        new Esewa('', 'TEST');
    }

    public function test_esewa_should_throw_an_exception_when_secret_key_is_empty()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Secret Key is required');
        new Esewa('EPAYTEST', '');
    }

    public function test_khalti_should_throw_an_error_when_argument_is_not_passed()
    {
        $this->expectException(\ArgumentCountError::class);
        new Khalti();
    }

    public function test_khalti_should_throw_an_exception_when_secret_key_is_empty()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Secret Key is required');

        new Khalti('');
    }

    public function test_khalti_should_throw_an_exception_when_invalid_environment_is_passed()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Environment must be either Live or Test');

        new Khalti('TEST', 'invalid');
    }
}