<?php

declare(strict_types=1);

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use Tests\EsewaTestCase;

class EsewaRequestDTOTest extends EsewaTestCase
{
    public function test_it_should_throw_an_exception_when_total_amount_is_negative()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Amount must be a positive integer');

        $this->makePayment(['amount' => -1]);
    }

    public function test_it_should_throw_an_exception_when_amount_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);

        $this->expectExceptionMessage('Amount is required');

        $this->makePayment(['amount' => null]);
    }

    public function test_it_should_throw_an_exception_when_success_url_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Invalid success URL');

        $this->makePayment(['success_url' => null]);
    }

    public function test_it_should_throw_an_exception_when_failure_url_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Invalid failure URL');

        $this->makePayment(['failure_url' => null]);
    }

    public function test_it_should_throw_an_exception_when_success_url_is_invalid()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Invalid success URL');

        $this->makePayment(['success_url' => 'not-valid-url']);
    }
}
