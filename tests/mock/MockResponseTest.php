<?php
namespace WalmartTests\mock;

use Walmart\mock\MockResponse;

class MockResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testGetResourceType()
    {
        $urls = [
            [
                'url' => 'https://marketplace.walmartapis.com/v2/items/{SKU}',
                'type' => 'items',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/items',
                'type' => 'items',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/feeds?feedType=item',
                'type' => 'feeds',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/prices?sku={SKU}&currency={currency}&price={price}',
                'type' => 'prices',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v3/price',
                'type' => 'prices',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/orders/released?limit={limit}&createdStartDate={createdStartDate}',
                'type' => 'orders',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/orders?sku={sku}&customerOrderId={customerOrderId}&purchaseOrderId={purchaseOrderId}&status={status}&createdStartDate={createdStartDate}&createdEndDate={createdEndDate}&fromExpectedShipDate={fromExpectedShipDate}&toExpectedShipDate={toExpectedShipDate}&limit={limit}&offset={offset}',
                'type' => 'orders',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/inventory?sku={SKU}',
                'type' => 'inventory',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/getReport?type={type}',
                'type' => 'report',
            ],
        ];

        foreach ($urls as $url) {
            $type = MockResponse::getResourceTypeFromUrl($url['url']);
            $this->assertEquals($url['type'], $type);
        }
    }

    public function testGetPath()
    {
        $urls = [
            [
                'url' => 'https://marketplace.walmartapis.com/v2/items/{SKU}',
                'path' => '/v2/items/{SKU}',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/items',
                'path' => '/v2/items',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/feeds?feedType=item',
                'path' => '/v2/feeds?feedType=item',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/prices?sku={SKU}&currency={currency}&price={price}',
                'path' => '/v2/prices?sku={SKU}&currency={currency}&price={price}',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v3/price',
                'path' => '/v3/price',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/orders/released?limit={limit}&createdStartDate={createdStartDate}',
                'path' => '/v2/orders/released?limit={limit}&createdStartDate={createdStartDate}',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/orders?sku={sku}&customerOrderId={customerOrderId}&purchaseOrderId={purchaseOrderId}&status={status}&createdStartDate={createdStartDate}&createdEndDate={createdEndDate}&fromExpectedShipDate={fromExpectedShipDate}&toExpectedShipDate={toExpectedShipDate}&limit={limit}&offset={offset}',
                'path' => '/v2/orders?sku={sku}&customerOrderId={customerOrderId}&purchaseOrderId={purchaseOrderId}&status={status}&createdStartDate={createdStartDate}&createdEndDate={createdEndDate}&fromExpectedShipDate={fromExpectedShipDate}&toExpectedShipDate={toExpectedShipDate}&limit={limit}&offset={offset}',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/inventory?sku={SKU}',
                'path' => '/v2/inventory?sku={SKU}',
            ],
            [
                'url' => 'https://marketplace.walmartapis.com/v2/getReport?type={type}',
                'path' => '/v2/getReport?type={type}',
            ],
        ];

        foreach ($urls as $url) {
            $path = MockResponse::getPath($url['url']);
            $this->assertEquals($url['path'], $path);
        }
    }
}