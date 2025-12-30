<?php

declare(strict_types=1);

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Epay\ConnectIps;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use PHPUnit\Framework\TestCase;

class ConnectIpsDefaultDTOTest extends TestCase
{
    public function test_it_should_throw_an_exception_when_invalid_argument_is_passed()
    {
        $this->expectException(\TypeError::class);
        new ConnectIps('sa');
    }

    public function test_it_should_thrown_an_exception_when_empty_array_is_passed()
    {
        $this->expectException(InvalidPayloadException::class);
        new ConnectIps([]);
    }

    public function test_it_should_throw_an_exception_when_base_url_is_invalid()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Base Url must be a valid url');
        new ConnectIps([
            'base_url' => 'not-a-valid-url',
            'merchant_id' => 'your-merchant-id',
            'app_id' => 'your-app-id',
            'app_name' => 'your-app-name',
            'private_key_path' => __DIR__ . '/../ExampleTest.php',
            'password' => 'your-password',
        ]);
    }

    public function test_it_should_throw_an_exception_when_merchant_id_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Merchant Id is required');
        new ConnectIps([
            'base_url' => 'https://example.com',
            'app_id' => 'your-app-id',
            'app_name' => 'your-app-name',
            'private_key_path' => __DIR__ . '/../ExampleTest.php',
            'password' => 'your-password',
        ]);
    }

    public function test_it_should_throw_an_exception_when_app_id_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('App Id is required');
        new ConnectIps([
            'base_url' => 'https://example.com',
            'merchant_id' => 'your-merchant-id',
            'app_name' => 'your-app-name',
            'private_key_path' => __DIR__ . '/../ExampleTest.php',
            'password' => 'your-password',
        ]);
    }

    public function test_it_should_throw_an_exception_when_app_name_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('App Name is required');
        new ConnectIps([
            'base_url' => 'https://example.com',
            'merchant_id' => 'your-merchant-id',
            'app_id' => 'your-app-id',
            'private_key_path' => __DIR__ . '/../ExampleTest.php',
            'password' => 'your-password',
        ]);
    }

    public function test_it_should_throw_an_exception_when_private_key_file_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Private Key Path - File does not exists');
        new ConnectIps([
            'base_url' => 'https://example.com',
            'merchant_id' => 'your-merchant-id',
            'app_id' => 'your-app-id',
            'app_name' => 'your-app-name',
            'password' => 'your-password',
        ]);
    }

    public function test_it_should_throw_an_exception_when_password_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Password is required');
        new ConnectIps([
            'base_url' => 'https://example.com',
            'merchant_id' => 'your-merchant-id',
            'app_id' => 'your-app-id',
            'app_name' => 'your-app-name',
            'private_key_path' => __DIR__ . '/../ExampleTest.php',
        ]);
    }
}
