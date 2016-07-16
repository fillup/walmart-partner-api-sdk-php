<?php return [
    'baseUrl' => 'https://marketplace.walmartapis.com',
    'apiVersion' => 'v2',
    'operations' => [
        'Update' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/prices',
            'responseModel' => 'Result',
            'data' => [
                'xmlRoot' => [
                    'name' => 'Price',
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
                'sku' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query'
                ],
                'currency' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query'
                ],
                'price' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query'
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
                    'default' => 'price',
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
        ]
    ]
];
