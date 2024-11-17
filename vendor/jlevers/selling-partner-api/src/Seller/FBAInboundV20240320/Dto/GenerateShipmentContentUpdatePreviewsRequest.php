<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FBAInboundV20240320\Dto;

use SellingPartnerApi\Dto;

final class GenerateShipmentContentUpdatePreviewsRequest extends Dto
{
    protected static array $complexArrayTypes = ['boxes' => BoxUpdateInput::class, 'items' => ItemInput::class];

    /**
     * @param  BoxUpdateInput[]  $boxes  A list of boxes that will be present in the shipment after the update.
     * @param  ItemInput[]  $items  A list of all items that will be present in the shipment after the update.
     */
    public function __construct(
        public array $boxes,
        public array $items,
    ) {}
}
