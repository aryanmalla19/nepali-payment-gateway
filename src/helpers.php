<?php

if (!function_exists('esewa_signature_hash')) {
    function esewa_signature_hash(array $data, string $secretKey): string
    {
        $message = "total_amount={$data['total_amount']},transaction_uuid={$data['transaction_uuid']},product_code={$data['product_code']}";

        $signature = hash_hmac('sha256', $message, $secretKey, true);

        return base64_encode($signature);
    }
}