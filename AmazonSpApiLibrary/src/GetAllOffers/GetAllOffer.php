<?php

namespace spbiblioteka\AmazonSpApiLibrary\GetAllOffers;

use SellingPartnerApi\Seller\ReportsV20210630\Requests\CreateReport;
use SellingPartnerApi\Seller\ReportsV20210630\Dto\CreateReportSpecification;
use spbiblioteka\AmazonSpApiLibrary\ConnectToAmazon\AmazonConnector;
use Exception;

class GetAllOffer
{
    private $connector;

    public function __construct(AmazonConnector $amazonConnector)
    {
        $this->connector = $amazonConnector->getConnector();
    }

    public function getAllOffers(string $marketplaceId, int $statusCheckInterval = 5, int $maxAttempts = 20): string
    {
        try {
            // Krok 1: Zgłoszenie żądania raportu
            $createReportSpecification = new CreateReportSpecification(
                reportType: 'GET_MERCHANT_LISTINGS_ALL_DATA',
                marketplaceIds: [$marketplaceId]
            );

            $createReportRequest = new CreateReport($createReportSpecification);
            $reportResponse = $this->connector->send($createReportRequest);
            $reportId = $reportResponse->json()['reportId'];
            echo "Raport został zgłoszony. ID raportu: $reportId\n";

            // Krok 2: Sprawdzanie statusu raportu
            $reportsApi = $this->connector->reportsV20210630();
            $attempts = 0;

            do {
                sleep($statusCheckInterval);
                $reportStatus = $reportsApi->getReport($reportId);
                $status = $reportStatus->json()['processingStatus'];
                echo "Status raportu: $status\n";

                if ($status === 'DONE') {
                    $reportDocumentId = $reportStatus->json()['reportDocumentId'];
                    break;
                }

                if (++$attempts >= $maxAttempts) {
                    throw new Exception("Generowanie raportu przekroczyło limit czasu.");
                }
            } while ($status !== 'DONE');

            // Krok 3: Pobranie dokumentu raportu
            $reportDocument = $reportsApi->getReportDocument($reportDocumentId, 'GET_MERCHANT_LISTINGS_ALL_DATA');
            $reportUrl = $reportDocument->json()['url'];

            echo "Link do pobrania raportu z ofertami: $reportUrl\n";
            return $reportUrl;

        } catch (Exception $e) {
            echo 'Błąd: ' . $e->getMessage() . "\n";
            return '';
        }
    }
}
