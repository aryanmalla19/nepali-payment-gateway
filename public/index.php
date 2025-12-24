<?php

use Kbk\NepaliPaymentGateway\Epay\ConnectIps;
use Kbk\NepaliPaymentGateway\Epay\Esewa;
use Kbk\NepaliPaymentGateway\Epay\Khalti;

require __DIR__ . '/../vendor/autoload.php';

//$esewa = new Esewa('EPAYTEST', '');
//
//$esewa->verify([
//    'total_amount' => 100,
//    'transaction_uuid' => '123',
//])->isSuccess();


$khalti = new Khalti('78d9d9fa6f8340c597bc1248bd2d8162');

var_dump($khalti->payment([
    'return_url' => 'http://localhost:8000/success',
    'website_url' => 'http://localhost:8000/failure',
    'amount' => 10,
    'purchase_order_id' => 'Order01',
    'purchase_order_name' => 'test',
]));

//var_dump($khalti->verify([
//    'pidx' => '',
//]));

//var_dump($khalti->getBankList('mobilecheckout'));

//var_dump($khalti->refund(''));

//$connectIps = new ConnectIps([
//    'base_url' => 'https://uat.connectips.com',
//    'merchant_id' => '3165',
//    'app_id' => 'MER-3165-APP-1',
//    'app_name' => 'Harvest Travel and Tour',
//    'private_key_path' => 'src/private.key',
//    'password' => 'Nep@L!890',
//]);
//
//$connectIps->payment([
//    'transaction_id' => uniqid(),
//    'transaction_date' => '01-01-2060',
//    'transaction_currency' => 'npr',
//    'transaction_amount' => 1000,
//    'reference_id' => 'TEST 01',
//    'remarks' => 'TESTING',
//    'particulars' => 'TESTING AGAIN',
//]);

//$connectIps->verify([
//    'reference_id' => uniqid(),
//    'transaction_amount' => 1000,
//]);