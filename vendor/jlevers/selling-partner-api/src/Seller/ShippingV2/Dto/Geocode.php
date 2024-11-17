<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ShippingV2\Dto;

use SellingPartnerApi\Dto;

final class Geocode extends Dto
{
    /**
     * @param  ?string  $latitude  The latitude of access point.
     * @param  ?string  $longitude  The longitude of access point.
     */
    public function __construct(
        public ?string $latitude = null,
        public ?string $longitude = null,
    ) {}
}
