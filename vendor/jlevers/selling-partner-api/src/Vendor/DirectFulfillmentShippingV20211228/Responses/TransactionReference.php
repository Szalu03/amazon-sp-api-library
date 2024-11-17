<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: SellingPartnerApi\Generator\Generators\ResponseGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Vendor\DirectFulfillmentShippingV20211228\Responses;

use SellingPartnerApi\Response;

final class TransactionReference extends Response
{
    /**
     * @param  ?string  $transactionId  GUID to identify this transaction. This value can be used with the Transaction Status API to return the status of this transaction.
     */
    public function __construct(
        public readonly ?string $transactionId = null,
    ) {}
}
