<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FBAInboundV20240320\Dto;

use SellingPartnerApi\Dto;

final class SelfShipAppointmentSlotsAvailability extends Dto
{
    protected static array $complexArrayTypes = ['slots' => AppointmentSlot::class];

    /**
     * @param  ?\DateTimeInterface  $expiresAt  The time at which the self ship appointment slot expires. In [ISO 8601](https://developer-docs.amazon.com/sp-api/docs/iso-8601) datetime format.
     * @param  AppointmentSlot[]|null  $slots  A list of appointment slots.
     */
    public function __construct(
        public ?\DateTimeInterface $expiresAt = null,
        public ?array $slots = null,
    ) {}
}