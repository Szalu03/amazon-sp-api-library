<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: SellingPartnerApi\Generator\Generators\ResponseGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Vendor\DirectFulfillmentShippingV20211228\Responses;

use SellingPartnerApi\Response;
use SellingPartnerApi\Vendor\DirectFulfillmentShippingV20211228\Dto\Pagination;

final class CustomerInvoiceList extends Response
{
    protected static array $complexArrayTypes = ['customerInvoices' => CustomerInvoice::class];

    /**
     * @param  ?Pagination  $pagination  The pagination elements required to retrieve the remaining data.
     * @param  CustomerInvoice[]|null  $customerInvoices  Represents a customer invoice within the `CustomerInvoiceList`.
     */
    public function __construct(
        public readonly ?Pagination $pagination = null,
        public readonly ?array $customerInvoices = null,
    ) {}
}
