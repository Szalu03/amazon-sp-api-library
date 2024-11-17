<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\SellersV1\Dto;

use SellingPartnerApi\Dto;

final class MarketplaceLevelAttributes extends Dto
{
    /**
     * @param  Marketplace  $marketplace  Information about an Amazon marketplace where a seller can list items and customers can view and purchase items.
     * @param  string  $storeName  The name of the seller's store as displayed in the marketplace.
     * @param  string  $listingStatus  The current status of the seller's listings.
     * @param  string  $sellingPlan  The selling plan details.
     */
    public function __construct(
        public Marketplace $marketplace,
        public string $storeName,
        public string $listingStatus,
        public string $sellingPlan,
    ) {}
}