# Walmart Partner API PHP SDK Documentation
This page contains documentation that is common across all resource 
types. For specific documention about one resource type or another 
see their specific pages:

 - [Feeds](feed.md)
 - [Inventory](inventory.md)
 - [Items](item.md)
 - [Order](order.md)
 - [Price](price.md)

## Authentication
Authentication with the Walmart Partner APIs requires a Consumer ID 
and Private Key. Short lived signatures are calculated using these 
values and sent along in the headers with each request.

The values for Consumer ID and Private Key are passed into the 
constructor of each resource type object on instantiation. For example:

```php
<?php
use Walmart\Item;

$order = new Item([
    'consumerId' => getenv('CONSUMER_ID'),
    'privateKey' => getenv('PRIVATE_KEY'),
]);
```
    
In the example above it is assumed the Consumer ID and Private Key are 
available as environment variables, but you can store them any way you 
prefer so long as it is secure. The combination of these values is the 
same as a username and password so guard them carefully.
 
Internally this SDK uses the ```fillup/walmart-auth-signature-php``` 
library to do the signature calculation. If you prefer to write your 
own API calls to the Partner APIs rather than use this SDK you may 
still want to use the signature library to handle that piece for you 
as it is fairly complicated. 

## Environments
There are both Staging and Production environments for the Partner API. 
You can control which environment you are developing against by passing 
it as the second parameter to a resource constructor. For Staging, use 
```ResourceType::ENV_STAGE``` and for production use 
```ResourceType::ENV_PROD```. For ```ResourceType``` replace with the 
resource you are working with. 

The default environment is production, so you only need to specify which 
environment to use when staging is desired.

Example:

```php
<?php
use Walmart\Item;

$item = new Item(
    [
        'consumerId' => getenv('CONSUMER_ID'),
        'privateKey' => getenv('PRIVATE_KEY'),
    ],
    Item::ENV_STAGE
);
```

## Mock Environment
For development and testing purposes this SDK also comes with a mock 
environment that allows you to define the responses for specific API 
calls. This can be helpful for testing transactional functions like 
shipping and refunding orders. It is also the mode that should be used 
for any of your own unit tests to prevent making calls to the 
Partner APIs. 

To use the mock environment simply specify it when instantiating the 
object:

```php
<?php
use Walmart\Item;

$item = new Item(
    [
        'consumerId' => getenv('CONSUMER_ID'),
        'privateKey' => getenv('PRIVATE_KEY'),
    ],
    Item::ENV_MOCK
);
```

The mock environment works by storing the responses in files located 
under ```src/mock/```. When a request is made in mock mode, middleware 
is used to identify which resource the request is for, such as 
```price``` or ```item```, and then looks for an array index in the 
file for the request method plus the requested path. For example when 
retrieving a list of items the index might be 
```GET /v2/items?limit=5```. Each mock is an array with keys for 
```status```, ```headers```, and ```body``` which are used to create 
the mock response. 

The unit tests in ```tests/``` use the mocks which you can reference 
for more examples. 

## Resource Schemas
This SDK allows you to interact with Partner APIs without having to 
fuss with XML as is expected by the API. The structure for resources in 
this SDK follows that of the XML schemas though and it is recommended 
that you reference the latest schema files for complete schema 
information. 

The latest schema files can be downloaded from 
https://developer.walmartapis.com/.

## Response format
This SDK will convert the XML responses from the API into normal PHP 
arrays. For example, below is the XML returned from the API followed 
by the array representation of the same. This example is for getting 
a single Order.

