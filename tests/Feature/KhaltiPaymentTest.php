<?php

declare(strict_types=1);

namespace Tests\Feature;

use Kbk\NepaliPaymentGateway\Epay\Khalti;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Tests\KhaltiTestCase;

class KhaltiPaymentTest extends KhaltiTestCase
{
    public function test_it_should_throw_an_error_when_argument_is_not_passed()
    {
        $this->expectException(\ArgumentCountError::class);
        new Khalti();
    }

    public function test_it_should_throw_an_exception_when_secret_key_is_empty()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Secret Key is required');

        new Khalti('');
    }

    public function test_it_should_throw_an_exception_when_invalid_environment_is_passed()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Environment must be either Live or Test');

        new Khalti('TEST', 'invalid');
    }
}
