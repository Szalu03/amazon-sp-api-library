<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FBAOutboundV20200701\Dto;

use SellingPartnerApi\Dto;

final class DeliveryInformation extends Dto
{
    protected static array $complexArrayTypes = ['deliveryDocumentList' => DeliveryDocument::class];

    /**
     * @param  DeliveryDocument[]|null  $deliveryDocumentList  A list of delivery documents for a package.
     * @param  ?DropOffLocation  $dropOffLocation  The preferred location to leave packages at the destination address.
     */
    public function __construct(
        public ?array $deliveryDocumentList = null,
        public ?DropOffLocation $dropOffLocation = null,
    ) {}
}
