<?php

namespace spbiblioteka\AmazonSpApiLibrary\Variants;

use spbiblioteka\AmazonSpApiLibrary\ConnectToAmazon\AmazonConnector;
use SellingPartnerApi\Seller\FeedsV20210630\Dto\CreateFeedDocumentSpecification;
use SellingPartnerApi\Seller\FeedsV20210630\Dto\CreateFeedSpecification;
use SellingPartnerApi\Seller\ListingsItemsV20210801\Dto\ListingsItemPutRequest;
use SellingPartnerApi\Seller\ListingsItemsV20210801\Requests\GetListingsItem;
use SellingPartnerApi\Seller\ListingsItemsV20210801\Requests\PutListingsItem;

class AmazonVariantCreator
{
    private $connector;
    private $sellerId;
    private $marketplaceId;

    public function __construct(AmazonConnector $amazonConnector, $sellerId, $marketplaceId)
    {
        $this->connector = $amazonConnector->getConnector();
        $this->sellerId = $sellerId;
        $this->marketplaceId = $marketplaceId;
    }

    public function createVariants(array $skus)
    {
        if (count($skus) < 2) {
            throw new \Exception('At least two SKUs are required to create a parent-child relationship.');
        }

        $parentSku = array_shift($skus);
        $childSkus = array_merge([$parentSku], $skus);


        $parentAttributes = $this->createParentListing($parentSku);


        $relationFeedId = $this->createChildRelationships($parentSku, $childSkus);

        return [
            'parent_sku' => $parentSku,
            'relation_feed_id' => $relationFeedId
        ];
    }

    private function createParentListing($sku)
    {
        $getRequest = new GetListingsItem(
            sellerId: $this->sellerId,
            sku: $sku,
            marketplaceIds: [$this->marketplaceId],
            issueLocale: 'de_DE',
            includedData: ['summaries', 'attributes']
        );

        $response = $this->connector->send($getRequest);
        $listingData = $response->json();
        $attributes = $listingData['attributes'];

        // Pełen zestaw atrybutów rodzica
        $parentAttributes = [
            "product_description" => $attributes['product_description'] ?? [],
            "batteries_required" => $attributes['batteries_required'] ?? [[
                    "value" => false,
                    "marketplace_id" => $this->marketplaceId
                ]],
            "supplier_declared_dg_hz_regulation" => $attributes['supplier_declared_dg_hz_regulation'] ?? [],
            "country_of_origin" => $attributes['country_of_origin'] ?? [],
            "item_name" => $attributes['item_name'] ?? [],
            "brand" => $attributes['brand'] ?? [],
            "manufacturer" => $attributes['manufacturer'] ?? [],
            "recommended_browse_nodes" => $attributes['recommended_browse_nodes'] ?? [],
            "variation_theme" => [
                [
                    "name" => "COLOR_NAME",
                    "marketplace_id" => $this->marketplaceId
                ]
            ],
            "condition_type" => $attributes['condition_type'] ?? [],
            "bullet_point" => $attributes['bullet_point'] ?? [],
            "parentage_level" => [
                [
                    "marketplace_id" => $this->marketplaceId,
                    "value" => "parent"
                ]
            ],
            "child_parent_sku_relationship" => [
                [
                    "marketplace_id" => $this->marketplaceId,
                    "child_relationship_type" => "variation"
                ]
            ]
        ];

        $listingsItemPutRequest = new ListingsItemPutRequest(
            productType: $listingData['summaries'][0]['productType'],
            attributes: $parentAttributes
        );

        $putRequest = new PutListingsItem(
            sellerId: $this->sellerId,
            sku: 'PARENT_' . $sku,
            listingsItemPutRequest: $listingsItemPutRequest,
            marketplaceIds: [$this->marketplaceId],
            issueLocale: 'de_DE'
        );

        $putResponse = $this->connector->send($putRequest);
        $putResponseData = $putResponse->json();

        if ($putResponseData['status'] !== 'ACCEPTED') {
            throw new \Exception('Failed to create parent SKU. Details: ' . json_encode($putResponseData, JSON_PRETTY_PRINT));
        }

        return $parentAttributes;
    }

    private function createChildRelationships($parentSku, $childSkus)
    {
        $children = [];
        foreach ($childSkus as $sku) {
            $getRequest = new GetListingsItem(
                sellerId: $this->sellerId,
                sku: $sku,
                marketplaceIds: [$this->marketplaceId],
                issueLocale: 'de_DE',
                includedData: ['attributes']
            );

            $response = $this->connector->send($getRequest);
            $listingData = $response->json();
            $attributes = $listingData['attributes'];
            $color = $attributes['color'][0]['value'] ?? 'Unknown';
            $children[] = ['sku' => $sku, 'ColorName' => $color];
        }

        $xmlContentRelation = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<AmazonEnvelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="amzn-envelope.xsd">
    <Header>
        <DocumentVersion>1.01</DocumentVersion>
        <MerchantIdentifier>{$this->sellerId}</MerchantIdentifier>
    </Header>
    <MessageType>Relationship</MessageType>
    <Message>
        <MessageID>1</MessageID>
        <OperationType>Update</OperationType>
        <Relationship>
            <ParentSKU>PARENT_{$parentSku}</ParentSKU>
XML;

        foreach ($children as $child) {
            $xmlContentRelation .= "
                <Relation>
                    <SKU>{$child['sku']}</SKU>
                    <Type>Variation</Type>
                </Relation>";
        }

        $xmlContentRelation .= "
            </Relationship>
        </Message>
</AmazonEnvelope>";

        $feedsApi = $this->connector->feedsV20210630();
        $createFeedDocSpec = new CreateFeedDocumentSpecification('text/xml');
        $createDocumentResponse = $feedsApi->createFeedDocument($createFeedDocSpec);
        $feedDocument = $createDocumentResponse->dto();

        // Przesyłanie danych XML
        $ch = curl_init($feedDocument->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlContentRelation);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: text/xml']);
        curl_exec($ch);
        curl_close($ch);

        $createFeedSpec = new CreateFeedSpecification(
            feedType: 'POST_PRODUCT_RELATIONSHIP_DATA',
            marketplaceIds: [$this->marketplaceId],
            inputFeedDocumentId: $feedDocument->feedDocumentId
        );

        $createFeedResponse = $feedsApi->createFeed($createFeedSpec);
        return $createFeedResponse->dto()->feedId;
    }
}

?>
