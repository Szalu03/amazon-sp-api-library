<?php

namespace spbiblioteka\AmazonSpApiLibrary\GetParametersForCategory;

use spbiblioteka\AmazonSpApiLibrary\ConnectToAmazon\AmazonConnector;
use SellingPartnerApi\Seller\ProductTypeDefinitionsV20200901\Requests\GetDefinitionsProductType;
use Exception;

class GetParametersForCategory
{
    private $connector;

    public function __construct(AmazonConnector $amazonConnector)
    {
        $this->connector = $amazonConnector->getConnector();
    }

    public function GetParametersCategory($productTypeName, $marketplaceIds)
    {
        try {
            $productTypeRequest = new GetDefinitionsProductType(
                productType: $productTypeName,
                marketplaceIds: $marketplaceIds
            );

            $response = $this->connector->send($productTypeRequest);
            return $response->json();
        } catch (Exception $e) {
            throw new Exception("API Error: " . $e->getMessage());
        }
    }
}