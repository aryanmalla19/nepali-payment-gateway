# Nepali Payment Gateway - ConnectIPS Integration

[![PHP Version](https://img.shields.io/packagist/php-v/kbk/nepali-payment-gateway)](https://packagist.org/packages/kbk/nepali-payment-gateway)
[![Downloads](https://img.shields.io/packagist/dt/kbk/nepali-payment-gateway?label=Downloads)](https://packagist.org/packages/kbk/nepali-payment-gateway)
[![License](https://img.shields.io/github/license/aryanmalla19/nepali-payment-gateway)](LICENSE)

**Nepali Payment Gateway** provides a seamless and secure way to integrate **connectIPS** 

---
## Installation

Install the package via Composer:

```bash
composer require kbk/nepali-payment-gateway
```

## Usage
### Configuration
Instantiate the ConnectIps class with your merchant credentials:
```php 
use Kbk\NepaliPaymentGateway\Epay\ConnectIps;

$connectIps = new ConnectIps([
'base_url'         => 'https://uat.connectips.com',
'merchant_id'      => 'your-merchant-id',
'app_id'           => 'your-app-id',
'app_name'         => 'your-app-name',
'private_key_path' => '/path/to/your-private-key.pem',
'password'         => 'your-password',
]);
```
>Note: Use the UAT (testing) environment during development. Switch to the production URL for live transactions.

#### 1. Initiating a Payment
   Redirect users to the connectIPS payment gateway:
```php
$response = $connectIps->payment([
    'amount'             => 100,                  // Required: Transaction amount in NPR
    'reference_id'       => 'unique-reference-id', // Required: Your internal reference
    'remarks'            => 'Order #1234', // Required: Your Remarks
    'particulars'        => 'Payment for services', // Required: Payment Particulars
    'transaction_id'     => 'unique-txn-id',      // Optional: Unique transaction identifier
    'transaction_date'   => '29-12-2025',         // Optional: Format DD-MM-YYYY (defaults to today)
    'transaction_currency' => 'NPR',             // Optional: Defaults to NPR
]);

// Redirect the user to the payment page
return $response->redirect();

// Alternative methods
// $response->getRedirectUrl();  // Returns the URL as a string
// $response->toArray();         // Returns response data as an array
```

#### 2. Verifying a Payment
After redirection back to your site, verify the transaction status:
```php
$response = $connectIps->verify([
   'reference_id'       => 'your-reference-id',
   'transaction_amount' => 100,  // Amount in NPR (as sent during initiation)
]);

if ($response->isSuccess()) {
echo 'Payment Successful';

    // Access additional details
    echo $response->getTotalAmount();          // Amount in NPR
    echo $response->getTotalAmountInPaisa();   // Amount in paisa
    echo $response->getStatusDescription();
    echo $response->getReferenceId();
} else {
echo 'Payment Failed: ' . $response->getStatusDescription();
}

// Other useful methods
// $response->getStatus()
// $response->toArray()
```


#### 3. Retrieving Payment Details
Fetch detailed information about a transaction:
```php
$response = $connectIps->detail([
   'reference_id'       => 'your-reference-id',
   'transaction_amount' => 100,
   ]);

$data = $response->toArray();

// The response object provides the same accessor methods as verification
```

## Official Documentation
For comprehensive API specifications, integration guidelines, and additional details, refer to the [ConnectIps Official Docs](https://doc.connectips.com/docs/category/2-connectips-gateway/).