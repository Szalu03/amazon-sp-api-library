<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Vendor\DirectFulfillmentOrdersV1\Dto;

use SellingPartnerApi\Dto;

final class ShipmentDetails extends Dto
{
    /**
     * @param  bool  $isPriorityShipment  When true, this is a priority shipment.
     * @param  bool  $isPslipRequired  When true, a packing slip is required to be sent to the customer.
     * @param  string  $shipMethod  Ship method to be used for shipping the order. Amazon defines ship method codes indicating the shipping carrier and shipment service level. To see the full list of ship methods in use, including both the code and the friendly name, search the 'Help' section on Vendor Central for 'ship methods'.
     * @param  ShipmentDates  $shipmentDates  Shipment dates.
     * @param  string  $messageToCustomer  Message to customer for order status.
     * @param  ?bool  $isScheduledDeliveryShipment  When true, this order is part of a scheduled delivery program.
     * @param  ?bool  $isGift  When true, the order contain a gift. Include the gift message and gift wrap information.
     */
    public function __construct(
        public bool $isPriorityShipment,
        public bool $isPslipRequired,
        public string $shipMethod,
        public ShipmentDates $shipmentDates,
        public string $messageToCustomer,
        public ?bool $isScheduledDeliveryShipment = null,
        public ?bool $isGift = null,
    ) {}
}