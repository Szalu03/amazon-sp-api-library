<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ShippingV2\Dto;

use SellingPartnerApi\Dto;

final class TrackingSummary extends Dto
{
    /**
     * @param  ?string  $status  The status of the package being shipped.
     * @param  ?TrackingDetailCodes  $trackingDetailCodes  Contains detail codes that provide additional details related to the forward and return leg of the shipment.
     */
    public function __construct(
        public ?string $status = null,
        public ?TrackingDetailCodes $trackingDetailCodes = null,
    ) {}
}
