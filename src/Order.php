<?php
namespace Walmart;

use fillup\A2X;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\ResponseInterface;

/**
 * Partial Walmart API client implemented with Guzzle.
 *
 * @method  array list(array $config = [])
 * @method array get(array $config = [])
 * @method array acknowledge(array $config = [])
 */
class Order extends BaseClient
{
    const STATUS_CREATED = 'Created';
    const STATUS_ACKNOWLEDGED = 'Acknowledged';
    const STATUS_SHIPPED = 'Shipped';
    const STATUS_CANCELLED = 'Cancelled';

    const CANCEL_REASON = 'CANCEL_BY_SELLER';

    public $wmConsumerChannelType;

    /**
     * @param array $config
     * @param string $env
     * @throws \Exception
     */
    public function __construct(array $config = [], $env = self::ENV_PROD)
    {
        if ( ! isset($config['wmConsumerChannelType'])) {
            throw new \Exception('wmConsumerChannelType is required in configuration for Order APIs', 1467486702);
        }

        $this->wmConsumerChannelType = $config['wmConsumerChannelType'];

        // Apply some defaults.
        $config = array_merge_recursive($config, [
            'description_path' => __DIR__ . '/descriptions/order.php',
            'http_client_options' => [
                'defaults' => [
                    'headers' => [
                        'WM_CONSUMER.CHANNEL.TYPE' => $this->wmConsumerChannelType,
                    ],
                ],
            ],
        ]);

        // Create the client.
        parent::__construct(
            $config,
            $env
        );

    }

    public function __call($name, array $arguments)
    {
        /*
         * Overriding call to list() since I cannot define a method with the same name as a reserved keyword.
         */
        if ($name === 'list') {
            return $this->listAll($arguments[0]);
        }
        return parent::__call($name, $arguments);
    }

    /**
     * List released orders
     * @param array $config
     * @return array
     * @throws \Exception
     */
    public function listReleased(array $config = [])
    {
        try {
            return $this->privateListReleased($config);
        } catch (\Exception $e) {
            if ($e instanceof RequestException) {
                /*
                 * ListReleased and List return 404 error if no results are found, even for successful API calls,
                 * So if result status is 404, transform to 200 with empty results.
                 */
                /** @var ResponseInterface $response */
                $response = $e->getResponse();
                if (strval($response->getStatusCode()) === '404') {
                    return [
                        'statusCode' => 200,
                        'list' => [
                            'meta' => [
                                'totalCount' => 0
                            ]
                        ],
                        'elements' => []
                    ];
                }
                throw $e;
            } else {
                throw $e;
            }
        }
    }

    /**
     * List all orders
     * @param array $config
     * @return array
     * @throws \Exception
     */
    public function listAll(array $config = [])
    {
        try {
            return $this->privateList($config);
        } catch (\Exception $e) {
            if ($e instanceof RequestException) {
                /*
                 * ListReleased and List return 404 error if no results are found, even for successful API calls,
                 * So if result status is 404, transform to 200 with empty results.
                 */
                /** @var ResponseInterface $response */
                $response = $e->getResponse();
                if (strval($response->getStatusCode()) === '404') {
                    return [
                        'statusCode' => 200,
                        'list' => [
                            'meta' => [
                                'totalCount' => 0
                            ]
                        ],
                        'elements' => []
                    ];
                }
                throw $e;
            } else {
                throw $e;
            }
        }
    }


    /**
     * Cancel an order
     * @param string $purchaseOrderId
     * @param array $order
     * @return array
     * @throws \Exception
     */
    public function cancel($purchaseOrderId, $order)
    {
        if(!is_numeric($purchaseOrderId)){
            throw new \Exception("purchaseOrderId must be numeric",1448480746);
        }

        $schema = [
            '/orderCancellation' => [
                'namespace' => 'ns3',
                'childNamespace' => 'ns3',
            ],
            '/orderCancellation/orderLines' => [
                'sendItemsAs' => 'orderLine',
            ],
            '/orderCancellation/orderLines/orderLine/orderLineStatuses' => [
                'sendItemsAs' => 'orderLineStatus',
            ],
            '@namespaces' => [
                'ns3' => 'http://walmart.com/mp/v3/orders'
            ],
        ];

        $a2x = new A2X($order, $schema);
        $xml = $a2x->asXml();
        
        return $this->cancelOrder([
            'purchaseOrderId' => $purchaseOrderId,
            'order' => $xml,
        ]);
    }

    /**
     * Ship an order
     * @param string $purchaseOrderId
     * @param array $order
     * @return array
     * @throws \Exception
     */
    public function ship($purchaseOrderId, $order)
    {
        if(!is_numeric($purchaseOrderId)){
            throw new \Exception("purchaseOrderId must be numeric",1448480750);
        }

        $schema = [
            '/orderShipment' => [
                'namespace' => 'ns3',
                'childNamespace' => 'ns3',
            ],
            '/orderShipment/orderLines' => [
                'sendItemsAs' => 'orderLine',
            ],
            '/orderShipment/orderLines/orderLine/orderLineStatuses' => [
                'sendItemsAs' => 'orderLineStatus',
            ],
            '@namespaces' => [
                'ns3' => 'http://walmart.com/mp/v3/orders'
            ],
        ];

        $a2x = new A2X($order, $schema);
        $xml = $a2x->asXml();

        return $this->shipOrder([
            'purchaseOrderId' => $purchaseOrderId,
            'order' => $xml,
        ]);
    }

    /**
     * Refund an order
     * @param string $purchaseOrderId
     * @param array $order
     * @return array
     * @throws \Exception
     */
    public function refund($purchaseOrderId, $order)
    {
        if(!is_numeric($purchaseOrderId)){
            throw new \Exception("purchaseOrderId must be numeric",1448480783);
        }

        $schema = [
            '/orderRefund' => [
                'namespace' => 'ns3',
                'childNamespace' => 'ns3',
            ],
            '/orderRefund/orderLines' => [
                'sendItemsAs' => 'orderLine',
            ],
            '/orderRefund/orderLines/orderLine/refunds' => [
                'sendItemsAs' => 'refund',
            ],
            '/orderRefund/orderLines/orderLine/refunds/refund/refundCharges' => [
                'sendItemsAs' => 'refundCharge',
            ],
            '@namespaces' => [
                'ns3' => 'http://walmart.com/mp/v3/orders'
            ],
        ];

        $a2x = new A2X($order, $schema);
        $xml = $a2x->asXml();

        return $this->refundOrder([
            'purchaseOrderId' => $purchaseOrderId,
            'order' => $xml,
        ]);
    }
}