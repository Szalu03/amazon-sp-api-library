<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FinancesV0\Dto;

use SellingPartnerApi\Dto;

final class ChargeComponent extends Dto
{
    protected static array $attributeMap = ['chargeType' => 'ChargeType', 'chargeAmount' => 'ChargeAmount'];

    /**
     * @param  ?string  $chargeType  The type of charge.
     * @param  ?Currency  $chargeAmount  A currency type and amount.
     */
    public function __construct(
        public ?string $chargeType = null,
        public ?Currency $chargeAmount = null,
    ) {}
}