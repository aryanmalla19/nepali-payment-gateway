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
        new Esewa();
    }

    public function test_it_should_throw_an_error_when_secret_key_is_not_passed()
    {
        $this->expectException(\ArgumentCountError::class);
        new Esewa('');
    }

}