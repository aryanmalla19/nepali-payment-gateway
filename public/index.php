<?php

use Kbk\NepaliPaymentGateway\Epay\Esewa;

require __DIR__ . '/../vendor/autoload.php';

$esewa = new Esewa('EPAYTEST', '');

$esewa->verify([
    'total_amount' => 100,
    'transaction_uuid' => '123',
])->isSuccess();