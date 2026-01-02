# Nepali Payment Gateway - eSewa Integration

![PHP Version](https://img.shields.io/packagist/php-v/kbk/nepali-payment-gateway)
[![Downloads](https://img.shields.io/packagist/dt/kbk/nepali-payment-gateway?label=Downloads)](https://packagist.org/packages/kbk/nepali-payment-gateway)
[![License](https://img.shields.io/github/license/aryanmalla19/nepali-payment-gateway)](LICENSE)

> Seamless integration of **eSewa** payments into PHP applications using the Nepali Payment Gateway package.

---

## Features

* Initiate payments (test or live) with automatic environment detection
* Verify transactions
* Access rich response data (`toArray()`, `toJson()`, `getRedirectUrl()`, etc.)
* Supports optional charges: tax, service, delivery
* Simple and clean PHP API

---

## Installation

```bash
composer require kbk/nepali-payment-gateway
```

---

## Usage

### 1. Initiate a Payment

The package automatically detects **test or live environment** based on the `product_code`:

* `EPAYTEST` → Test environment
* Other codes → Live environment

```php
use Kbk\NepaliPaymentGateway\Epay\Esewa;

// Initialize the eSewa client
$esewa = new Esewa([
    'product_code' => 'EPAYTEST', // auto-detect environment
    'secret_key'   => 'your-secret-key', // use "8gBm/:&EnhH.1/q" for test env
]);

// Basic payment request
$response = $esewa->payment([
    'amount'       => 100,
    'success_url'  => 'https://example.com/success',
    'failure_url'  => 'https://example.com/failure',
]);

// Redirect the user to eSewa payment page
return $response->redirect();
```

#### Optional Parameters

```php
$response = $esewa->payment([
    'amount'                  => 100,
    'success_url'             => 'https://example.com/success',
    'failure_url'             => 'https://example.com/failure',
    'transaction_uuid'        => 'your-unique-id', // optional
    'tax_amount'              => 10,   // optional
    'product_service_charge'  => 10,   // optional
    'product_delivery_charge' => 10,   // optional
]);
```

> The response object provides convenient methods like:
>
> * `redirect()` – redirects to the eSewa payment page
> * `toArray()` / `toJson()` – get full response data
> * `getRedirectUrl()` – get payment URL without redirecting

---

### 2. Verify a Payment

After the user completes payment, you can verify the transaction:

```php
$response = $esewa->verify([
    'total_amount'     => 100, // in Rs.
    'transaction_uuid' => '123',
]);

if ($response->isSuccess()) {
    echo 'Payment Successful';
} elseif ($response->isPending()) {
    echo 'Payment Pending';
} else {
    echo 'Payment Failed';
}
```

#### Response Methods

The `$response` object provides:

* `isSuccess()` – Returns `true` if payment succeeded
* `isFailure()` – Returns `true` if payment failed
* `isPending()` – Returns `true` if payment is pending
* `toArray()` – Full response array
* `toJson()` – JSON representation
* `getTransactionId()` – Transaction ID
* `getReferenceId()` – eSewa reference ID
* `getProductCode()` – Product code
* `getTotalAmount()` – Amount in Rs
* `getTotalAmountInPaisa()` – Amount in paisa

---

## Documentation

For detailed API specifications and guidelines:
[eSewa Developer Documentation](https://developer.esewa.com.np/)
