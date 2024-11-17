<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\MerchantFulfillmentV0\Dto;

use SellingPartnerApi\Dto;

final class PackageDimensions extends Dto
{
    protected static array $attributeMap = [
        'length' => 'Length',
        'width' => 'Width',
        'height' => 'Height',
        'unit' => 'Unit',
        'predefinedPackageDimensions' => 'PredefinedPackageDimensions',
    ];

    /**
     * @param  ?float  $length  Number representing the given package dimension.
     * @param  ?float  $width  Number representing the given package dimension.
     * @param  ?float  $height  Number representing the given package dimension.
     * @param  ?string  $unit  The unit of length.
     * @param  ?string  $predefinedPackageDimensions  An enumeration of predefined parcel tokens. If you specify a PredefinedPackageDimensions token, you are not obligated to use a branded package from a carrier. For example, if you specify the FedEx_Box_10kg token, you do not have to use that particular package from FedEx. You are only obligated to use a box that matches the dimensions specified by the token.
     *
     * Note: Please note that carriers can have restrictions on the type of package allowed for certain ship methods. Check the carrier website for all details. Example: Flat rate pricing is available when materials are sent by USPS in a USPS-produced Flat Rate Envelope or Box.
     */
    public function __construct(
        public ?float $length = null,
        public ?float $width = null,
        public ?float $height = null,
        public ?string $unit = null,
        public ?string $predefinedPackageDimensions = null,
    ) {}
}