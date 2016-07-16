# Feeds
Feeds are constructed to handle bulk functions in the Partner API. 
There are three types of feed that Partner API supports:

 - Item
 - Inventory
 - Price
 
Implementation of these specific resource feeds are supported in their 
respective resource objects.

## General Feed APIs

### List Feeds
Get all feed statuses

```php
<?php
use Walmart\Feed;

$client = new Feed([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

$feeds = $client->list([
    'feedId' => '123', // optional
    'limit' => 50, // optional, default 50
    'offset' => 0, // optional, default 0
]);
```

### Get Feed
Get a single Feed

It is recommended that you not use this call with includeDetails set to 
true, as discrepancies may appear between the header and the item 
details (the item details may be incorrect). Instead, use a call to 
```getFeedItem()```.

```php
<?php
use Walmart\Feed;

$client = new Feed([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

$feed = $client->get([
    'feedId' => '123', // required
    'includeDetails' => false, // optional, default false
    'limit' => 50, // optional, default 50
    'offset' => 0, // optional, default 0
]);
```


### Get FeedItem
Get a single Feed Item

```php
<?php
use Walmart\Feed;

$client = new Feed([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);

$feed = $client->getFeedItem([
    'feedId' => '123', // required
    'includeDetails' => false, // optional, default false
    'limit' => 50, // optional, default 50
    'offset' => 0, // optional, default 0
]);
```
