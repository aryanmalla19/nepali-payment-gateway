<?php

declare(strict_types=1);

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Epay\Esewa;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use PHPUnit\Framework\TestCase;

class EsewaRequestDTOTest extends TestCase
{
    public function test_it_should_throw_an_exception_when_total_amount_is_negative()
    {
        $this->expectException(InvalidPayloadException::class);
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
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
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $esewa->payment([
            'transaction_uuid' => uniqid(),
            'success_url' => 'https://example.com/success',
            'failure_url' => 'https://example.com/failure',
        ]);
    }

    public function test_it_should_throw_an_exception_when_transaction_uuid_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $esewa->payment([
            'amount' => 100,
            'success_url' => 'https://example.com/success',
            'failure_url' => 'https://example.com/failure',
        ]);
    }

    public function test_it_should_throw_an_exception_when_success_url_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
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
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
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
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $esewa->payment([
            'amount' => 100,
            'transaction_uuid' => uniqid(),
            'success_url' => 'It should fail',
            'failure_url' => 'https://example.com/failure',
        ]);
    }
}
