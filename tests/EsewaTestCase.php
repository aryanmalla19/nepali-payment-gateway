<?php

declare(strict_types=1);

namespace Tests;

use Kbk\NepaliPaymentGateway\DTOs\EsewaPaymentResponseDTO;
use Kbk\NepaliPaymentGateway\DTOs\EsewaVerifyResponseDTO;
use Kbk\NepaliPaymentGateway\Epay\Esewa;

abstract class EsewaTestCase extends TestCase
{
    protected const PRODUCT_CODE = 'EPAYTEST'; // eSewa Test Product Code
    protected const SECRET_KEY = '8gBm/:&EnhH.1/q'; //eSewa Test Secret Key

    protected EsewaPaymentResponseDTO $paymentResponse;
    protected EsewaVerifyResponseDTO $verifyResponse;

    protected Esewa $esewa;

    protected array $paymentPayload;

    // eSewa default Transaction Id for test
    protected array $verifyPayload = [
        'total_amount' => 100,
        'transaction_uuid' => '123',
    ];

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->paymentPayload = [
            'amount' => 100,
            'success_url' => 'https://example.com/success',
            'failure_url' => 'https://example.com/failure',
            'transaction_uuid' => uniqid(),
        ];
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->esewa = new Esewa(self::PRODUCT_CODE, self::SECRET_KEY);

        $this->paymentResponse = $this->esewa->payment($this->paymentPayload);

        $this->verifyResponse = $this->esewa->verify($this->verifyPayload);
    }

    protected function makePayment(array $overrides = []): EsewaPaymentResponseDTO
    {
        return $this->esewa->payment(
            array_merge($this->paymentPayload, $overrides),
        );
    }

    protected function verifyPayment(array $overrides = []): EsewaVerifyResponseDTO
    {
        return $this->esewa->verify(
            array_merge($this->verifyPayload, $overrides),
        );
    }
}
