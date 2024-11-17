<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ReplenishmentV20221107\Dto;

use SellingPartnerApi\Dto;

final class DiscountFunding extends Dto
{
    /**
     * @param  float[]|null  $percentage  Filters the results to only include offers with the percentage specified.
     */
    public function __construct(
        public ?array $percentage = null,
    ) {}
}
