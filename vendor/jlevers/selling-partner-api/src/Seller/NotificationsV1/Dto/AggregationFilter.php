<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\NotificationsV1\Dto;

use SellingPartnerApi\Dto;

final class AggregationFilter extends Dto
{
    /**
     * @param  ?AggregationSettings  $aggregationSettings  A container that holds all of the necessary properties to configure the aggregation of notifications.
     */
    public function __construct(
        public ?AggregationSettings $aggregationSettings = null,
    ) {}
}
