<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\CatalogItemsV20220401\Dto;

use SellingPartnerApi\Dto;

final class ItemRelationshipsByMarketplace extends Dto
{
    protected static array $complexArrayTypes = ['relationships' => ItemRelationship::class];

    /**
     * @param  string  $marketplaceId  Amazon marketplace identifier.
     * @param  ItemRelationship[]  $relationships  Relationships for the item.
     */
    public function __construct(
        public string $marketplaceId,
        public array $relationships,
    ) {}
}
