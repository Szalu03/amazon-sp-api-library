<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ProductPricingV0\Dto;

use SellingPartnerApi\Dto;

final class BuyBoxPriceType extends Dto
{
    protected static array $attributeMap = [
        'landedPrice' => 'LandedPrice',
        'listingPrice' => 'ListingPrice',
        'shipping' => 'Shipping',
        'points' => 'Points',
    ];

    /**
     * @param  string  $condition  Indicates the condition of the item. For example: New, Used, Collectible, Refurbished, or Club.
     * @param  ?int  $quantityTier  Indicates at what quantity this price becomes active.
     * @param  ?string  $sellerId  The seller identifier for the offer.
     */
    public function __construct(
        public string $condition,
        public MoneyType $landedPrice,
        public MoneyType $listingPrice,
        public MoneyType $shipping,
        public ?string $offerType = null,
        public ?int $quantityTier = null,
        public ?string $quantityDiscountType = null,
        public ?Points $points = null,
        public ?string $sellerId = null,
    ) {}
}