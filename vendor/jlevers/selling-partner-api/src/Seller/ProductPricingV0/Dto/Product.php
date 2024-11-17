<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ProductPricingV0\Dto;

use SellingPartnerApi\Dto;

final class Product extends Dto
{
    protected static array $attributeMap = [
        'identifiers' => 'Identifiers',
        'attributeSets' => 'AttributeSets',
        'relationships' => 'Relationships',
        'competitivePricing' => 'CompetitivePricing',
        'salesRankings' => 'SalesRankings',
        'offers' => 'Offers',
    ];

    protected static array $complexArrayTypes = ['salesRankings' => SalesRankType::class, 'offers' => OfferType::class];

    /**
     * @param  IdentifierType  $identifiers  Specifies the identifiers used to uniquely identify an item.
     * @param  ?mixed[]  $attributeSets
     * @param  ?mixed[]  $relationships
     * @param  ?CompetitivePricingType  $competitivePricing  Competitive pricing information for the item.
     * @param  SalesRankType[]|null  $salesRankings  A list of sales rank information for the item, by category.
     * @param  OfferType[]|null  $offers  A list of offers.
     */
    public function __construct(
        public IdentifierType $identifiers,
        public ?array $attributeSets = null,
        public ?array $relationships = null,
        public ?CompetitivePricingType $competitivePricing = null,
        public ?array $salesRankings = null,
        public ?array $offers = null,
    ) {}
}