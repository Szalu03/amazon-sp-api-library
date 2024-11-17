<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FBAOutboundV20200701\Dto;

use SellingPartnerApi\Dto;

final class GetDeliveryOffersResult extends Dto
{
    protected static array $complexArrayTypes = ['deliveryOffers' => DeliveryOffer::class];

    /**
     * @param  DeliveryOffer[]|null  $deliveryOffers  An array of delivery offer information.
     */
    public function __construct(
        public ?array $deliveryOffers = null,
    ) {}
}
