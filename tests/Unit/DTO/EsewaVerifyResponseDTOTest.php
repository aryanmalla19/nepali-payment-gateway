<?php

declare(strict_types=1);

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Tests\EsewaTestCase;

class EsewaVerifyResponseDTOTest extends EsewaTestCase
{
    public function test_it_should_return_correct_base_verify_response_class()
    {
        $this->assertInstanceOf(BasePaymentVerifyResponse::class, $this->verifyResponse);
    }

    public function test_it_should_return_correct_total_amount()
    {
        $this->assertEquals(100, $this->verifyResponse->getTotalAmount());
    }

    public function test_it_should_return_correct_transaction_uuid()
    {
        $this->assertEquals('123', $this->verifyResponse->getTransactionId());
    }

    public function test_it_should_return_correct_total_amount_in_paisa()
    {
        $this->assertEquals(10000, $this->verifyResponse->getTotalAmountInPaisa());
    }

    public function test_it_should_return_correct_product_code()
    {
        $this->assertEquals('EPAYTEST', $this->verifyResponse->getProductCode());
    }

    public function test_it_should_return_correct_reference_id()
    {
        $this->assertEquals(null, $this->verifyResponse->getReferenceId());
    }

    public function test_it_should_return_correct_status()
    {
        $this->assertEquals('complete', $this->verifyResponse->getStatus());
    }

    public function test_it_should_return_correct_array()
    {
        $this->assertEquals([
            'product_code' => 'EPAYTEST',
            'transaction_uuid' => '123',
            'total_amount' => 100.0,
            'status' => 'COMPLETE',
            'ref_id' => null,
        ], $this->verifyResponse->toArray());
    }
}
