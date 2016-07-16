# Prices

Official API Documentation: https://developer.walmartapis.com/#prices

## Update a single Item Price

```php
<?php
use Walmart\Price;

$client = new Price([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

$price = $client->update([
    'sku' => 'ABC123', // required
    'currency' => 'USD', // required
    'price' => '14.99', // required
]);
```

## Bulk update Item Prices

```php
<?php
use Walmart\Price;

$client = new Price([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

$price = $client->bulk([
    'PriceFeed' => [
        'PriceHeader' => [
            'version' => '1.5',
        ],
        'Price' => [
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
    ],
]);
```