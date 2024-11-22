<?php

namespace spbiblioteka\AmazonSpApiLibrary\AddingAContentToOffer;

use SellingPartnerApi\Seller\APlusContentV20201101\Dto\PostContentDocumentAsinRelationsRequest;
use SellingPartnerApi\Seller\APlusContentV20201101\Requests\PostContentDocumentApprovalSubmission;
use SellingPartnerApi\Seller\APlusContentV20201101\Requests\PostContentDocumentAsinRelations;
use spbiblioteka\AmazonSpApiLibrary\ConnectToAmazon\AmazonConnector;
use SellingPartnerApi\Seller\UploadsV20201101\Requests\CreateUploadDestinationForResource;
use SellingPartnerApi\Seller\APlusContentV20201101\Requests\CreateContentDocument;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\ContentDocument;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\ContentModule;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\StandardImageTextOverlayModule;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\StandardSingleSideImageModule;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\TextComponent;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\StandardImageTextBlock;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\ImageComponent;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\ImageCropSpecification;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\ImageDimensions;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\IntegerWithUnits;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\ImageOffsets;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\ParagraphComponent;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\PostContentDocumentRequest;
use SellingPartnerApi\Seller\APlusContentV20201101\Dto\Decorator;
use Saloon\Http\Response;
class APlusContent
{
    private $client;
    private $marketplaceId;

    public function __construct(AmazonConnector $connector, string $marketplaceId)
    {
        $this->client = $connector->getConnector();
        $this->marketplaceId = $marketplaceId;
    }

    // Funkcja do tworzenia miejsca docelowego dla obrazu
    private function createImageUploadDestination($contentMd5, $contentType = 'image/jpeg')
    {
        $resource = 'aplus/2020-11-01/contentDocuments';
        $request = new CreateUploadDestinationForResource($resource, [$this->marketplaceId], $contentMd5, $contentType);
        return $this->client->send($request);
    }

    // Funkcja do przesyłania obrazu do docelowego URL
    private function uploadImageToDestinationMultipart($url, $filePath, $credentials)
    {
        $ch = curl_init();
        $imageFile = new CURLFile($filePath);

        $postFields = [
            'key' => $credentials['key'],
            'acl' => 'private',
            'policy' => $credentials['policy'],
            'x-amz-algorithm' => 'AWS4-HMAC-SHA256',
            'x-amz-credential' => $credentials['x-amz-credential'],
            'x-amz-date' => $credentials['x-amz-date'],
            'x-amz-signature' => $credentials['x-amz-signature'],
            'x-amz-meta-owner' => $credentials['x-amz-meta-owner'],
            'file' => $imageFile
        ];

        $baseUrl = strtok($url, '?');

        curl_setopt($ch, CURLOPT_URL, $baseUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch) . "\n";
        }

