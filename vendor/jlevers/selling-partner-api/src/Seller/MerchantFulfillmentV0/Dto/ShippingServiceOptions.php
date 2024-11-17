<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\MerchantFulfillmentV0\Dto;

use SellingPartnerApi\Dto;

final class ShippingServiceOptions extends Dto
{
    protected static array $attributeMap = [
        'deliveryExperience' => 'DeliveryExperience',
        'carrierWillPickUp' => 'CarrierWillPickUp',
        'declaredValue' => 'DeclaredValue',
        'carrierWillPickUpOption' => 'CarrierWillPickUpOption',
        'labelFormat' => 'LabelFormat',
    ];

    /**
     * @param  string  $deliveryExperience  The delivery confirmation level.
     * @param  bool  $carrierWillPickUp  When true, the carrier will pick up the package.
     *
     * Note: Scheduled carrier pickup is available only using Dynamex (US), DPD (UK), and Royal Mail (UK).
     * @param  ?CurrencyAmount  $declaredValue  Currency type and amount.
     * @param  ?string  $carrierWillPickUpOption  Carrier will pick up option.
     * @param  ?string  $labelFormat  The label format.
     */
    public function __construct(
        public string $deliveryExperience,
        public bool $carrierWillPickUp,
        public ?CurrencyAmount $declaredValue = null,
        public ?string $carrierWillPickUpOption = null,
        public ?string $labelFormat = null,
    ) {}
}