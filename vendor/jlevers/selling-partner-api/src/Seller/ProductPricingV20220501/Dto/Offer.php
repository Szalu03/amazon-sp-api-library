<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ProductPricingV20220501\Dto;

use SellingPartnerApi\Dto;

final class Offer extends Dto
{
    protected static array $complexArrayTypes = ['shippingOptions' => ShippingOption::class];

    /**
     * @param  string  $sellerId  The seller identifier for the offer.
     * @param  string  $condition  The condition of the item.
     * @param  string  $fulfillmentType  Indicates whether the item is fulfilled by Amazon or by the seller (merchant).
     * @param  MoneyType  $listingPrice  Currency type and monetary value. Schema for demonstrating pricing info.
     * @param  ?string  $subCondition  The item subcondition for the offer.
     * @param  ShippingOption[]|null  $shippingOptions  A list of shipping options associated with this offer
     * @param  ?Points  $points  The number of Amazon Points offered with the purchase of an item, and their monetary value.
     * @param  ?PrimeDetails  $primeDetails  Amazon Prime details.
     */
    public function __construct(
        public string $sellerId,
        public string $condition,
        public string $fulfillmentType,
        public MoneyType $listingPrice,
        public ?string $subCondition = null,
        public ?array $shippingOptions = null,
        public ?Points $points = null,
        public ?PrimeDetails $primeDetails = null,
    ) {}
}
