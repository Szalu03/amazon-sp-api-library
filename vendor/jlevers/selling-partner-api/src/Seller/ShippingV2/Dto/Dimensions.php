<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ShippingV2\Dto;

use SellingPartnerApi\Dto;

final class Dimensions extends Dto
{
    /**
     * @param  float  $length  The length of the package.
     * @param  float  $width  The width of the package.
     * @param  float  $height  The height of the package.
     * @param  string  $unit  The unit of measurement.
     */
    public function __construct(
        public float $length,
        public float $width,
        public float $height,
        public string $unit,
    ) {}
}
