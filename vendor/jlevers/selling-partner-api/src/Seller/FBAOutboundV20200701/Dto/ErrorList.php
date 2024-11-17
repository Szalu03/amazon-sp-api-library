<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FBAOutboundV20200701\Dto;

use SellingPartnerApi\Dto;

final class ErrorList extends Dto
{
    protected static array $complexArrayTypes = ['errors' => Error::class];

    /**
     * @param  Error[]  $errors  A list of error responses returned when a request is unsuccessful.
     */
    public function __construct(
        public array $errors,
    ) {}
}
