<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\CatalogItemsV0\Dto;

use SellingPartnerApi\Dto;

final class DimensionType extends Dto
{
    protected static array $attributeMap = [
        'height' => 'Height',
        'length' => 'Length',
        'width' => 'Width',
        'weight' => 'Weight',
    ];

    /**
     * @param  ?DecimalWithUnits  $height  The decimal value and unit.
     * @param  ?DecimalWithUnits  $length  The decimal value and unit.
     * @param  ?DecimalWithUnits  $width  The decimal value and unit.
     * @param  ?DecimalWithUnits  $weight  The decimal value and unit.
     */
    public function __construct(
        public ?DecimalWithUnits $height = null,
        public ?DecimalWithUnits $length = null,
        public ?DecimalWithUnits $width = null,
        public ?DecimalWithUnits $weight = null,
    ) {}
}
