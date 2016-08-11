<?php
namespace WalmartTests;

include __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Command\Exception\CommandClientException;
use Walmart\Item;

class ItemTest extends \PHPUnit_Framework_Testcase
{

    public $config = [];
    public $proxy = null;
    //public $proxy = 'tcp://localhost:8888';
    public $verifySsl = false;
    public $env = Item::ENV_MOCK;
    public $debugOutput = false;

    public function __construct()
    {
        $this->config = [
            'max_retries' => 0,
            'http_client_options' => [
                'defaults' => [
                    'proxy' => $this->proxy,
                    'verify' => $this->verifySsl,
                ]
            ],
            'consumerId' => getenv('CONSUMER_ID'),
            'privateKey' => getenv('PRIVATE_KEY')
        ];

        parent::__construct();
    }

    public function testListItems()
    {
        $client = $this->getClient();
        try {
            $items = $client->list(['limit' => 5]);
            $this->assertEquals(200, $items['statusCode']);
            $this->debug($items);
        } catch (CommandClientException $e) {
            $error = $e->getResponse()->getHeader('X-Error');
            $this->fail($e->getMessage() . 'Error: ' . $error);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testGetItem()
    {
        $client = $this->getClient();
        try{
            $sku = 'NO11140_7022363';
            $item = $client->get(['sku' => $sku]);
            $this->debug($item);
            $this->assertEquals(200,$item['statusCode']);
            $this->assertEquals($sku,$item['MPItemView']['sku']);
        } catch (CommandClientException $e) {
            $error = $e->getResponse()->getHeader('X-Error');
            $this->fail($e->getMessage() . 'Error: ' . $error);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testRetireItem()
    {
        $client = $this->getClient();
        try {
            $sku = 'NO11140_7022363';
            $item = $client->retire(['sku' => $sku]);
            $this->debug($item);
            $this->assertEquals(200,$item['statusCode']);
            $this->assertEquals($sku,$item['sku']);
        } catch (CommandClientException $e) {
            $error = $e->getResponse()->getHeader('X-Error');
            $this->fail($e->getMessage() . 'Error: ' . $error);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testBulk()
    {
        $client = $this->getClient();
        try {
            $time = microtime();
            $item = $client->bulk([
                'MPItemFeed' => [
                    'MPItemFeedHeader' => [
                        'version' => '2.1',
                        'requestId' => $time,
                        'requestBatchId' => $time,
                    ],
                    'MPItem' => [
                        [
                            'sku' => 'NO11140_7022363',
                            'Product' => [
                                'productName' => 'Nourison Oasis Hand-Tufted Rectangle Rug',
                                'longDescription' => 'From its supremely plush pile to its satiny yarns and sublime patina, this sensational hand-tufted rug is truly an embarrassment of riches. This hibiscus floral print is certain to take center stage.',
                                'shelfDescription' => 'From its supremely plush pile to its satiny yarns and sublime patina, this sensational hand-tufted rug is truly an embarrassment of riches. This hibiscus floral print is certain to take center stage.',
                                'shortDescription' => 'From its supremely plush pile to its satiny yarns and sublime patina, this sensational hand-tufted rug is truly an embarrassment of riches.',
                                'mainImage' => ['mainImageUrl' => 'http://us-i5.tb.wal.co/dfw/dce07b8c-4239/k2-_b1ed5989-151a-4810-944b-35eee2c7b5b0.v1.jpg'],
                                'productIdentifiers' => [
                                    [
                                        'productIdType' => 'UPC',
                                        'productId' => '06108-OAS02-CHA',
                                    ],
                                ],
                                'productTaxCode' => '203030',
                                'Home' => ['brand' => 'Nourison'],
                            ],
                            'price' => [
                                'currency' => 'USD',
                                'amount' => 198.00,
                            ],
                            'shippingWeight' => [
                                'value' => 10,
                                'unit' => 'LB'
                            ],
                        ],
                        [
                            'sku' => 'NO1234567',
                            'Product' => [
                                'productName' => 'Nourison Oasis Hand-Tufted Rectangle Rug',
                                'longDescription' => 'From its supremely plush pile to its satiny yarns and sublime patina, this sensational hand-tufted rug is truly an embarrassment of riches. This hibiscus floral print is certain to take center stage.',
                                'shelfDescription' => 'From its supremely plush pile to its satiny yarns and sublime patina, this sensational hand-tufted rug is truly an embarrassment of riches. This hibiscus floral print is certain to take center stage.',
                                'shortDescription' => 'From its supremely plush pile to its satiny yarns and sublime patina, this sensational hand-tufted rug is truly an embarrassment of riches.',
                                'mainImage' => ['mainImageUrl' => 'http://us-i5.tb.wal.co/dfw/dce07b8c-4239/k2-_b1ed5989-151a-4810-944b-35eee2c7b5b0.v1.jpg'],
                                'productIdentifiers' => [
                                    [
                                        'productIdType' => 'UPC',
                                        'productId' => '06108-OAS02-CHA',
                                    ],
                                ],
                                'productTaxCode' => '203030',
                                'Home' => ['brand' => 'Nourison'],
                            ],
                            'price' => [
                                'currency' => 'USD',
                                'amount' => 198.00,
                            ],
                            'shippingWeight' => [
                                'value' => 10,
                                'unit' => 'LB'
                            ],
                        ],
                    ],
                ],
            ]);
            $this->debug($item);
            $this->assertEquals(200,$item['statusCode']);
            $this->assertNotNull($item['feedId']);
        } catch (CommandClientException $e) {
            $error = $e->getResponse()->getHeader('X-Error');
            $this->fail($e->getMessage() . 'Error: ' . $error);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    private function getClient($extraConfig = [])
    {
        $config = array_merge_recursive($this->config, $extraConfig);
        return new Item($config, $this->env);
    }

    private function debug($output)
    {
        if ($this->debugOutput) {
            fwrite(STDERR, print_r($output, true));
        }
    }
}