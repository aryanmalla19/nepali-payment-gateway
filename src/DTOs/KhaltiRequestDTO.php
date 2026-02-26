<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\DTOs;

use Kbk\NepaliPaymentGateway\Exceptions\InvalidPayloadException;

class KhaltiRequestDTO
{
    /**
     * @param string $returnUrl
     * @param string $websiteUrl
     * @param int $amount
     * @param string $purchaseOrderId
     * @param string $purchaseOrderName
     * @param array<string, mixed> $customerInfo
     * @param array<string, mixed> $amountBreakdown
     * @param array<string, mixed> $productDetails
     */
    private function __construct(
        public readonly string $returnUrl,
        public readonly string $websiteUrl,
        public readonly int $amount,
        public readonly string $purchaseOrderId,
        public readonly string $purchaseOrderName,
        public readonly array $customerInfo,
        public readonly array $amountBreakdown,
        public readonly array $productDetails,
    ) {}

    /**
     * @param array<string, mixed> $data
     * @throws InvalidPayloadException
     * @return self
     */
    public static function fromArray(array $data): self
    {
        if (!isset($data['return_url'])) {
            throw new InvalidPayloadException('Return Url is required');
        }

        if (!filter_var($data['return_url'], FILTER_VALIDATE_URL)) {
            throw new InvalidPayloadException('Return Url must be a url');
        }

        if (!isset($data['website_url'])) {
            throw new InvalidPayloadException('Website Url is required');
        }

        if (!filter_var($data['website_url'], FILTER_VALIDATE_URL)) {
            throw new InvalidPayloadException('Website Url must be a url');
        }

        if (!isset($data['amount'])) {
            throw new InvalidPayloadException('Amount is required');
        }

        if (!isset($data['purchase_order_id'])) {
            throw new InvalidPayloadException('Purchase Order Id is required');
        }

        if (!isset($data['purchase_order_name'])) {
            throw new InvalidPayloadException('Purchase Order Name is required');
        }

        if (!is_numeric($data['amount'])) {
            throw new InvalidPayloadException('Amount must be numeric');
        }

        if ((int) $data['amount'] < 0) {
            throw new InvalidPayloadException('Amount must be greater than 0');
        }

        if (isset($data['customer_info'])) {
            if (isset($data['customer_info']['email']) && !filter_var($data['customer_info']['email'], FILTER_VALIDATE_EMAIL)) {
                throw new InvalidPayloadException('Customer Info - Email field must be a valid email address');
            }

            if (isset($data['customer_info']['phone']) && !filter_var($data['customer_info']['phone'], FILTER_VALIDATE_INT)) {
                throw new InvalidPayloadException('Customer Info - Phone Number field must be a valid phone number');
            }
        }

        if (isset($data['amount_breakdown'])) {
            self::validateAmountBreakdown($data['amount_breakdown']);
        }

        if (isset($data['product_details'])) {
            self::validateProductDetails($data['product_details']);
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

    /**
     * @return array<string, mixed>
     */
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

    /**
     * @param array<string, mixed> $amountBreakdown
     * @throws InvalidPayloadException
     */
    private static function validateAmountBreakdown(array &$amountBreakdown): void
    {
        foreach ($amountBreakdown as $index => &$breakdown) {
            if (!isset($breakdown['amount']) || !is_numeric($breakdown['amount']) || $breakdown['amount'] < 0) {
                throw new InvalidPayloadException(
                    "Amount must be numeric and positive in Amount Breakdown at index {$index}",
                );
            }

            $breakdown['amount'] = $breakdown['amount'] * 100;
        }
    }

    /**
     * @param array<string, mixed> $productDetails
     * @throws InvalidPayloadException
     */
    private static function validateProductDetails(array &$productDetails): void
    {
        foreach ($productDetails as $index => &$productDetail) {
            if (!isset($productDetail['total_price']) || !is_numeric($productDetail['total_price']) || $productDetail['total_price'] < 0) {
                throw new InvalidPayloadException(
                    "Total Price must be numeric and positive in Product Details at index {$index}",
                );
            }

            if (!isset($productDetail['unit_price']) || !is_numeric($productDetail['unit_price']) || $productDetail['unit_price'] < 0) {
                throw new InvalidPayloadException(
                    "Unit Price must be numeric and positive in Product Details at index {$index}",
                );
            }

            if (!isset($productDetail['quantity']) || !is_numeric($productDetail['quantity']) || $productDetail['quantity'] < 0) {
                throw new InvalidPayloadException(
                    "Quantity must be numeric and positive in Product Details at index {$index}",
                );
            }

            $productDetail['total_price'] = $productDetail['total_price'] * 100;
            $productDetail['unit_price'] = $productDetail['unit_price'] * 100;
        }
    }
}
