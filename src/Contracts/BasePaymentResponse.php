<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Contracts;

use JetBrains\PhpStorm\NoReturn;

abstract class BasePaymentResponse
{
    public function __construct(protected readonly array $data) {}

    abstract public function redirect();

    abstract public function getRedirectUrl(): string;

    abstract public function getTotalAmount(): float;

    abstract public function getTotalAmountInPaisa(): int;

    public function toArray(): array
    {
        return $this->data;
    }

    public function toJson(): bool|string
    {
        return json_encode($this->data);
    }

    public function __toString()
    {
        return $this->toJson();
    }

    #[NoReturn]
    protected function submitForm(string $url, array $payload): void
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
