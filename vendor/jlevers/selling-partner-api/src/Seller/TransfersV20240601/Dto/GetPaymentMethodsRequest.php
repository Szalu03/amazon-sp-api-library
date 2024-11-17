<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\TransfersV20240601\Dto;

use SellingPartnerApi\Dto;

final class GetPaymentMethodsRequest extends Dto
{
    /**
     * @param  ?string  $owningCustomerId  A string with no white spaces.
     * @param  ?string  $marketplaceId  A string with no white spaces.
     * @param  ?string  $requestId  A string with no white spaces.
     * @param  ?PaymentMethodFilter  $paymentMethodFilter  The object used to filter payment methods based on different factors.
     */
    public function __construct(
        public ?string $owningCustomerId = null,
        public ?string $marketplaceId = null,
        public ?string $requestId = null,
        public ?PaymentMethodFilter $paymentMethodFilter = null,
    ) {}
}