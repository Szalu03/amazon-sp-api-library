<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ShippingV2\Dto;

use SellingPartnerApi\Dto;

final class ShipperInstruction extends Dto
{
    /**
     * @param  ?string  $deliveryNotes  The delivery notes for the shipment
     */
    public function __construct(
        public ?string $deliveryNotes = null,
    ) {}
}
