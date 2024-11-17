<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Vendor\DirectFulfillmentInventoryV1\Dto;

use SellingPartnerApi\Dto;

final class PartyIdentification extends Dto
{
    /**
     * @param  string  $partyId  Assigned identification for the party.
     */
    public function __construct(
        public string $partyId,
    ) {}
}