<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\SellersV1\Dto;

use SellingPartnerApi\Dto;

final class MarketplaceParticipation extends Dto
{
    /**
     * @param  Marketplace  $marketplace  Information about an Amazon marketplace where a seller can list items and customers can view and purchase items.
     * @param  Participation  $participation  Information that is specific to a seller in a marketplace.
     */
    public function __construct(
        public Marketplace $marketplace,
        public Participation $participation,
    ) {}
}
