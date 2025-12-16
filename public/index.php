<?php

use Kbk\NepaliPaymentGateway\Epay\Esewa;
use Kbk\NepaliPaymentGateway\Epay\Khalti;

require __DIR__ . '/../vendor/autoload.php';

//$esewa = new Esewa('EPAYTEST', '');
//
//$esewa->verify([
//    'total_amount' => 100,
//    'transaction_uuid' => '123',
//])->isSuccess();


//$khalti = new Khalti('');
//
//$khalti->payment([
//    'return_url' => 'http://localhost:8000/success',
//    'website_url' => 'http://localhost:8000/failure',
//    'amount' => 10,
//    'purchase_order_id' => 'Order01',
//    'purchase_order_name' => 'test',
//]);
//
//$khalti->verify([
//    'pidx' => '78d9d9fa6f8340c597bc1248bd2d8162',
//]);