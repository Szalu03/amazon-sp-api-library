<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: SellingPartnerApi\Generator\Generators\RequestGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FinancesV0\Requests;

use Exception;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use SellingPartnerApi\Request;
use SellingPartnerApi\Seller\FinancesV0\Responses\ListFinancialEventsResponse;

/**
 * listFinancialEventsByGroupId
 */
class ListFinancialEventsByGroupId extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  string  $eventGroupId  The identifier of the financial event group to which the events belong.
     * @param  ?int  $maxResultsPerPage  The maximum number of results to return per page. If the response exceeds the maximum number of transactions or 10 MB, the response is `InvalidInput`.
     * @param  ?\DateTimeInterface  $postedAfter  The response includes financial events posted after (or on) this date. This date must be in [ISO 8601](https://developer-docs.amazon.com/sp-api/docs/iso-8601) date-time format. The date-time must be more than two minutes before the time of the request.
     * @param  ?\DateTimeInterface  $postedBefore  The response includes financial events posted before (but not on) this date. This date must be in [ISO 8601](https://developer-docs.amazon.com/sp-api/docs/iso-8601) date-time format.
     *
     * The date-time must be later than `PostedAfter` and more than two minutes before the requestd was submitted. If `PostedAfter` and `PostedBefore` are more than 180 days apart, the response is empty. If you include the `PostedBefore` parameter in your request, you must also specify the `PostedAfter` parameter.
     *
     * **Default:** Two minutes before the time of the request.
     * @param  ?string  $nextToken  The response includes `nextToken` when the number of results exceeds the specified `pageSize` value. To get the next page of results, call the operation with this token and include the same arguments as the call that produced the token. To get a complete list, call this operation until `nextToken` is null. Note that this operation can return empty pages.
     */
    public function __construct(
        protected string $eventGroupId,
        protected ?int $maxResultsPerPage = null,
        protected ?\DateTimeInterface $postedAfter = null,
        protected ?\DateTimeInterface $postedBefore = null,
        protected ?string $nextToken = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/finances/v0/financialEventGroups/{$this->eventGroupId}/financialEvents";
    }

    public function createDtoFromResponse(Response $response): ListFinancialEventsResponse
    {
        $status = $response->status();
        $responseCls = match ($status) {
            200, 400, 403, 404, 429, 500, 503 => ListFinancialEventsResponse::class,
            default => throw new Exception("Unhandled response status: {$status}")
        };

        return $responseCls::deserialize($response->json());
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'MaxResultsPerPage' => $this->maxResultsPerPage,
            'PostedAfter' => $this->postedAfter?->format('Y-m-d\TH:i:s\Z'),
            'PostedBefore' => $this->postedBefore?->format('Y-m-d\TH:i:s\Z'),
            'NextToken' => $this->nextToken,
        ]);
    }
}