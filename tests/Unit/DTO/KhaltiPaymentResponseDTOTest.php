<?php

declare(strict_types=1);

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentResponse;
use Tests\KhaltiTestCase;

class KhaltiPaymentResponseDTOTest extends KhaltiTestCase
{
    public function test_khalti_should_return_base_payment_class()
    {
        $this->assertInstanceOf(BasePaymentResponse::class, $this->paymentResponse);
    }

    public function test_khalti_should_return_redirect_url()
    {
        $this->assertEquals('https://test-pay.khalti.com/?pidx=' . $this->paymentResponse->getPidx(), $this->paymentResponse->getRedirectUrl());
    }

    public function test_khalti_should_return_pidx()
    {
        $this->assertEquals($this->paymentResponse->toArray()['pidx'], $this->paymentResponse->getPidx());
    }

    public function test_khalti_should_return_transaction_id()
    {
        $this->assertEquals($this->paymentResponse->toArray()['pidx'], $this->paymentResponse->getPidx());
    }
}