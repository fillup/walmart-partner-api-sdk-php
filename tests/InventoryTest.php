<?php
namespace WalmartTests;

include __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Command\Exception\CommandClientException;
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
            'consumerId' => getenv('CONSUMER_ID'),
            'privateKey' => getenv('PRIVATE_KEY')
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