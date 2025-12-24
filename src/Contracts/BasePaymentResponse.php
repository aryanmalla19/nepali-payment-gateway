<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Contracts;

abstract class BasePaymentResponse
{
    public function __construct(protected readonly array $data)
    {}

    public abstract function redirect();

    public abstract function getRedirectUrl(): string;

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
}