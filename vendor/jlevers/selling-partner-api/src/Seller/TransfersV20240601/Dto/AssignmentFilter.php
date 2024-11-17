<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\TransfersV20240601\Dto;

use SellingPartnerApi\Dto;

final class AssignmentFilter extends Dto
{
    /**
     * @param  ?string[]  $assignmentTypes  The list of assignment types.
     */
    public function __construct(
        public ?array $assignmentTypes = null,
    ) {}
}