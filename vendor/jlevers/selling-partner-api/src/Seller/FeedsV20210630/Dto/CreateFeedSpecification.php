<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: Crescat\SaloonSdkGenerator\Generators\DtoGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FeedsV20210630\Dto;

use SellingPartnerApi\Dto;

final class CreateFeedSpecification extends Dto
{
    /**
     * @param  string  $feedType  The feed type.
     * @param  string[]  $marketplaceIds  A list of identifiers for marketplaces that you want the feed to be applied to.
     * @param  string  $inputFeedDocumentId  The document identifier returned by the createFeedDocument operation. Upload the feed document contents before calling the createFeed operation.
     * @param  ?string[]  $feedOptions  Additional options to control the feed. These vary by feed type.
     */
    public function __construct(
        public string $feedType,
        public array $marketplaceIds,
        public string $inputFeedDocumentId,
        public ?array $feedOptions = null,
    ) {}
}