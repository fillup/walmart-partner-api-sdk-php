<?php
namespace WalmartTests;

include __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Command\Exception\CommandClientException;
use Sil\PhpEnv\Env;
use Walmart\Order;

class OrderTest extends \PHPUnit_Framework_TestCase
{

    public $config = [];
    public $proxy = null;
    //public $proxy = 'tcp://localhost:8888';
    public $verifySsl = false;
    public $env = Order::ENV_MOCK;
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
            'wmConsumerChannelType' => Env::get('WM_CONSUMER_CHANNEL_TYPE', 'ABC123'),
        ];

        parent::__construct();
    }

    public function testExceptionThrown()
    {
        $config = [
            'description_override' => [
                'baseUrl' => 'http://google.com'
            ]
        ];

        $order = $this->getClient($config);

        $this->setExpectedException('GuzzleHttp\Command\Exception\CommandClientException');

        $order->listReleased([
            'createdStartDate' => '2015-05-01',
        ]);

    }

    public function testListReleasedOrders()
    {
        $client = $this->getClient();

        $orders = $client->listReleased([
            'createdStartDate' => '2016-06-01', //date('Y-m-d', time() - 5184000), // approx 60 days ago
            'limit' => 2,
        ]);
        $this->debug($orders);
        $this->assertEquals(200,$orders['statusCode']);
        $this->assertArrayHasKey('totalCount',$orders['meta']);

    }

    public function testListOrders()
    {
        $client = $this->getClient();

        $orders = $client->list([
            'createdStartDate' => '2016-06-01', //date('Y-m-d', time() - 5184000), // approx 60 days ago
            'limit' => 10,
        ]);
        $this->debug($orders);
        $this->assertEquals(200,$orders['statusCode']);
        $this->assertArrayHasKey('totalCount',$orders['meta']);
    }

