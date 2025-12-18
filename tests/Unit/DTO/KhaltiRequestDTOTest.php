<?php

namespace Tests\Unit\DTO;

use Kbk\NepaliPaymentGateway\Epay\Khalti;
use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;
use PHPUnit\Framework\TestCase;

class KhaltiRequestDTOTest extends TestCase
{
    public function test_khalti_should_throw_an_exception_when_return_url_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Return Url is required');
        $khalti = new Khalti('TEST');

        $khalti->payment([
            'website_url' => 'https://example.com',
            'amount' => 100,
            'purchase_order_id' => uniqid(),
            'purchase_order_name' => 'TEST',
        ]);
    }

    public function test_khalti_should_throw_an_exception_when_return_url_is_invalid()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Return Url must be a url');
        $khalti = new Khalti('TEST');

        $khalti->payment([
            'return_url' => 'not a valid url',
            'website_url' => 'https://example.com',
            'amount' => 100,
            'purchase_order_id' => uniqid(),
            'purchase_order_name' => 'TEST',
        ]);
    }

    public function test_khalti_should_throw_an_exception_when_website_url_is_invalid()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Website Url must be a url');
        $khalti = new Khalti('TEST');

        $khalti->payment([
            'return_url' => 'https://example.com/success',
            'website_url' => 'not a valid url',
            'amount' => 100,
            'purchase_order_id' => uniqid(),
            'purchase_order_name' => 'TEST',
        ]);
    }

    public function test_khalti_should_throw_an_exception_when_website_url_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Website Url is required');
        $khalti = new Khalti('TEST');

        $khalti->payment([
            'return_url' => 'https://example.com/success',
            'amount' => 100,
            'purchase_order_id' => uniqid(),
            'purchase_order_name' => 'TEST',
        ]);
    }

    public function test_khalti_should_throw_an_exception_when_amount_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Amount is required');
        $khalti = new Khalti('TEST');

        $khalti->payment([
            'website_url' => 'https://example.com',
            'return_url' => 'https://example.com/success',
            'purchase_order_id' => uniqid(),
            'purchase_order_name' => 'TEST',
        ]);
    }

    public function test_khalti_should_throw_an_exception_when_amount_is_invalid()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Amount must be numeric');
        $khalti = new Khalti('TEST');

        $khalti->payment([
            'website_url' => 'https://example.com',
            'return_url' => 'https://example.com/success',
            'amount' => 'invalid',
            'purchase_order_id' => uniqid(),
            'purchase_order_name' => 'TEST',
        ]);
    }

    public function test_khalti_should_throw_an_exception_when_amount_is_less_than_0()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Amount must be greater than 0');
        $khalti = new Khalti('TEST');

        $khalti->payment([
            'website_url' => 'https://example.com',
            'return_url' => 'https://example.com/success',
            'amount' => -1,
            'purchase_order_id' => uniqid(),
            'purchase_order_name' => 'TEST',
        ]);
    }

    public function test_khalti_should_throw_an_exception_when_purchase_order_id_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Purchase Order Id is required');
        $khalti = new Khalti('TEST');

        $khalti->payment([
            'website_url' => 'https://example.com',
            'return_url' => 'https://example.com/success',
            'amount' => 1000,
            'purchase_order_name' => 'TEST',
        ]);
    }

    public function test_khalti_should_throw_an_exception_when_purchase_order_name_is_missing()
    {
        $this->expectException(InvalidPayloadException::class);
        $this->expectExceptionMessage('Purchase Order Name is required');
        $khalti = new Khalti('TEST');

        $khalti->payment([
            'website_url' => 'https://example.com',
            'return_url' => 'https://example.com/success',
            'amount' => 1000,
            'purchase_order_id' => uniqid(),
        ]);
    }
}