<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: SellingPartnerApi\Generator\Generators\RequestGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\SupplySourcesV20200701\Requests;

use Exception;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use SellingPartnerApi\Request;
use SellingPartnerApi\Seller\SupplySourcesV20200701\Responses\ErrorList;
use SellingPartnerApi\Seller\SupplySourcesV20200701\Responses\GetSupplySourcesResponse;

/**
 * getSupplySources
 */
class GetSupplySources extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  ?string  $nextPageToken  The pagination token to retrieve a specific page of results.
     * @param  ?float  $pageSize  The number of supply sources to return per paginated request.
     */
    public function __construct(
        protected ?string $nextPageToken = null,
        protected ?float $pageSize = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/supplySources/2020-07-01/supplySources';
    }

    public function createDtoFromResponse(Response $response): GetSupplySourcesResponse|ErrorList
    {
        $status = $response->status();
        $responseCls = match ($status) {
            200 => GetSupplySourcesResponse::class,
            400, 403, 404, 413, 415, 429, 500, 503 => ErrorList::class,
            default => throw new Exception("Unhandled response status: {$status}")
        };

        return $responseCls::deserialize($response->json());
    }

    public function defaultQuery(): array
    {
        return array_filter(['nextPageToken' => $this->nextPageToken, 'pageSize' => $this->pageSize]);
    }
}
