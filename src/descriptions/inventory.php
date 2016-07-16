<?php return [
    'baseUrl' => 'https://marketplace.walmartapis.com',
    'apiVersion' => 'v2',
    'operations' => [
        'Get' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/inventory',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'sku' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],
        'UpdateInventory' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/inventory',
            'responseModel' => 'Result',
            'data' => [
                'xmlRoot' => [
                    'name' => 'inventory',
                ],
            ],
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'Content-type' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'header',
                    'default' => 'application/xml',
                ],
                'Accept' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'header',
                    'default' => 'application/xml',
                ],
                'sku' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'inventory' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'body',
                ],
            ],
        ],
        'BulkUpdate' => [
            'httpMethod' => 'POST',
            'uri' => '/{ApiVersion}/feeds',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'Content-type' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'header',
                    'default' => 'multipart/form-data',
                ],
                'Accept' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'header',
                    'default' => 'application/xml',
                ],
                'feedType' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                    'default' => 'inventory',
                ],
                'file' => [
                    'required' => true,
                    'type' => 'object',
                    'location' => 'postFile',
                ],
            ],
        ],
    ],
    'models' => [
        'Result' => [
            'type' => 'object',
            'properties' => [
                'statusCode' => ['location' => 'statusCode'],
            ],
            'additionalProperties' => [
                'location' => 'xml'
            ],
        ],
    ]

];