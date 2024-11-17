<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ShippingV1\Dto;

use SellingPartnerApi\Dto;

final class Location extends Dto
{
    /**
     * @param  ?string  $stateOrRegion  The state or region where the person, business or institution is located.
     * @param  ?string  $city  The city where the person, business or institution is located.
     * @param  ?string  $countryCode  The two digit country code. In ISO 3166-1 alpha-2 format.
     * @param  ?string  $postalCode  The postal code of that address. It contains a series of letters or digits or both, sometimes including spaces or punctuation.
     */
    public function __construct(
        public ?string $stateOrRegion = null,
        public ?string $city = null,
        public ?string $countryCode = null,
        public ?string $postalCode = null,
    ) {}
}
