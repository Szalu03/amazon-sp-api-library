<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: SellingPartnerApi\Generator\Generators\ResponseGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ShippingV1\Responses;

use SellingPartnerApi\Response;
use SellingPartnerApi\Seller\ShippingV1\Dto\ErrorList;
use SellingPartnerApi\Seller\ShippingV1\Dto\PurchaseLabelsResult;

final class PurchaseLabelsResponse extends Response
{
    /**
     * @param  ?PurchaseLabelsResult  $payload  The payload schema for the purchaseLabels operation.
     * @param  ?ErrorList  $errors  A list of error responses returned when a request is unsuccessful.
     */
    public function __construct(
        public readonly ?PurchaseLabelsResult $payload = null,
        public readonly ?ErrorList $errors = null,
    ) {}
}