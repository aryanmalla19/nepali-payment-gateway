# Nepali Payment Gateway - Khalti Integration

![PHP Version](https://img.shields.io/packagist/php-v/kbk/nepali-payment-gateway)
[![Downloads](https://img.shields.io/packagist/dt/kbk/nepali-payment-gateway?label=Downloads)](https://packagist.org/packages/kbk/nepali-payment-gateway)
[![License](https://img.shields.io/github/license/aryanmalla19/nepali-payment-gateway)](LICENSE)

> Seamless integration of **Khalti** payments into PHP applications using the Nepali Payment Gateway package.

---

## Installation

```bash
composer require kbk/nepali-payment-gateway
```

---

## Usage

### 1. Initiate a Payment

The package supports both **test** and **live** environments. Amounts are provided in **Rs**. The package converts them to paisa automatically.

```php
use Kbk\NepaliPaymentGateway\Epay\Khalti;

$khalti = new Khalti(
  secretKey: 'your-secret-key',
  enviroment: 'test', // or 'live', default is test
);

$response = $khalti->payment([
    'return_url' => 'https://example.com/success',
    'website_url' => 'https://example.com/failure',
    'amount' => 100, // in Rs.
    'purchase_order_id' => 'TEST01',
    'purchase_order_name' => 'TEST01',
]);

// Optional: store pidx before redirecting for verification
$pidx = $response->getPidx();

// Redirect user to Khalti payment page
return $response->redirect();

```

#### Optional Parameters

```php
$response = $khalti->payment([
    'return_url' => 'https://example.com/success',
    'website_url' => 'https://example.com/failure',
    'amount' => 100, // in Rs.
    'purchase_order_id' => 'TEST01',
    'purchase_order_name' => 'TEST01',
    'customer_info' => [
        'name' => 'Your Name',
        'email' => 'your-email@example.com',
        'phone' => '9800000000',
    ],
    'amount_breakdown' => [
        ['label' => 'Mark Price', 'amount' => 90], // in Rs.
        ['label' => 'VAT', 'amount' => 10], // in Rs.
    ],
    'product_details' => [
        [
            'identity' => '1234567890',
            'name' => 'Khalti',
            'total_price' => 100, // in Rs.
            'quantity' => 1,
            'unit_price' => 100, // in Rs,
        ],
    ],
]);
```

> The response object provides:
>
> * `redirect()` – redirect to payment page
> * `toArray()` / `toJson()` – full response data
> * `getRedirectUrl()` – URL without redirecting
> * `getPidx()` – unique payment index

---

### 2. Verify a Payment

```php
$response = $khalti->verify([
    'pidx' => 'your-payment-index',
]);

if ($response->isSuccess()) {
    echo 'Payment Successful';
} else {
    echo 'Payment Failed';
}
```

#### Response Methods

* `isSuccess()` – payment successful
* `isFailure()` – payment failed
* `isRefunded()` / `isPartiallyRefunded()` – refund status
* `isInitiated()` / `isExpired()` / `isCancelled()` – payment state
* `getTotalAmount()` / `getTotalAmountInPaisa()` – amounts
* `getFee()` / `getFeeInPaisa()` – fee details
* `getTransactionId()` / `getPidx()` – transaction info
* `getStatus()` – current status
* `toArray()` / `toJson()` – full response

---

### 3. Refund Example

```php
// Full refund
$response = $khalti->refund(['transaction_id' => 'your-transaction-id']);

// Partial refund
$response = $khalti->refund([
    'transaction_id' => 'your-transaction-id',
    'amount' => 100, // in Rs.
]);

// Bank refund (requires mobile number)
$response = $khalti->refund([
    'transaction_id' => 'your-transaction-id',
    'mobile' => '9800000000',
]);
```

---

### 4. Get Bank List

```php
// Default e-banking
$response = $khalti->getBankList();

// Mobile checkout
$response = $khalti->getBankList('mobilecheckout');

// Returns JSON array of available banks
```

---

## Documentation
For detailed API specifications and guidelines: [Khalti Official Developer Docs](https://docs.khalti.com/)
