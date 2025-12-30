<?php

declare(strict_types=1);

namespace Tests;

use Kbk\NepaliPaymentGateway\DTOs\ConnectIpsPaymentResponseDTO;
use Kbk\NepaliPaymentGateway\Epay\ConnectIps;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class ConnectIpsTestCase extends BaseTestCase
{
    protected ConnectIps $connectIps;

    protected array $paymentPayload = [
        'transaction_id' => 'your-transaction-id',
        'transaction_amount' => 100,
        'remarks' => 'SOME-REMARKS',
        'particulars' => 'SOME-PARTICULARS',
        'reference_id' => 'your-reference-id',
    ];

    protected array $defaultConfig = [
        'base_url' => 'https://example.com',
        'merchant_id' => 'your-merchant-id',
        'app_id' => 'your-app-id',
        'app_name' => 'your-app-name',
        'private_key_path' => __DIR__ . '/TestCase.php',
        'password' => 'your-password',
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->connectIps = new ConnectIps($this->defaultConfig);
    }

    public function makePayment(array $overrides = []): ConnectIpsPaymentResponseDTO
    {
        return $this->connectIps->payment(
            array_merge($this->paymentPayload, $overrides),
        );
    }
}
