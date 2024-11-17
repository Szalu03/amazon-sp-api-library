<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ProductPricingV20220501\Dto;

use SellingPartnerApi\Dto;

final class FeaturedOfferSegment extends Dto
{
    /**
     * @param  string  $customerMembership  The customer membership type that make up this segment
     * @param  SegmentDetails  $segmentDetails  The details about the segment.
     */
    public function __construct(
        public string $customerMembership,
        public SegmentDetails $segmentDetails,
    ) {}
}
