<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: SellingPartnerApi\Generator\Generators\ResponseGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\OrdersV0\Responses;

use SellingPartnerApi\Response;
use SellingPartnerApi\Seller\OrdersV0\Dto\ErrorList;
use SellingPartnerApi\Seller\OrdersV0\Dto\OrderRegulatedInfo;

final class GetOrderRegulatedInfoResponse extends Response
{
    /**
     * @param  ?OrderRegulatedInfo  $payload  The order's regulated information along with its verification status.
     * @param  ?ErrorList  $errors  A list of error responses returned when a request is unsuccessful.
     */
    public function __construct(
        public readonly ?OrderRegulatedInfo $payload = null,
        public readonly ?ErrorList $errors = null,
    ) {}
}