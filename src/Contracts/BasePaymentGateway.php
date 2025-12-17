<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Contracts;

use JetBrains\PhpStorm\NoReturn;

abstract class BasePaymentGateway implements PaymentGatewayInterface
{
    public function __construct(public HttpClientInterface $httpClient)
    {}

    #[NoReturn]
    private function submitForm(string $url, array $payload): void
    {
        echo '<html><body>';
        echo "<form id='form' method='POST' action='{$url}'>";

        foreach ($payload as $key => $value) {
            echo "<input type='hidden' name='{$key}' id='{$key}' value='{$value}' />";
        }

        echo '</form>';
        echo "<script>document.getElementById('form').submit();</script>";
        echo '</body></html>';
        exit;
    }
}