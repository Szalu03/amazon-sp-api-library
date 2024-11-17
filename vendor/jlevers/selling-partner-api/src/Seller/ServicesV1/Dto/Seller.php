<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ServicesV1\Dto;

use SellingPartnerApi\Dto;

final class Seller extends Dto
{
    /**
     * @param  ?string  $sellerId  The identifier of the seller of the service job.
     */
    public function __construct(
        public ?string $sellerId = null,
    ) {}
}