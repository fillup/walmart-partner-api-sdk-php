# Inventory
Maintaining up-to-date inventory for your items on Walmart.com ensures 
a great experience for your customers and greater sales opportunities 
for you.

Official API Documentation: https://developer.walmartapis.com/#inventory

## Get Inventory for a single Item

```php
<?php
use Walmart\Inventory;

$client = new Inventory([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

$inventory = $client->get([
    'sku' => '123', // required
]);
```

## Update Inventory for a single Item

```php
<?php
use Walmart\Inventory;

$client = new Inventory([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

$inventory = $client->update([
    'inventory' => [
        'sku' => 'NO11140_7022363',
        'quantity' => [
            'unit' => 'EACH',
            'amount' => 5,
        ],
        'fulfillmentLagTime' => 3,
    ],
]);
```

## Bulk Update Inventory for multiple Items
This API creates an Inventory Feed

```php
<?php
use Walmart\Inventory;

$client = new Inventory([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

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
```