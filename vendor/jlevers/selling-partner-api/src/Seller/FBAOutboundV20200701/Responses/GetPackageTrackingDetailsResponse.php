<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: SellingPartnerApi\Generator\Generators\ResponseGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FBAOutboundV20200701\Responses;

use SellingPartnerApi\Response;
use SellingPartnerApi\Seller\FBAOutboundV20200701\Dto\ErrorList;
use SellingPartnerApi\Seller\FBAOutboundV20200701\Dto\PackageTrackingDetails;

final class GetPackageTrackingDetailsResponse extends Response
{
    /**
     * @param  ?PackageTrackingDetails  $payload  Tracking details of package
     * @param  ?ErrorList  $errors  A list of error responses returned when a request is unsuccessful.
     */
    public function __construct(
        public readonly ?PackageTrackingDetails $payload = null,
        public readonly ?ErrorList $errors = null,
    ) {}
}