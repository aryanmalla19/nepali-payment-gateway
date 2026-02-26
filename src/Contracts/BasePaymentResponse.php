<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Contracts;

abstract class BasePaymentResponse
{
    /**
     * @param array<string, mixed> $data
     */
    public function __construct(protected readonly array $data = []) {}

    abstract public function redirect(): never;

    abstract public function getRedirectUrl(): string;

    /**
     * @return array<string, mixed>
     */
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

    /**
     * @param string $url
     * @param array<string, mixed> $payload
     * @return never
     */
    protected function submitForm(string $url, array $payload): never
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
