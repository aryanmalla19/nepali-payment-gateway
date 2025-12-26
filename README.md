# Nepali Payment Gateway

[![X (formerly Twitter)](https://img.shields.io/badge/-@aryanmalla19-white?style=flat&logo=x&label=(formerly%20Twitter))](https://x.com/aryanmalla19)
[![Facebook](https://img.shields.io/badge/Facebook-aryanmalla19-blue?style=flat&logo=facebook)](https://www.facebook.com/aryanmalla19)
![PHP Version](https://img.shields.io/packagist/php-v/kbk/nepali-payment-gateway)
[![Downloads](https://img.shields.io/packagist/dt/kbk/nepali-payment-gateway?label=Downloads)](https://packagist.org/packages/kbk/nepali-payment-gateway)
[![License](https://img.shields.io/github/license/aryanmalla19/nepali-payment-gateway)](LICENSE)
[![Packagist](https://img.shields.io/packagist/v/kbk/nepali-payment-gateway)](https://packagist.org/packages/kbk/nepali-payment-gateway)

> A PHP library for integrating major Nepali payment gateways.

---

## Introduction

Nepali Payment Gateway is a PHP package designed to integrate major online payment systems in Nepal into any PHP-based application.  
It provides a unified, clean, and developer-friendly interface for initiating and verifying payments across multiple providers.

Currently supported payment gateways:

- **eSewa**
- **Khalti**
- **ConnectIPS**

This package is developed and maintained by **Aryan Malla** along with the open-source community.

For gateway-specific rules, configurations, and policies, please refer to the official documentation provided by each payment partner:

- [eSewa Documentation](https://developer.esewa.com.np/)
- [Khalti Documentation](https://docs.khalti.com/)
- [ConnectIPS Documentation](https://doc.connectips.com/docs/category/2-connectips-gateway/)

---

## Requirements

- PHP **8.1** or higher
- Composer
- Required PHP extensions:
    - `ext-curl`
    - `ext-openssl`
---

## Installation

```
composer require kbk/nepali-payment-gateway
```

---

## Getting Started

```php
require __DIR__ . '/vendor/autoload.php';
```

---

## Usage

### eSewa Payment Example

```php
use Kbk\NepaliPaymentGateway\Epay\Esewa;

$esewa = new Esewa([
    'product_code' => 'EPAYTEST',
    'secret_key'   => 'your-secret-key',
]);

$response = $esewa->payment([
    'amount'       => 1000,
    'success_url'  => 'https://example.com/success',
    'failure_url'  => 'https://example.com/failure',
]);

return $response->redirect();
```

---

### Payment Verification

```php
$response = $esewa->verify([
    'total_amount' => 100,
    'transaction_uuid' => '123',
]);

if ($response->isSuccess()) {
    echo 'Payment Successful';
} else {
    echo 'Payment Failed';
}
```

---

## Contribution

The contributions of the Open Source community are highly valued and appreciated. To ensure a smooth and efficient process, please adhere to the following guidelines when submitting code:

- Ensure that the code adheres to [PER Coding Style 3.0] standards.
- All submitted code must pass relevant tests.
- Proper documentation and clean code practices are essential.
- Please make pull requests to the `main` branch.
- Thank you for your support and contributions. Looking forward to reviewing your code.

[PER Coding Style 3.0]: https://www.php-fig.org/per/coding-style/