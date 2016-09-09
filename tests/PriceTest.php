<?php
namespace WalmartTests;

include __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Command\Exception\CommandClientException;
use Sil\PhpEnv\Env;
use Walmart\Price;

class PriceTest extends \PHPUnit_Framework_TestCase
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
            'consumerId' => Env::get('CONSUMER_ID', 'hw30cqp3-35fi-1bi0-3312-hw9fgm30d2p4'),
            'privateKey' => Env::get('PRIVATE_KEY', 'MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAKzXEfCYdnBNkKAwVbCpg/tR40WixoZtiuEviSEi4+LdnYAAPy57Qw6+9eqJGTh9iCB2wP/I8lWh5TZ49Hq/chjTCPeJiOqi6bvX1xzyBlSq2ElSY3iEVKeVoQG/5f9MYQLEj5/vfTWSNASsMwnNeBbbHcV1S1aY9tOsXCzRuxapAgMBAAECgYBjkM1j1OA9l2Ed9loWl8BQ8X5D6h4E6Gudhx2uugOe9904FGxRIW6iuvy869dchGv7j41ki+SV0dpRw+HKKCjYE6STKpe0YwIm/tml54aNDQ0vQvF8JWILca1a7v3Go6chf3Ib6JPs6KVsUuNo+Yd+jKR9GAKgnDeXS6NZlTBUAQJBANex815VAySumJ/n8xR+h/dZ2V5qGj6wu3Gsdw6eNYKQn3I8AGQw8N4yzDUoFnrQxqDmP3LOyr3/zgOMNTdszIECQQDNIxiZOVl3/Sjyxy9WHMk5qNfSf5iODynv1OlTG+eWao0Wj/NdfLb4pwxRsf4XZFZ1SQNkbNne7+tEO8FTG1YpAkAwNMY2g/ty3E6iFl3ea7UJlBwfnMkGz8rkye3F55f/+UCZcE2KFuIOVv4Kt03m3vg1h6AQkaUAN8acRl6yZ2+BAkEAke2eiRmYANiR8asqjGqr5x2qcm8ceiplXdwrI1kddQ5VUbCTonSewOIszEz/gWp6arLG/ADHOGWaCo8rptAyiQJACXd1ddXUAKs6x3l752tSH8dOde8nDBgF86NGvgUnBiAPPTmJHuhWrmOZmNaB68PsltEiiFwWByGFV+ld9VKmKg=='),
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