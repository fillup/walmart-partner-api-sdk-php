# Items
The item is the basic building block for all of your operations on 
Walmart. An item includes the product you are trying to sell as well as 
the offer prices for this product across different Walmart properties.

Items have a fairly complex model and it is recommended that you read 
through the overview and item object documentation linked to below. 
You'll also likely want to reference the XSD schema for an Item to 
ensure you use all appropriate properties of an item.

Official API Documentation: https://developer.walmartapis.com/#overview

## List Items
```php
<?php
use Walmart\Item;

$client = new Item([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

$items = $client->list([
    'sku' => '123', // optional
    'limit' => 20, // optional, default is 20
    'offset' => 0, //optional, default is 0
]);
```

## Get a single Item
```php
<?php
use Walmart\Item;

$client = new Item([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

$item = $client->get([
    'sku' => '123', // required
]);
```

## Retire an Item
```php
<?php
use Walmart\Item;

$client = new Item([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

$item = $client->retire([
    'sku' => '123', // required
]);
```

## Bulk create/update Items
This API creates an Item Feed

```php
<?php
use Walmart\Item;

$client = new Item([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

$feed = $client->bulk([
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
               'sku' => 'NO11140_123123',
               'Product' => [
                   'productName' => 'Fancy Rug',
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
```