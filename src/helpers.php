<?php

declare(strict_types=1);

if (!function_exists('esewa_signature_hash')) {
    function esewa_signature_hash(array $data, string $secretKey): string
    {
        $message = "total_amount={$data['total_amount']},transaction_uuid={$data['transaction_uuid']},product_code={$data['product_code']}";

        $signature = hash_hmac('sha256', $message, $secretKey, true);

        return base64_encode($signature);
    }
}

if (! function_exists('connectips_signature_hash')) {
    function connectips_signature_hash(array $signatureData, string $path): string
    {
        $message = "MERCHANTID={$signatureData['MERCHANTID']},APPID={$signatureData['APPID']},APPNAME={$signatureData['APPNAME']},TXNID={$signatureData['TXNID']},TXNDATE={$signatureData['TXNDATE']},TXNCRNCY={$signatureData['TXNCRNCY']},TXNAMT={$signatureData['TXNAMT']},REFERENCEID={$signatureData['REFERENCEID']},REMARKS={$signatureData['REMARKS']},PARTICULARS={$signatureData['PARTICULARS']},TOKEN=TOKEN";

        $privateKey = openssl_pkey_get_private(file_get_contents($path));

        openssl_sign($message, $signature, $privateKey, OPENSSL_ALGO_SHA256);

        return base64_encode($signature);
    }
}

if (! function_exists('connectips_signature_hash_verify')) {
    function connectips_signature_hash_verify(array $signatureData, string $path): string
    {
        $message = "MERCHANTID={$signatureData['merchantId']},APPID={$signatureData['appId']},,REFERENCEID={$signatureData['referenceId']},TXNAMT={$signatureData['txmAmt']}";

        $privateKey = openssl_pkey_get_private(file_get_contents($path));

        openssl_sign($message, $signature, $privateKey, OPENSSL_ALGO_SHA256);

        return base64_encode($signature);
    }
}
