<?php

namespace spbiblioteka\AmazonSpApiLibrary\ConnectToAmazon;

use SellingPartnerApi\Enums\Endpoint;
use SellingPartnerApi\SellingPartnerApi;

class AmazonConnector
{
    private $connector;

    public function __construct($clientId, $clientSecret, $refreshToken, $endpoint = Endpoint::EU)
    {
        $this->connector = SellingPartnerApi::seller(
            clientId: $clientId,
            clientSecret: $clientSecret,
            refreshToken: $refreshToken,
            endpoint: $endpoint
        );
    }

    public function getConnector(): SellingPartnerApi
    {
        return $this->connector;
    }
}
?>
