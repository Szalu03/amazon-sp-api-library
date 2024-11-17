<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Vendor\ShipmentsV1\Dto;

use SellingPartnerApi\Dto;

final class SubmitShipments extends Dto
{
    protected static array $complexArrayTypes = ['shipments' => Shipment::class];

    /**
     * @param  Shipment[]|null  $shipments  A list of one or more shipments with underlying details.
     */
    public function __construct(
        public ?array $shipments = null,
    ) {}
}