<?php

declare(strict_types=1);

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Tests\KhaltiTestCase;

class KhaltiVerifyDTOTest extends KhaltiTestCase
{
    public function test_it_should_return_correct_base_verify_response_class()
    {
        $this->assertInstanceOf(BasePaymentVerifyResponse::class, $this->verifyResponse);
    }

    public function test_it_should_return_correct_pidx()
    {
        $this->assertEquals(self::PIDX, $this->verifyResponse->getPidx());
    }

    public function test_it_should_return_correct_total_amount()
    {
        $this->assertEquals(100, $this->verifyResponse->getTotalAmount());
    }

    public function test_it_should_return_correct_fee()
    {
        $this->assertEquals(0, $this->verifyResponse->getFee());
    }

    public function test_it_should_return_correct_fee_in_paisa()
    {
        $this->assertEquals(0, $this->verifyResponse->getFeeInPaisa());
    }

    public function test_it_should_return_correct_status()
    {
        $this->assertEquals('completed', $this->verifyResponse->getStatus());
    }

    public function test_it_should_return_correct_refunded()
    {
        $this->assertFalse($this->verifyResponse->isRefunded());
    }

    public function test_it_should_return_correct_success_value()
    {
        $this->assertFalse($this->verifyResponse->isRefunded());
    }

    public function test_it_should_return_correct_transaction_id()
    {
        $this->assertEquals('Js7jik7iCkcCik4exBK3F4', $this->verifyResponse->getTransactionId());
    }
}
