<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FBAInboundV20240320\Dto;

use SellingPartnerApi\Dto;

final class CreateMarketplaceItemLabelsRequest extends Dto
{
    protected static array $complexArrayTypes = ['mskuQuantities' => MskuQuantity::class];

    /**
     * @param  string  $labelType  Indicates the type of print type for a given label.
     * @param  string  $marketplaceId  The Marketplace ID. For a list of possible values, refer to [Marketplace IDs](https://developer-docs.amazon.com/sp-api/docs/marketplace-ids).
     * @param  MskuQuantity[]  $mskuQuantities  Represents the quantity of an MSKU to print item labels for.
     * @param  ?float  $height  The height of the item label.
     * @param  ?string  $localeCode  The locale code constructed from ISO 639 language code and ISO 3166-1 alpha-2 standard of country codes separated by an underscore character.
     * @param  ?string  $pageType  The page type to use to print the labels. Possible values: 'A4_21', 'A4_24', 'A4_24_64x33', 'A4_24_66x35', 'A4_24_70x36', 'A4_24_70x37', 'A4_24i', 'A4_27', 'A4_40_52x29', 'A4_44_48x25', 'Letter_30'.
     * @param  ?float  $width  The width of the item label.
     */
    public function __construct(
        public string $labelType,
        public string $marketplaceId,
        public array $mskuQuantities,
        public ?float $height = null,
        public ?string $localeCode = null,
        public ?string $pageType = null,
        public ?float $width = null,
    ) {}
}