//    public function testListOrdersNextCursor()
//    {
//        $this->markTestSkipped("next cursor not working yet due to automatic url encoding");
//        $client = $this->getClient();
//        try{
//            $orders = $client->list([
//                'nextCursor' => '?limit=2&hasMoreElements=true&soIndex=2&poIndex=0&partnerId=255045&sellerId=3&createdStartDate=2015-10-01&createdEndDate=2015-11-07T19:35:20.935Z',
//            ]);
//            $this->assertEquals(200,$orders['statusCode']);
//            //$this->assertEquals(2,count($orders['elements']));
//            $this->debug($orders);
//        } catch (RequestException $e) {
//            echo $e->getMessage();
//            //echo $e->getResponse()->getBody(true);
//        }
//    }

    public function testGetOrder()
    {
        $client = $this->getClient();
        $id = '2575693098967';//'2575693098947';
        $order = $client->get([
            'purchaseOrderId' => $id,
        ]);
        $this->assertEquals(200, $order['statusCode']);
        $this->assertEquals($id, $order['purchaseOrderId']);
        $this->debug($order);
    }

    public function testAcknowledgeOrder()
    {
        $client = $this->getClient();
        $id = '2575693098967';
        $order = $client->acknowledge([
            'purchaseOrderId' => $id,
        ]);
        $this->debug($order);
        $this->assertEquals(200, $order['statusCode']);
        $this->assertEquals($id, $order['purchaseOrderId']);
    }

    public function testCancelOrder()
    {
        $client = $this->getClient();
        $purchaseOrderId = '2575693098947';
        $order = [
            'orderCancellation' => [
                'orderLines' => [
                    [
                        'lineNumber' => 1,
                        'orderLineStatuses' => [
                            [
                                'status' => 'Cancelled',
                                'cancellationReason' => 'CANCEL_BY_SELLER',
                                'statusQuantity' => [
                                    'unitOfMeasurement' => 'EACH',
                                    'amount' => 1
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $response = $client->cancel($purchaseOrderId, $order);
        $this->debug($response);
        $this->assertEquals(200,$response['statusCode']);
    }

    public function testShipOrder()
    {
        $client = $this->getClient();
        $purchaseOrderId = 2575683098510;
        $order = [
            'orderShipment' => [
                'orderLines' => [
                    [
                        'lineNumber' => 1,
                        'orderLineStatuses' => [
                            [
                                'status' => 'Shipped',
                                'statusQuantity' => [
                                    'unitOfMeasurement' => 'Each',
                                    'amount' => 1
                                ],
                                'trackingInfo' => [
                                    'shipDateTime' => '2016-06-27T05:30:15Z',
                                    'carrierName' => [
                                        'carrier' => 'FedEx'
                                    ],
                                    'methodCode' => 'Standard',
                                    'trackingNumber' => '12333634122',
                                    'trackingURL' => 'https://www.fedex.com',
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $response = $client->ship($purchaseOrderId, $order);
        $this->debug($response);
        $this->assertEquals(200, $response['statusCode']);
    }

    public function testRefundOrder()
    {
        $exampleRefund = [
            'orderRefund' => [
                'purchaseOrderId' => '123456789',
                'orderLines' => [
                    [
                        'lineNumber' => 1,
                        'refunds' => [
                            [
                                'refundComments' => 'test test',
                                'refundCharges' => [
                                    [
                                        'refundReason' => 'DamagedItem',
                                        'charge' => [
                                            'chargeType' => 'SHIPPING',
                                            'chargeName' => 'Shipping Price',
                                            'chargeAmount' => [
                                                'currency' => 'USD',
                                                'amount' => -0.1,
                                            ],
                                            'tax' => [
                                                'taxName' => 'Shipping Tax',
                                                'taxAmount' => [
                                                    'currency' => 'USD',
                                                    'amount' => -0.04,
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'lineNumber' => 2,
                        'refunds' => [
                            [
                                'refundComments' => 'test test',
                                'refundCharges' => [
                                    [
                                        'refundReason' => 'DamagedItem',
                                        'charge' => [
                                            'chargeType' => 'PRODUCT',
                                            'chargeName' => 'Item Price',
                                            'chargeAmount' => [
                                                'currency' => 'USD',
                                                'amount' => -0.1,
                                            ],
                                            'tax' => [
                                                'taxName' => 'Shipping Tax',
                                                'taxAmount' => [
                                                    'currency' => 'USD',
                                                    'amount' => -0.04,
                                                ]
                                            ]
                                        ]
                                    ],
                                    [
                                        'refundReason' => 'DamagedItem',
                                        'charge' => [
                                            'chargeType' => 'SHIPPING',
                                            'chargeName' => 'Shipping Price',
                                            'chargeAmount' => [
                                                'currency' => 'USD',
                                                'amount' => -0.1,
                                            ],
                                            'tax' => [
                                                'taxName' => 'Shipping Tax',
                                                'taxAmount' => [
                                                    'currency' => 'USD',
                                                    'amount' => -0.04,
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],

                ]
            ]
        ];

        $client = $this->getClient();
        try {
            $response = $client->refund('123456789', $exampleRefund);
            $this->debug($response);
            $this->assertEquals(200,$response['statusCode']);
            $this->assertEquals(4021603841173,$response['customerOrderId']);
        } catch (CommandClientException $e) {
            $error = $e->getResponse()->getHeader('X-Error');
            $this->fail($e->getMessage() . 'Error: ' . $error);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testListReleasedNoOrders()
    {
        $client = $this->getClient();
        try {
            $response = $client->listReleased([
                'createdStartDate' => '2016-10-01',
                'limit' => 5,
            ]);
            $this->assertEquals(0, $response['list']['meta']['totalCount']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function testListNoOrders()
    {
        $client = $this->getClient();
        try {
            $response = $client->list([
                'createdStartDate' => '2016-10-01',
                'limit' => 5,
                'status' => 'Shipped',
            ]);
            $this->assertEquals(0, $response['list']['meta']['totalCount']);
        } catch (\Exception $e) {
            throw $e;
        }
    }



    private function getClient($extraConfig = [])
    {
        $config = array_merge_recursive($this->config, $extraConfig);
        return new Order($config, $this->env);
    }

    private function debug($output)
    {
        if ($this->debugOutput) {
            fwrite(STDERR, print_r($output, true));
        }
    }
}
