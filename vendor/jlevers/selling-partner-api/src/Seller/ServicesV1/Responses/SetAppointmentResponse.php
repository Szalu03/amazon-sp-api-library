<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: SellingPartnerApi\Generator\Generators\ResponseGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\ServicesV1\Responses;

use SellingPartnerApi\Response;
use SellingPartnerApi\Seller\ServicesV1\Dto\ErrorList;
use SellingPartnerApi\Seller\ServicesV1\Dto\Warning;

final class SetAppointmentResponse extends Response
{
    protected static array $complexArrayTypes = ['warnings' => Warning::class];

    /**
     * @param  ?string  $appointmentId  The appointment identifier.
     * @param  Warning[]|null  $warnings  A list of warnings returned in the sucessful execution response of an API request.
     * @param  ?ErrorList  $errors  A list of error responses returned when a request is unsuccessful.
     */
    public function __construct(
        public readonly ?string $appointmentId = null,
        public readonly ?array $warnings = null,
        public readonly ?ErrorList $errors = null,
    ) {}
}