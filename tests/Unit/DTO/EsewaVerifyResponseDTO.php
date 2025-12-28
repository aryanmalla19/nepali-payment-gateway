<?php

declare(strict_types=1);

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Kbk\NepaliPaymentGateway\Epay\Esewa;
use PHPUnit\Framework\TestCase;

class EsewaVerifyResponseDTO extends TestCase
{
    public function test_it_should_return_correct_base_verify_response_class()
    {
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $response = $esewa->verify([
            'total_amount' => 100,
            'transaction_uuid' => '123',
        ]);

        $this->assertInstanceOf(BasePaymentVerifyResponse::class, $response);
    }

    public function test_it_should_return_correct_total_amount()
    {
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $response = $esewa->verify([
            'total_amount' => 100,
            'transaction_uuid' => '123',
        ]);

        $this->assertEquals(100, $response->getTotalAmount());
    }

    public function test_it_should_return_correct_transaction_uuid()
    {
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $response = $esewa->verify([
            'total_amount' => 100,
            'transaction_uuid' => '123',
        ]);

        $this->assertEquals('123', $response->getTransactionId());
    }

    public function test_it_should_return_correct_total_amount_in_paisa()
    {
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $response = $esewa->verify([
            'total_amount' => 100,
            'transaction_uuid' => '123',
        ]);

        $this->assertEquals(10000, $response->getTotalAmountInPaisa());
    }

    public function test_it_should_return_correct_product_code()
    {
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $response = $esewa->verify([
            'total_amount' => 100,
            'transaction_uuid' => '123',
        ]);

        $this->assertEquals('EPAYTEST', $response->getProductCode());
    }

    public function test_it_should_return_correct_reference_id()
    {
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $response = $esewa->verify([
            'total_amount' => 100,
            'transaction_uuid' => '123',
        ]);

        $this->assertEquals(null , $response->getReferenceId());
    }

    public function test_it_should_return_correct_status()
    {
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $response = $esewa->verify([
            'total_amount' => 100,
            'transaction_uuid' => '123',
        ]);

        $this->assertEquals('complete' , $response->getStatus());
    }

    public function test_it_should_return_correct_array()
    {
        $esewa = new Esewa('EPAYTEST', '8gBm/:&EnhH.1/q');
        $response = $esewa->verify([
            'total_amount' => 100,
            'transaction_uuid' => '123',
        ]);

        $this->assertEquals([
            'product_code' => 'EPAYTEST',
            'transaction_uuid' => '123',
            'total_amount' => 100.0,
            'status' => 'COMPLETE',
            'ref_id' => null,
        ], $response->toArray());
    }
}