<?php

declare(strict_types=1);

namespace Tests;

use Kbk\NepaliPaymentGateway\Contracts\BasePaymentResponse;
use Kbk\NepaliPaymentGateway\Contracts\BasePaymentVerifyResponse;
use Kbk\NepaliPaymentGateway\Epay\Khalti;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class KhaltiTestCase extends BaseTestCase
{
    protected const API_KEY = '05bf95cc57244045b8df5fad06748dab'; // Khalti Default API KEY for testing
    protected const PIDX = 'jxWymWzkRbRL6hYYdyxfRP'; // My Pidx for test in khalti default api key

    protected readonly BasePaymentVerifyResponse $verifyResponse;
    protected readonly BasePaymentResponse $paymentResponse;

    protected array $paymentPayload = [
        'website_url' => 'https://example.com',
        'return_url' => 'https://example.com/success',
        'amount' => 100,
        'purchase_order_id' => 'TEST01',
        'purchase_order_name' => 'TEST01',
    ];

    public function setUp(): void
    {
        parent::setUp();

        $khalti = new Khalti(self::API_KEY);

        $this->verifyResponse = $khalti->verify([
            'pidx' => self::PIDX,
        ]);

        $this->paymentResponse = $khalti->payment($this->paymentPayload);
    }
}
