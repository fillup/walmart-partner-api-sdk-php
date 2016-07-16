# Orders
Walmart orders go through a specific life cycle of being Created, 
then Acknowledged, then either Shipped or Cancelled. A diagram is 
available at the link below for more details.

Official API Documentation: 
https://developer.walmartapis.com/#overview35

This SDK uses version 3 of the Order API which requires the additional 
identifier ```WM_CONSUMER.CHANNEL.TYPE``` to be sent as a header. You 
can provide this to the constructor in the configuration array with key 
```wmConsumerChannelType```. You should get this value from your 
Walmart Integration Engineer.

## List Orders
List all orders according to filters

```php
<?php
use Walmart\Order;

$client = new Order([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
    'wmConsumerChannelType' => getenv('WM_CONSUMER_CHANNEL_TYPE'),
]);

$orders = $client->list([
    'sku' => 'ABC123', // optional
    'customerOrderId' => '123', // optional
    'purchaseOrderId' => '123', // optional
    'status' => 'Shipped', // optional
    'createdStartDate' => '2016-06-01', // optional
    'createdEndDate' => '2016-06-15', // optional
    'fromExpectedShipDate' => '2016-06-01', // optional
    'toExpectedShipDate' => '2016-06-15', // optional
    'limit' => 10, // optional, default 10
    'nextCursor' => '', // optional, value comes from previous call, used for pagination
]);
```

## List Released Orders
Released orders are orders that have a status of Created and are ready 
for fulfillment.

```php
<?php
use Walmart\Order;

$client = new Order([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
    'wmConsumerChannelType' => getenv('WM_CONSUMER_CHANNEL_TYPE'),
]);

$orders = $client->listReleased([
    'createdStartDate' => '2016-06-01', // optional
    'limit' => 10, // optional, default 10
    'nextCursor' => '', // optional, value comes from previous call, used for pagination
]);
```

## Get a single Order

```php
<?php
use Walmart\Order;

$client = new Order([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
    'wmConsumerChannelType' => getenv('WM_CONSUMER_CHANNEL_TYPE'),
]);

$order = $client->get([
    'purchaseOrderId' => '22020202020', // required
]);
```

## Acknowledge an Order

```php
<?php
use Walmart\Order;

$client = new Order([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
    'wmConsumerChannelType' => getenv('WM_CONSUMER_CHANNEL_TYPE'),
]);

$order = $client->acknowledge([
    'purchaseOrderId' => '22020202020', // required
]);
```

## Cancel an Order

```php
<?php
use Walmart\Order;

$client = new Order([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
    'wmConsumerChannelType' => getenv('WM_CONSUMER_CHANNEL_TYPE'),
]);

$order = $client->cancel(
    '22020202020', 
    [
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
    ]
);
```

## Ship an Order

```php
<?php
use Walmart\Order;

$client = new Order([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
    'wmConsumerChannelType' => getenv('WM_CONSUMER_CHANNEL_TYPE'),
]);

$order = $client->ship(
    '22020202020', 
    [
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
    ]
);
```

## Refund an Order

```php
<?php
use Walmart\Order;

$client = new Order([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
    'wmConsumerChannelType' => getenv('WM_CONSUMER_CHANNEL_TYPE'),
]);

$order = $client->refund(
    '22020202020', 
    [
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
    ]
);
```