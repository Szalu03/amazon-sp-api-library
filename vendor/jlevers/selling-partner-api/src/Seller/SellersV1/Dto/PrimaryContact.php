<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\SellersV1\Dto;

use SellingPartnerApi\Dto;

final class PrimaryContact extends Dto
{
    /**
     * @param  string  $name  The full name of the seller's primary contact.
     * @param  Address  $address  Represents an address
     * @param  ?string  $nonLatinName  The non-Latin script version of the primary contact's name, if applicable.
     */
    public function __construct(
        public string $name,
        public Address $address,
        public ?string $nonLatinName = null,
    ) {}
}
