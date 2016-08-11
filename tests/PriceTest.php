<?php
namespace WalmartTests;

include __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Command\Exception\CommandClientException;
use Walmart\Price;

class PriceTest extends \PHPUnit_Framework_Testcase
{

    public $config = [];
    public $proxy = null;
    //public $proxy = 'tcp://localhost:8888';
    public $verifySsl = false;
    public $env = Price::ENV_MOCK;
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

    public function testUpdate()
    {
        $client = $this->getClient();
        try {
            $update = $client->update([
                'sku' => '1131270',
                'currency' => 'USD',
                'price' => '55',
            ]);
            $this->assertEquals(200, $update['statusCode']);
            $this->assertEquals('WALMART_US', $update['mart']);
            $this->debug($update);
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
            $update = $client->bulk([
                'PriceFeed' => [
                    'PriceHeader' => [
                        'version' => '1.5',
                    ],
                    'Price' => [
                        [
                            'itemIdentifier' => [
                                'sku' => '1131270'
                            ],
                            'pricingList' => [
                                'pricing' => [
                                    'currentPrice' => [
                                        'value' => [
                                            'currency' => 'USD',
                                            'amount' => '4.00',
                                        ],
                                    ],
                                    'currentPriceType' => 'BASE',
                                    'comparisonPrice' => [
                                        'value' => [
                                            'currency' => 'USD',
                                            'amount' => '5.99',
                                        ],
                                    ],
                                    'priceDisplayCode' => [
                                        'submapType' => 'CHECKOUT',
                                    ],
                                    'effectiveDate' => '2016-07-02T12:38:43-04:00',
                                    'expirationDate' => '2016-08-02T12:38:43-04:00',
                                ]
                            ],
                        ],
                        [
                            'itemIdentifier' => [
                                'sku' => '2435543'
                            ],
                            'pricingList' => [
                                'pricing' => [
                                    'currentPrice' => [
                                        'value' => [
                                            'currency' => 'USD',
                                            'amount' => '4.00',
                                        ],
                                    ],
                                    'currentPriceType' => 'BASE',
                                    'comparisonPrice' => [
                                        'value' => [
                                            'currency' => 'USD',
                                            'amount' => '5.99',
                                        ],
                                    ],
                                    'priceDisplayCode' => [
                                        'submapType' => 'CHECKOUT',
                                    ],
                                    'effectiveDate' => '2016-07-02T12:38:43-04:00',
                                    'expirationDate' => '2016-08-02T12:38:43-04:00',
                                ]
                            ],
                        ],
                    ],
                ],
            ]);
            $this->assertEquals(200, $update['statusCode']);
            $this->assertNotNull($update['feedId']);
            $this->debug($update);
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
        return new Price($config, $this->env);
    }

    private function debug($output)
    {
        if ($this->debugOutput) {
            fwrite(STDERR, print_r($output, true));
        }
    }
}