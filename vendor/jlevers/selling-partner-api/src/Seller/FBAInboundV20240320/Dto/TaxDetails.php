<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FBAInboundV20240320\Dto;

use SellingPartnerApi\Dto;

final class TaxDetails extends Dto
{
    protected static array $complexArrayTypes = ['taxRates' => TaxRate::class];

    /**
     * @param  ?Currency  $declaredValue  The type and amount of currency.
     * @param  ?string  $hsnCode  Harmonized System of Nomenclature code.
     * @param  TaxRate[]|null  $taxRates  List of tax rates.
     */
    public function __construct(
        public ?Currency $declaredValue = null,
        public ?string $hsnCode = null,
        public ?array $taxRates = null,
    ) {}
}
