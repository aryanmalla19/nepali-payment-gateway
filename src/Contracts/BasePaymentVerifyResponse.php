<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Contracts;

abstract class BasePaymentVerifyResponse
{
    public string $status;

    public function __construct(public array $data)
    {
        $this->status = strtolower($this->data['status']);
    }

    public function isSuccess(): bool
    {
        return $this->status === 'completed';
    }

    public function isFailure(): bool
    {
        return !$this->isSuccess();
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function toJson(): bool|string
    {
        return json_encode($this->data);
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function toString(): bool|string
    {
        return $this->toJson();
    }
}