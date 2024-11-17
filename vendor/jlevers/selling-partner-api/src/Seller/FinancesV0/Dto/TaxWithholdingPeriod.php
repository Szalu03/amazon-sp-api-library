<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FinancesV0\Dto;

use SellingPartnerApi\Dto;

final class TaxWithholdingPeriod extends Dto
{
    protected static array $attributeMap = ['startDate' => 'StartDate', 'endDate' => 'EndDate'];

    /**
     * @param  ?\DateTimeInterface  $startDate  A date in [ISO 8601](https://developer-docs.amazon.com/sp-api/docs/iso-8601) date-time format.
     * @param  ?\DateTimeInterface  $endDate  A date in [ISO 8601](https://developer-docs.amazon.com/sp-api/docs/iso-8601) date-time format.
     */
    public function __construct(
        public ?\DateTimeInterface $startDate = null,
        public ?\DateTimeInterface $endDate = null,
    ) {}
}