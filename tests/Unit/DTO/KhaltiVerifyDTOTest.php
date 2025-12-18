<?php

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Kbk\NepaliPaymentGateway\Epay\Khalti;
use PHPUnit\Framework\TestCase;

class KhaltiVerifyDTOTest extends TestCase
{
    // TODO: Implement Khalti Verify Method (Right now Khalti does not provide credentials for it)
    public function test_it_should_return_correct_base_verify_response_class()
    {
        self::markTestIncomplete();
//        $khalti = new Khalti('');
//
//        $response = $khalti->verify([
//            'pidx' => '',
//        ]);
//
//        $this->assertInstanceOf(BasePaymentVerifyResponse::class, $response);
    }
}