        curl_close($ch);
        return $httpCode === 204;
    }

    // Funkcja do przesyłania dwóch obrazów i uzyskania uploadDestinationId
    public function uploadTwoImages($imagePath1, $imagePath2)
    {
        $imagePaths = [$imagePath1, $imagePath2];
        $uploadDestinationIds = [];

        foreach ($imagePaths as $imagePath) {
            $imageMd5 = base64_encode(md5_file($imagePath, true));
            $imageUploadResponse = $this->createImageUploadDestination($imageMd5);

            if ($imageUploadResponse instanceof Response) {
                $uploadDestination = $imageUploadResponse->json();

                if (isset($uploadDestination['payload']['uploadDestinationId'], $uploadDestination['payload']['url'])) {
                    $uploadUrl = $uploadDestination['payload']['url'];
                    $urlComponents = parse_url($uploadUrl);
                    parse_str($urlComponents['query'], $queryParams);

                    $credentials = [
                        'key' => $queryParams['key'],
                        'policy' => $queryParams['policy'],
                        'x-amz-credential' => $queryParams['x-amz-credential'],
                        'x-amz-date' => $queryParams['x-amz-date'],
                        'x-amz-signature' => $queryParams['x-amz-signature'],
                        'x-amz-meta-owner' => $queryParams['x-amz-meta-owner']
                    ];

                    if ($this->uploadImageToDestinationMultipart($uploadUrl, $imagePath, $credentials)) {
                        echo "Obraz $imagePath pomyślnie przesłany do Amazon.\n";
                        $uploadDestinationIds[] = $uploadDestination['payload']['uploadDestinationId'];
                    } else {
                        echo "Nie udało się przesłać obrazu $imagePath do Amazon.\n";
                    }
                }
            }
        }
        return $uploadDestinationIds;
    }

    // Funkcja do tworzenia dokumentu A+ Content
    public function createAPlusContentDocument($uploadDestinationId1, $uploadDestinationId2, $name, $altText1, $headline1, $body1, $altText2, $headline2, $body2)
    {
        // Moduł 1: STANDARD_IMAGE_TEXT_OVERLAY (DARK)
        $module1 = new ContentModule(
            contentModuleType: 'STANDARD_IMAGE_TEXT_OVERLAY',
            standardImageTextOverlay: new StandardImageTextOverlayModule(
                overlayColorType: 'DARK',
                block: new StandardImageTextBlock(
                    image: new ImageComponent(
                        uploadDestinationId: 'aplus-media-library-service-media/3ada5e79-a9dc-4e29-9a24-5ca0f736f309.png',
                        imageCropSpecification: new ImageCropSpecification(
                            size: new ImageDimensions(
                                width: new IntegerWithUnits(value: 970, units: 'pixels'),
                                height: new IntegerWithUnits(value: 300, units: 'pixels')
                            ),
                            offset: new ImageOffsets(
                                x: new IntegerWithUnits(value: 0, units: 'pixels'),
                                y: new IntegerWithUnits(value: 0, units: 'pixels')
                            )
                        ),
                        altText: 'przydasie'
                    ),
                    body: new ParagraphComponent(
                        textList: [
                            new TextComponent(value: ' ')
                        ]
                    )
                )
            )
        );

        // Moduł 2: STANDARD_SINGLE_SIDE_IMAGE (LEFT)
        $module2 = new ContentModule(
            contentModuleType: 'STANDARD_SINGLE_SIDE_IMAGE',
            standardSingleSideImage: new StandardSingleSideImageModule(
                imagePositionType: 'LEFT',
                block: new StandardImageTextBlock(
                    image: new ImageComponent(
                        uploadDestinationId: $uploadDestinationId1,
                        imageCropSpecification: new ImageCropSpecification(
                            size: new ImageDimensions(
                                width: new IntegerWithUnits(value: 812, units: 'pixels'),
                                height: new IntegerWithUnits(value: 812, units: 'pixels')
                            ),
                            offset: new ImageOffsets(
                                x: new IntegerWithUnits(value: 134, units: 'pixels'),
                                y: new IntegerWithUnits(value: 0, units: 'pixels')
                            )
                        ),
                        altText: $altText1
                    ),
                    headline: new TextComponent(value: $headline1),
                    body: new ParagraphComponent(
                        textList: [
                            new TextComponent(value: $body1)
                        ]
                    )
                )
            )
        );

        // Moduł 3: STANDARD_SINGLE_SIDE_IMAGE (RIGHT)
        $module3 = new ContentModule(
            contentModuleType: 'STANDARD_SINGLE_SIDE_IMAGE',
            standardSingleSideImage: new StandardSingleSideImageModule(
                imagePositionType: 'RIGHT',
                block: new StandardImageTextBlock(
                    image: new ImageComponent(
                        uploadDestinationId: $uploadDestinationId2,
                        imageCropSpecification: new ImageCropSpecification(
                            size: new ImageDimensions(
                                width: new IntegerWithUnits(value: 541, units: 'pixels'),
                                height: new IntegerWithUnits(value: 541, units: 'pixels')
                            ),
                            offset: new ImageOffsets(
                                x: new IntegerWithUnits(value: 89, units: 'pixels'),
                                y: new IntegerWithUnits(value: 0, units: 'pixels')
                            )
                        ),
                        altText: $altText2
                    ),
                    headline: new TextComponent(value: $headline2),
                    body: new ParagraphComponent(
                        textList: [
                            new TextComponent(
                                value: $body2,
                                decoratorSet: [
                                    new Decorator(type: 'STYLE_BOLD', offset: 0, length: 8, depth: 0),  // Material:
                                    new Decorator(type: 'LIST_ITEM', offset: 0, length: 49, depth: 1),
                                    new Decorator(type: 'LIST_UNORDERED', offset: 0, length: 49, depth: 1),

                                    new Decorator(type: 'STYLE_BOLD', offset: 58, length: 18, depth: 0),  // Verstellbare Höhe:
                                    new Decorator(type: 'LIST_ITEM', offset: 58, length: 39, depth: 1),
                                    new Decorator(type: 'LIST_UNORDERED', offset: 58, length: 39, depth: 1),

                                    new Decorator(type: 'STYLE_BOLD', offset: 98, length: 20, depth: 0),  // Maximale Belastung:
                                    new Decorator(type: 'LIST_ITEM', offset: 98, length: 31, depth: 1),
                                    new Decorator(type: 'LIST_UNORDERED', offset: 98, length: 31, depth: 1),

                                    new Decorator(type: 'STYLE_BOLD', offset: 129, length: 18, depth: 0),  // Integrierte Ablage:
                                    new Decorator(type: 'LIST_ITEM', offset: 129, length: 41, depth: 1),
                                    new Decorator(type: 'LIST_UNORDERED', offset: 129, length: 41, depth: 1),

                                    new Decorator(type: 'STYLE_BOLD', offset: 171, length: 12, depth: 0),  // Abmessungen:
                                    new Decorator(type: 'LIST_ITEM', offset: 171, length: 61, depth: 1),
                                    new Decorator(type: 'LIST_UNORDERED', offset: 171, length: 61, depth: 1),

                                    new Decorator(type: 'STYLE_BOLD', offset: 232, length: 20, depth: 0),  // Leicht zu montieren:
                                    new Decorator(type: 'LIST_ITEM', offset: 232, length: 43, depth: 1),
                                    new Decorator(type: 'LIST_UNORDERED', offset: 232, length: 43, depth: 1),

                                    new Decorator(type: 'STYLE_BOLD', offset: 276, length: 28, depth: 0),  // Ideal für verschiedene Räume:
                                    new Decorator(type: 'LIST_ITEM', offset: 276, length: 55, depth: 1),
                                    new Decorator(type: 'LIST_UNORDERED', offset: 276, length: 55, depth: 1),
                                ]
                            )
                        ]
                    )
                )
            )
        );
        $module4 = new ContentModule(
            contentModuleType: 'STANDARD_IMAGE_TEXT_OVERLAY',
            standardImageTextOverlay: new StandardImageTextOverlayModule(
                overlayColorType: 'LIGHT',
                block: new StandardImageTextBlock(
                    image: new ImageComponent(
                        uploadDestinationId: 'aplus-media-library-service-media/7ee14ae7-30f8-49db-878e-feea0b34d4c4.png',
                        imageCropSpecification: new ImageCropSpecification(
                            size: new ImageDimensions(
                                width: new IntegerWithUnits(value: 970, units: 'pixels'),
                                height: new IntegerWithUnits(value: 300, units: 'pixels')
                            ),
                            offset: new ImageOffsets(
                                x: new IntegerWithUnits(value: 0, units: 'pixels'),
                                y: new IntegerWithUnits(value: 0, units: 'pixels')
                            )
                        ),
                        altText: 'HausundGarten_ver2'
                    ),
                    headline: new TextComponent(value: 'Entdecken Sie die Kategorie "Haus und Garten" in unserem Amazon-Shop!'),
                    body: new ParagraphComponent(
                        textList: [
                            new TextComponent(
                                value: 'Finden Sie stilvolle Dekorationen, funktionale Werkzeuge und bequeme Möbel, die Ihr Zuhause und Ihren Garten verwandeln. Schauen Sie sich unser Angebot noch heute an!'
                            )
                        ]
                    )
                )
            )
        );
        $module5 =  new ContentModule(
            contentModuleType: 'STANDARD_IMAGE_TEXT_OVERLAY',
            standardImageTextOverlay: new StandardImageTextOverlayModule(
                overlayColorType: 'LIGHT',
                block: new StandardImageTextBlock(
                    image: new ImageComponent(
                        uploadDestinationId: 'aplus-media-library-service-media/d6bb298a-9bb5-420c-993f-df1508ac15ee.png',
                        imageCropSpecification: new ImageCropSpecification(
                            size: new ImageDimensions(
                                width: new IntegerWithUnits(value: 970, units: 'pixels'),
                                height: new IntegerWithUnits(value: 300, units: 'pixels')
                            ),
                            offset: new ImageOffsets(
                                x: new IntegerWithUnits(value: 0, units: 'pixels'),
                                y: new IntegerWithUnits(value: 0, units: 'pixels')
                            )
                        ),
                        altText: 'Kids_ver2'
                    ),
                    headline: new TextComponent(value: 'Entdecken Sie unsere Kategorie "Kinder" auf Amazon!'),
                    body: new ParagraphComponent(
                        textList: [
                            new TextComponent(
                                value: 'Wir bieten eine breite Palette an Produkten, die den Alltag Ihrer Kinder bereichern – von Spielzeug über Kleidung bis hin zu Lernmaterialien. Schauen Sie sich unser Angebot an und bereiten Sie Ihren Kindern eine Freude!'
                        )
                    ]
                )
            )
        )
    );
    $newModule = new ContentModule(
        contentModuleType: 'STANDARD_IMAGE_TEXT_OVERLAY',
        standardImageTextOverlay: new StandardImageTextOverlayModule(
            overlayColorType: 'LIGHT',
            block: new StandardImageTextBlock(
                image: new ImageComponent(
                    uploadDestinationId: 'aplus-media-library-service-media/c968c40b-e14c-4a5f-84b5-67fdb3dd20a0.png',
                    imageCropSpecification: new ImageCropSpecification(
                        size: new ImageDimensions(
                            width: new IntegerWithUnits(value: 970, units: 'pixels'),
                            height: new IntegerWithUnits(value: 300, units: 'pixels')
                        ),
                        offset: new ImageOffsets(
                            x: new IntegerWithUnits(value: 0, units: 'pixels'),
                            y: new IntegerWithUnits(value: 0, units: 'pixels')
                        )
                    ),
                    altText: 'SportundTouristik_ver2'
                ),
                headline: new TextComponent(value: 'Erkunden Sie die Kategorie Sport und Touristik in unserem Amazon-Shop!'),
                body: new ParagraphComponent(
                    textList: [
                        new TextComponent(
                            value: 'Hier finden Sie funktionale Ausrüstung, stilvolle Kleidung und praktische Accessoires, die Ihre sportlichen Aktivitäten und Reisen angenehmer machen. Stöbern Sie durch unser Sortiment und starten Sie Ihr nächstes Abenteuer bestens ausgestattet!'
                        )
                    ]
                )
            )
        )
    );
    $module6 =  new ContentModule(
        contentModuleType: 'STANDARD_IMAGE_TEXT_OVERLAY',
        standardImageTextOverlay: new StandardImageTextOverlayModule(
            overlayColorType: 'LIGHT',
            block: new StandardImageTextBlock(
                image: new ImageComponent(
                    uploadDestinationId: 'aplus-media-library-service-media/4ab403da-9ac8-415b-96ad-d1a2537001db.png',
                    imageCropSpecification: new ImageCropSpecification(
                        size: new ImageDimensions(
                            width: new IntegerWithUnits(value: 970, units: 'pixels'),
                            height: new IntegerWithUnits(value: 300, units: 'pixels')
                        ),
                        offset: new ImageOffsets(
                            x: new IntegerWithUnits(value: 0, units: 'pixels'),
                            y: new IntegerWithUnits(value: 0, units: 'pixels')
                        )
                    ),
                    altText: 'OtherCategories_ver2'
                ),
                headline: new TextComponent(value: 'Willkommen in der Kategorie Andere Kategorien in unserem Amazon-Shop!'),
                body: new ParagraphComponent(
                    textList: [
                        new TextComponent(
                            value: 'Wir bieten eine breite Auswahl an funktionalen Produkten für den täglichen Gebrauch – von Haushaltsartikeln bis hin zu technischen Gadgets. Schauen Sie sich unser Angebot noch heute an und finden Sie alles, was Sie für ein komfortables und gut organisiertes Leben benötigen!'
                        )
                    ]
                )
            )
        )
    );

        // Moduły 4, 5, 6 są stałe, jak w poprzednim kodzie (nie zmieniamy ich)

        $contentDocument = new ContentDocument(
            name: $name,
            contentType: 'EBC',
            locale: 'de-DE',
            contentModuleList: [$module1, $module2, $module3, $module4, $module5,$newModule, $module6]
        );

        $request = new CreateContentDocument(
            postContentDocumentRequest: new PostContentDocumentRequest($contentDocument),
            marketplaceId: $this->marketplaceId
        );

        $response = $this->client->send($request);
        $data = $response->json();

        $contentReferenceKey = $data['contentReferenceKey'] ?? null;
        return $contentReferenceKey;
    }
    // Funkcja do przypisywania ASIN do dokumentu A+ Content
    public function assignAsinsToContentDocument($contentReferenceKey, array $asinList)
    {
        // Tworzenie żądania z listą ASIN-ów
        $asinRelationsRequest = new PostContentDocumentAsinRelationsRequest(asinSet: $asinList);

        // Tworzenie instancji żądania przypisania dokumentu do ASIN-ów
        $request = new PostContentDocumentAsinRelations(
            contentReferenceKey: $contentReferenceKey,
            postContentDocumentAsinRelationsRequest: $asinRelationsRequest,
            marketplaceId: $this->marketplaceId
        );

        try {
            // Wysłanie żądania
            $response = $this->client->send($request);

            // Sprawdzenie odpowiedzi na podstawie kodu statusu
            if ($response->status() === 200) {
                echo "ASIN-y zostały pomyślnie przypisane do dokumentu A+ Content!";
            } else {
                // Wyświetlenie szczegółowego komunikatu o błędzie w przypadku niepowodzenia
                echo "Błąd: " . json_encode($response->json());
            }
        } catch (Exception $e) {
            echo "Wystąpił wyjątek: " . $e->getMessage();
        }
    }
    public function submitContentDocumentForApproval($contentReferenceKey)
    {
        // Utworzenie instancji żądania PostContentDocumentApprovalSubmission
        $request = new PostContentDocumentApprovalSubmission(
            contentReferenceKey: $contentReferenceKey,
            marketplaceId: $this->marketplaceId
        );

        try {
            // Wysłanie żądania
            $response = $this->client->send($request);

            // Sprawdzenie kodu statusu odpowiedzi
            if ($response->status() === 200) {
                echo "Dokument został pomyślnie zgłoszony do zatwierdzenia!\n";
                // Obsługa ewentualnych ostrzeżeń
                $warnings = $response->json()['warnings'] ?? [];
                foreach ($warnings as $warning) {
                    echo "Ostrzeżenie: " . json_encode($warning) . PHP_EOL;
                }
            } else {
                echo "Błąd: " . json_encode($response->json());
            }
        } catch (Exception $e) {
            echo "Wystąpił wyjątek: " . $e->getMessage();
        }
    }


}