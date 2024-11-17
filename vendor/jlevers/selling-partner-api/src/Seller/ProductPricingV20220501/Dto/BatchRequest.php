<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ProductPricingV20220501\Dto;

use SellingPartnerApi\Dto;

final class BatchRequest extends Dto
{
    /**
     * @param  string  $uri  The URI associated with an individual request within a batch. For `FeaturedOfferExpectedPrice`, this should be `/products/pricing/2022-05-01/offer/featuredOfferExpectedPrice`.
     * @param  string  $method  The HTTP method associated with an individual request within a batch.
     * @param  ?array[]  $body  Additional HTTP body information associated with an individual request within a batch.
     * @param  ?string[]  $headers  A mapping of additional HTTP headers to send/receive for an individual request within a batch.
     */
    public function __construct(
        public string $uri,
        public string $method,
        public ?array $body = null,
        public ?array $headers = null,
    ) {}
}