```xml
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<ns3:order xmlns:ns2="http://walmart.com/mp/orders" xmlns:ns3="http://walmart.com/mp/v3/orders" xmlns:ns4="http://walmart.com/">
    <ns3:purchaseOrderId>2575693098967</ns3:purchaseOrderId>
    <ns3:customerOrderId>4021603941547</ns3:customerOrderId>
    <ns3:customerEmailId>mgr@walmartlabs.com</ns3:customerEmailId>
    <ns3:orderDate>2016-05-11T23:16:10.000Z</ns3:orderDate>
    <ns3:shippingInfo>
        <ns3:phone>6502248603</ns3:phone>
        <ns3:estimatedDeliveryDate>2016-05-20T17:00:00.000Z</ns3:estimatedDeliveryDate>
        <ns3:estimatedShipDate>2016-05-16T17:00:00.000Z</ns3:estimatedShipDate>
        <ns3:methodCode>Standard</ns3:methodCode>
        <ns3:postalAddress>
            <ns3:name>Madhukara PGOMS</ns3:name>
            <ns3:address1>860 W Cal Ave</ns3:address1>
            <ns3:address2>Seat # 860C.2.176</ns3:address2>
            <ns3:city>Sunnyvale</ns3:city>
            <ns3:state>CA</ns3:state>
            <ns3:postalCode>94086</ns3:postalCode>
            <ns3:country>USA</ns3:country>
            <ns3:addressType>RESIDENTIAL</ns3:addressType>
        </ns3:postalAddress>
    </ns3:shippingInfo>
    <ns3:orderLines>
        <ns3:orderLine>
            <ns3:lineNumber>1</ns3:lineNumber>
            <ns3:item>
                <ns3:productName>Garmin Refurbished nuvi 2595LMT 5 GPS w Lifetime Maps and Traffic</ns3:productName>
                <ns3:sku>GRMN100201</ns3:sku>
            </ns3:item>
            <ns3:charges>
                <ns3:charge>
                    <ns3:chargeType>PRODUCT</ns3:chargeType>
                    <ns3:chargeName>ItemPrice</ns3:chargeName>
                    <ns3:chargeAmount>
                        <ns3:currency>USD</ns3:currency>
                        <ns3:amount>124.98</ns3:amount>
                    </ns3:chargeAmount>
                    <ns3:tax>
                        <ns3:taxName>Tax1</ns3:taxName>
                        <ns3:taxAmount>
                            <ns3:currency>USD</ns3:currency>
                            <ns3:amount>10.94</ns3:amount>
                        </ns3:taxAmount>
                    </ns3:tax>
                </ns3:charge>
            </ns3:charges>
            <ns3:orderLineQuantity>
                <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                <ns3:amount>1</ns3:amount>
            </ns3:orderLineQuantity>
            <ns3:statusDate>2016-05-11T23:43:50.000Z</ns3:statusDate>
            <ns3:orderLineStatuses>
                <ns3:orderLineStatus>
                    <ns3:status>Created</ns3:status>
                    <ns3:statusQuantity>
                        <ns3:unitOfMeasurement>EACH</ns3:unitOfMeasurement>
                        <ns3:amount>1</ns3:amount>
                    </ns3:statusQuantity>
                </ns3:orderLineStatus>
            </ns3:orderLineStatuses>
        </ns3:orderLine>
    </ns3:orderLines>
</ns3:order>
```

```php
[
    'statusCode' => 200,
    'purchaseOrderId' => '2575693098967',
    'customerOrderId' => '4021603941547',
    'customerEmailId' => 'mgr@walmartlabs.com',
    'orderDate' => '2016-05-11T23:16:10.000Z',
    'shippingInfo' => [
        'phone' => '6502248603',
        'estimatedDeliveryDate' => '2016-05-20T17:00:00.000Z',
        'estimatedShipDate' => '2016-05-16T17:00:00.000Z',
        'methodCode' => 'Standard',
        'postalAddress' => [
            'name' => 'Madhukara PGOMS',
            'address1' => '860 W Cal Ave',
            'address2' => 'Seat # 860C.2.176',
            'city' => 'Sunnyvale',
            'state' => 'CA',
            'postalCode' => '94086',
            'country' => 'USA',
            'addressType' => 'RESIDENTIAL',
        ]
    ],
    'orderLines' => [
        'orderLine' => [
            'lineNumber' => 1,
            'item' => [
                'productName' => 'Garmin Refurbished nuvi 2595LMT 5 GPS w Lifetime Maps and Traffic',
                'sku' => 'GRMN100201',
            ],
            'charges' => [
                'charge' => [
                    'chargeType' => 'PRODUCT',
                    'chargeName' => 'ItemPrice',
                    'chargeAmount' => [
                        'currency' => 'USD',
                        'amount' => '124.98',
                    ],
                    'tax' => [
                        'taxName' => 'Tax1',
                        'taxAmount' => [
                            'currency' => 'USD',
                            'amount' => '10.94',
                        ]
                    ]
                ]
            ],
            'orderLineQuantity' => [
                'unitOfMeasurement' => 'EACH',
                'amount' => 1,
            ],
            'statusDate' => '2016-05-11T23:43:50.000Z',
            'orderLineStatuses' => [
                'orderLineStatus' => [
                    'status' => 'Created',
                    'statusQuantity' => [
                        'unitOfMeasurement' => 'EACH',
                        'amount' => 1
                    ]
                ]
            ]
        ]
    ]
]
```