<?php

namespace spbiblioteka\AmazonSpApiLibrary\GetCategories;

use spbiblioteka\AmazonSpApiLibrary\ConnectToAmazon\AmazonConnector;
use SellingPartnerApi\Seller\ProductTypeDefinitionsV20200901\Requests\SearchDefinitionsProductTypes;
use Exception;
class GetCategories
{
    private $connector;

    public function __construct(AmazonConnector $amazonConnector)
    {
        $this->connector = $amazonConnector->getConnector();
    }

    public function GetAllCategories(array $marketplaceIds): array
    {
        try {
            $productTypeRequest = new SearchDefinitionsProductTypes(
                marketplaceIds: $marketplaceIds
            );

            $response = $this->connector->send($productTypeRequest);

            if ($response->successful()) {
                return $response->json();
            } else {
                // Zwracamy błędy, jeśli żądanie się nie powiodło
                return [
                    'success' => false,
                    'errors' => $response->json('errors')
                ];
            }
        } catch (Exception $e) {
            throw new Exception("Error retrieving product type definitions: " . $e->getMessage());
        }
    }
}
