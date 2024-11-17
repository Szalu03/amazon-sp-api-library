<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: SellingPartnerApi\Generator\Generators\RequestGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Vendor\DirectFulfillmentOrdersV1\Requests;

use Exception;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use SellingPartnerApi\Middleware\RestrictedDataToken;
use SellingPartnerApi\Request;
use SellingPartnerApi\Vendor\DirectFulfillmentOrdersV1\Responses\GetOrdersResponse;

/**
 * getOrders
 */
class GetOrders extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  \DateTimeInterface  $createdAfter  Purchase orders that became available after this date and time will be included in the result. Must be in ISO-8601 date/time format.
     * @param  \DateTimeInterface  $createdBefore  Purchase orders that became available before this date and time will be included in the result. Must be in ISO-8601 date/time format.
     * @param  ?string  $shipFromPartyId  The vendor warehouse identifier for the fulfillment warehouse. If not specified, the result will contain orders for all warehouses.
     * @param  ?string  $status  Returns only the purchase orders that match the specified status. If not specified, the result will contain orders that match any status.
     * @param  ?int  $limit  The limit to the number of purchase orders returned.
     * @param  ?string  $sortOrder  Sort the list in ascending or descending order by order creation date.
     * @param  ?string  $nextToken  Used for pagination when there are more orders than the specified result size limit. The token value is returned in the previous API call.
     * @param  ?string  $includeDetails  When true, returns the complete purchase order details. Otherwise, only purchase order numbers are returned.
     */
    public function __construct(
        protected \DateTimeInterface $createdAfter,
        protected \DateTimeInterface $createdBefore,
        protected ?string $shipFromPartyId = null,
        protected ?string $status = null,
        protected ?int $limit = null,
        protected ?string $sortOrder = null,
        protected ?string $nextToken = null,
        protected ?string $includeDetails = null,
    ) {
        $rdtMiddleware = new RestrictedDataToken('/vendor/directFulfillment/orders/v1/purchaseOrders', 'GET', []);
        $this->middleware()->onRequest($rdtMiddleware);
    }

    public function resolveEndpoint(): string
    {
        return '/vendor/directFulfillment/orders/v1/purchaseOrders';
    }

    public function createDtoFromResponse(Response $response): GetOrdersResponse
    {
        $status = $response->status();
        $responseCls = match ($status) {
            200, 400, 403, 404, 415, 429, 500, 503 => GetOrdersResponse::class,
            default => throw new Exception("Unhandled response status: {$status}")
        };

        return $responseCls::deserialize($response->json());
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'createdAfter' => $this->createdAfter?->format('Y-m-d\TH:i:s\Z'),
            'createdBefore' => $this->createdBefore?->format('Y-m-d\TH:i:s\Z'),
            'shipFromPartyId' => $this->shipFromPartyId,
            'status' => $this->status,
            'limit' => $this->limit,
            'sortOrder' => $this->sortOrder,
            'nextToken' => $this->nextToken,
            'includeDetails' => $this->includeDetails,
        ]);
    }
}
