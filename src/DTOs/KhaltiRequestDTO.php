<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;

class KhaltiRequestDTO
{
    private function __construct(
        public readonly string $returnUrl,
        public readonly string $websiteUrl,
        public readonly int $amount,
        public readonly string $purchaseOrderId,
        public readonly string $purchaseOrderName,
        public readonly array $customerInfo,
        public readonly array $amountBreakdown,
        public readonly array $productDetails,
    )
    {}

    /**
     * @throws InvalidPayloadException
     */
    public static function fromArray(array $data): self
    {
        if(!isset($data['return_url'])){
            throw new InvalidPayloadException('Return Url is required');
        }

        if(!filter_var($data['return_url'], FILTER_VALIDATE_URL)){
            throw new InvalidPayloadException('Return Url must be a url');
        }

        if(!isset($data['website_url'])){
            throw new InvalidPayloadException('Website Url is required');
        }

        if(!filter_var($data['website_url'], FILTER_VALIDATE_URL)){
            throw new InvalidPayloadException('Website Url must be a url');
        }

        if(!isset($data['amount'])){
            throw new InvalidPayloadException('Amount is required');
        }

        if(!isset($data['purchase_order_id'])){
            throw new InvalidPayloadException('Purchase Order Id is required');
        }

        if(!isset($data['purchase_order_name'])){
            throw new InvalidPayloadException('Purchase Order Name is required');
        }

        if(!is_numeric($data['amount'])){
            throw new InvalidPayloadException('Amount must be numeric');
        }

        if((int) $data['amount'] < 0){
            throw new InvalidPayloadException('Amount must be greater than 0');
        }

        return new self(
            returnUrl: $data['return_url'],
            websiteUrl: $data['website_url'],
            amount: (int) $data['amount'] * 100,
            purchaseOrderId: $data['purchase_order_id'],
            purchaseOrderName: $data['purchase_order_name'],
            customerInfo: $data['customer_info'] ?? [],
            amountBreakdown: $data['amount_breakdown'] ?? [],
            productDetails: $data['product_details'] ?? [],
        );
    }

    public function toArray(): array
    {
        $data = [
            'return_url' => $this->returnUrl,
            'website_url' => $this->websiteUrl,
            'amount' => $this->amount,
            'purchase_order_id' => $this->purchaseOrderId,
            'purchase_order_name' => $this->purchaseOrderName,
        ];

        if (!empty($this->customerInfo)) {
            $data['customer_info'] = $this->customerInfo;
        }

        if (!empty($this->amountBreakdown)) {
            $data['amount_breakdown'] = $this->amountBreakdown;
        }

        if (!empty($this->productDetails)) {
            $data['product_details'] = $this->productDetails;
        }

        return $data;
    }
}