<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FinancesV0\Dto;

use SellingPartnerApi\Dto;

final class CapacityReservationBillingEvent extends Dto
{
    protected static array $attributeMap = [
        'transactionType' => 'TransactionType',
        'postedDate' => 'PostedDate',
        'description' => 'Description',
        'transactionAmount' => 'TransactionAmount',
    ];

    /**
     * @param  ?string  $transactionType  The transaction type. For example, FBA Inventory Fee.
     * @param  ?\DateTimeInterface  $postedDate  A date in [ISO 8601](https://developer-docs.amazon.com/sp-api/docs/iso-8601) date-time format.
     * @param  ?string  $description  A short description of the capacity reservation billing event.
     * @param  ?Currency  $transactionAmount  A currency type and amount.
     */
    public function __construct(
        public ?string $transactionType = null,
        public ?\DateTimeInterface $postedDate = null,
        public ?string $description = null,
        public ?Currency $transactionAmount = null,
    ) {}
}