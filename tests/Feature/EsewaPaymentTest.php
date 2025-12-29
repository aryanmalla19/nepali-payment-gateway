<?php

declare(strict_types=1);

namespace Tests\Feature;

use Kbk\NepaliPaymentGateway\Epay\Esewa;
use Kbk\NepaliPaymentGateway\Epay\Khalti;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use PHPUnit\Framework\TestCase;

class EsewaPaymentTest extends TestCase
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

    public function test_it_should_throw_an_exception_when_product_code_is_empty()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Product Code is required');
        new Esewa('', 'TEST');
    }

    public function test_it_should_throw_an_exception_when_secret_key_is_empty()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Secret Key is required');
        new Esewa('EPAYTEST', '');
    }
}
