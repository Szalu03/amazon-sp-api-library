<?php


namespace spbiblioteka\AmazonSpApiLibrary\GetCategoryInfoByASIN;

use spbiblioteka\AmazonSpApiLibrary\ConnectToAmazon\AmazonConnector;
use SellingPartnerApi\Seller\CatalogItemsV0\Requests\GetCatalogItem;
use Exception;

class GetCategoryInfoByASIN
{
    private $connector;

    public function __construct(AmazonConnector $amazonConnector)
    {
        $this->connector = $amazonConnector->getConnector();
    }

    public function getCategoryInfo(string $asin, string $marketplaceId): array
    {
        try {
            $catalogRequest = new GetCatalogItem(
                asin: $asin,
                marketplaceId: $marketplaceId
            );

            $catalogResponse = $this->connector->send($catalogRequest);

            if ($catalogResponse->successful()) {
                return $catalogResponse->json();
            } else {
                // Zwrócenie błędów, jeśli żądanie się nie powiodło
                return [
                    'success' => false,
                    'errors' => $catalogResponse->json('errors')
                ];
            }
        } catch (Exception $e) {
            throw new Exception("Error retrieving catalog data: " . $e->getMessage());
        }
    }
}