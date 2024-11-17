<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FBAOutboundV20200701\Dto;

use SellingPartnerApi\Dto;

final class FulfillmentShipment extends Dto
{
    protected static array $complexArrayTypes = [
        'fulfillmentShipmentItem' => FulfillmentShipmentItem::class,
        'fulfillmentShipmentPackage' => FulfillmentShipmentPackage::class,
    ];

    /**
     * @param  string  $amazonShipmentId  A shipment identifier assigned by Amazon.
     * @param  string  $fulfillmentCenterId  An identifier for the fulfillment center that the shipment will be sent from.
     * @param  string  $fulfillmentShipmentStatus  The current status of the shipment.
     * @param  FulfillmentShipmentItem[]  $fulfillmentShipmentItem  An array of fulfillment shipment item information.
     * @param  ?\DateTimeInterface  $shippingDate  Date timestamp
     * @param  ?\DateTimeInterface  $estimatedArrivalDate  Date timestamp
     * @param  ?string[]  $shippingNotes  Provides additional insight into shipment timeline. Primairly used to communicate that actual delivery dates aren't available.
     * @param  FulfillmentShipmentPackage[]|null  $fulfillmentShipmentPackage  An array of fulfillment shipment package information.
     */
    public function __construct(
        public string $amazonShipmentId,
        public string $fulfillmentCenterId,
        public string $fulfillmentShipmentStatus,
        public array $fulfillmentShipmentItem,
        public ?\DateTimeInterface $shippingDate = null,
        public ?\DateTimeInterface $estimatedArrivalDate = null,
        public ?array $shippingNotes = null,
        public ?array $fulfillmentShipmentPackage = null,
    ) {}
}