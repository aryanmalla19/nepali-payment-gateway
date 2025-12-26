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
}
