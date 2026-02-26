<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Contracts;

abstract class BasePaymentVerifyResponse
{
    protected readonly string $status;


    /**
     * @param array<string, mixed> $data
     */
    public function __construct(protected readonly array $data)
    {
        $this->status = strtolower($this->data['status']);
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    abstract public function getTotalAmount(): float;

    abstract public function getTotalAmountInPaisa(): int;

    abstract public function isSuccess(): bool;

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

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->data;
    }

    public function toString(): bool|string
    {
        return $this->toJson();
    }
}
