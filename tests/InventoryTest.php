<?php
namespace WalmartTests;

include __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Command\Exception\CommandClientException;
use Sil\PhpEnv\Env;
use Walmart\Inventory;

class InventoryTest extends \PHPUnit_Framework_TestCase
{

    public $config = [];
    public $proxy = null;
    //public $proxy = 'tcp://localhost:8888';
    public $verifySsl = false;
    public $env = Inventory::ENV_MOCK;
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

    public function testGet()
    {
        $client = $this->getClient();
        try {
            $feed = $client->get(['sku' => '86678GHGHGKL']);
            $this->debug($feed);

            $this->assertEquals(200, $feed['statusCode']);
            $this->assertEquals('86678GHGHGKL', $feed['sku']);
            $this->assertEquals(23, $feed['quantity']['amount']);
        } catch (CommandClientException $e) {
            $error = $e->getResponse()->getHeader('X-Error');
            $this->fail($e->getMessage() . 'Error: ' . $error);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testUpdate()
    {
        $client = $this->getClient();
        try {
            $feed = $client->update([
                'inventory' => [
                    'sku' => 'NO11140_7022363',
                    'quantity' => [
                        'unit' => 'EACH',
                        'amount' => 5,
                    ],
                    'fulfillmentLagTime' => 3,
                ],
            ]);
            $this->debug($feed);

            $this->assertEquals(200, $feed['statusCode']);
            $this->assertEquals('86678GHGHGKL', $feed['sku']);
            $this->assertEquals(23, $feed['quantity']['amount']);
        } catch (CommandClientException $e) {
            $error = $e->getResponse()->getHeader('X-Error');
            $this->fail($e->getMessage() . 'Error: ' . $error);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testBulkUpdate()
    {
        $client = $this->getClient();
        try {
            $feed = $client->bulk([
                'InventoryFeed' => [
                    'InventoryHeader' => [
                        'version' => '1.4',
                    ],
                    'inventory' => [
                        [
                            'sku' => '86678GHGHGKL',
                            'quantity' => [
                                'unit' => 'EACH',
                                'amount' => 5,
                            ],
                            'fulfillmentLagTime' => 3,
                        ],
                        [
                            'sku' => '12345678',
                            'quantity' => [
                                'unit' => 'EACH',
                                'amount' => 9,
                            ],
                            'fulfillmentLagTime' => 1,
                        ]
                    ],
                ]
            ]);
            $this->debug($feed);

            $this->assertEquals(200, $feed['statusCode']);
            $this->assertEquals('62a05384-37cd-4afc-95ca-c68241e6902a', $feed['feedId']);
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
        return new Inventory($config, $this->env);
    }

    private function debug($output)
    {
        if ($this->debugOutput) {
            fwrite(STDERR, print_r($output, true));
        }
    }
}