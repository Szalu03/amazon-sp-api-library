<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FBAOutboundV20200701\Dto;

use SellingPartnerApi\Dto;

final class PaymentInformation extends Dto
{
    /**
     * @param  string  $paymentTransactionId  The transaction identifier of this payment.
     * @param  string  $paymentMode  The transaction mode of this payment.
     * @param  \DateTimeInterface  $paymentDate  Date timestamp
     */
    public function __construct(
        public string $paymentTransactionId,
        public string $paymentMode,
        public \DateTimeInterface $paymentDate,
    ) {}
}