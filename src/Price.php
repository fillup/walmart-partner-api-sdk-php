<?php
namespace Walmart;

use fillup\A2X;
use GuzzleHttp\Post\PostFile;

/**
 * Partial Walmart API client implemented with Guzzle.
 *
 * @method array update(array $config = [])
 */
class Price extends BaseClient
{
    /**
     * @param array $config
     * @param string $env
     */
    public function __construct(array $config = [], $env = self::ENV_PROD)
    {
        // Apply some defaults.
        $config += [
            'description_path' => __DIR__ . '/descriptions/price.php',
        ];

        // Create the client.
        parent::__construct(
            $config,
            $env
        );

    }

    /**
     * @param array $items
     * @return array
     * @throws \Exception
     */
    public function bulk($items)
    {
        if ( ! is_array($items)) {
            throw new \Exception('Items is not an array', 1466349195);
        }

        $schema = [
            '/PriceFeed/Price' => [
                'sendItemsAs' => 'Price',
                'includeWrappingTag' => false,
            ],
            '/PriceFeed/Price/Price/pricingList/pricing' => [
                'attributes' => [
                    'effectiveDate', 'expirationDate',
                ],
            ],
            '/PriceFeed/Price/Price/pricingList/pricing/currentPrice/value' => [
                'attributes' => [
                    'currency', 'amount',
                ],
            ],
            '/PriceFeed/Price/Price/pricingList/pricing/comparisonPrice/value' => [
                'attributes' => [
                    'currency', 'amount',
                ],
            ],
            '/PriceFeed/Price/Price/pricingList/pricing/priceDisplayCode' => [
                'attributes' => [
                    'submapType',
                ],
            ],
        ];

        $a2x = new A2X($items, $schema);
        $xml = $a2x->asXml();

        $file = new PostFile('file', $xml, 'file.xml', ['Content-Type' => 'text/xml']);

        return $this->bulkUpdate([
            'file' => $file,
        ]);
    }
}