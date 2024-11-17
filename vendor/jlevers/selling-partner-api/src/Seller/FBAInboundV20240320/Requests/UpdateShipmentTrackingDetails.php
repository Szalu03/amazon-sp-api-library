<?php

/**
 * This file is auto-generated by Saloon SDK Generator
 * Generator: SellingPartnerApi\Generator\Generators\RequestGenerator
 * Do not modify it directly.
 */

declare(strict_types=1);

namespace SellingPartnerApi\Seller\FBAInboundV20240320\Requests;

use Exception;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use SellingPartnerApi\Request;
use SellingPartnerApi\Seller\FBAInboundV20240320\Dto\UpdateShipmentTrackingDetailsRequest;
use SellingPartnerApi\Seller\FBAInboundV20240320\Responses\ErrorList;
use SellingPartnerApi\Seller\FBAInboundV20240320\Responses\UpdateShipmentTrackingDetailsResponse;

/**
 * updateShipmentTrackingDetails
 */
class UpdateShipmentTrackingDetails extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * @param  string  $inboundPlanId  Identifier of an inbound plan.
     * @param  string  $shipmentId  Identifier of a shipment. A shipment contains the boxes and units being inbounded.
     * @param  UpdateShipmentTrackingDetailsRequest  $updateShipmentTrackingDetailsRequest  The `updateShipmentTrackingDetails` request.
     */
    public function __construct(
        protected string $inboundPlanId,
        protected string $shipmentId,
        public UpdateShipmentTrackingDetailsRequest $updateShipmentTrackingDetailsRequest,
    ) {}

    public function resolveEndpoint(): string
    {
        return "/inbound/fba/2024-03-20/inboundPlans/{$this->inboundPlanId}/shipments/{$this->shipmentId}/trackingDetails";
    }

    public function createDtoFromResponse(Response $response): UpdateShipmentTrackingDetailsResponse|ErrorList
    {
        $status = $response->status();
        $responseCls = match ($status) {
            202 => UpdateShipmentTrackingDetailsResponse::class,
            400, 404, 500, 403, 413, 415, 429, 503 => ErrorList::class,
            default => throw new Exception("Unhandled response status: {$status}")
        };

        return $responseCls::deserialize($response->json());
    }

    public function defaultBody(): array
    {
        return $this->updateShipmentTrackingDetailsRequest->toArray();
    }
}
