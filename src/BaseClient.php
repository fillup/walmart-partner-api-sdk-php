<?php
namespace Walmart;

use Walmart\middleware\AuthSubscriber;
use Walmart\middleware\MockSubscriber;
use Walmart\middleware\XmlNamespaceSubscriber;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;

/**
 * Partial Walmart API client implemented with Guzzle.
 * BaseClient class to implement common features
 */
class BaseClient extends GuzzleClient
{
    const ENV_PROD = 'prod';
    const ENV_STAGE = 'stage';
    const ENV_MOCK = 'mock';

    const BASE_URL_PROD = 'https://marketplace.walmartapis.com';
    const BASE_URL_STAGE = 'https://marketplace.stg.walmartapis.com/gmp-gateway-service-app';

    public $env;

    /**
     * @param array $config
     * @param string $env
     * @throws \Exception
     */
    public function __construct(array $config = [], $env = self::ENV_PROD)
    {
        /*
         * Make sure ENV is valid
         */
        if ( ! in_array($env, [self::ENV_PROD, self::ENV_STAGE, self::ENV_MOCK])) {
            throw new \Exception('Invalid environment', 1462566788);
        }

        /*
         * Check that consumerId and privateKey are set
         */
        if ( ! isset($config['consumerId']) || ! isset($config['privateKey'])) {
            throw new \Exception('Configuration missing consumerId or privateKey', 1466965269);
        }

        // Set ENV
        $this->env = $env;

        // Apply some defaults.
        $config = array_merge_recursive($config, [
            'max_retries' => 3,
            'http_client_options' => [
                'defaults' => [
                    'auth' => [
                        $config['consumerId'],
                        $config['privateKey']
                    ]
                ],
            ],
        ]);

        // If an override base url is not provided, determine proper baseurl from env
        if ( ! isset($config['description_override']['baseUrl'])) {
            $config = array_merge_recursive($config , [
                'description_override' => [
                    'baseUrl' => $this->getEnvBaseUrl($env),
                ],
            ]);
        }

        // Create the client.
        parent::__construct(
            $this->getHttpClientFromConfig($config),
            $this->getDescriptionFromConfig($config),
            $config
        );

        // Ensure that ApiVersion is set.
        $this->setConfig(
            'defaults/ApiVersion',
            $this->getDescription()->getApiVersion()
        );

    }

    /**
     * Get baseUrl for given environment
     * @param string $env
     * @return null|string
     */
    public function getEnvBaseUrl($env)
    {
        switch ($env) {
            case self::ENV_PROD:
                return self::BASE_URL_PROD;
            case self::ENV_STAGE:
                return self::BASE_URL_STAGE;
            case self::ENV_MOCK:
                return null;
        }
    }

    private function getHttpClientFromConfig(array $config)
    {
        // If a client was provided, return it.
        if (isset($config['http_client'])) {
            return $config['http_client'];
        }

        // Create a Guzzle HttpClient.
        $clientOptions = isset($config['http_client_options'])
            ? $config['http_client_options']
            : [];
        $client = new HttpClient($clientOptions);

        /*
         * Attach subscriber for adding auth headers just before request
         */
        $client->getEmitter()->attach(new AuthSubscriber());

        /*
         * Attach subscriber for removing xml namespaces on response
         */
        $client->getEmitter()->attach(new XmlNamespaceSubscriber());

        /*
         * If mock env, attach MockSubscriber
         */
        if($this->env === self::ENV_MOCK) {
            $client->getEmitter()->attach(new MockSubscriber());
        }

        return $client;
    }

    private function getDescriptionFromConfig(array $config)
    {
        // If a description was provided, return it.
        if (isset($config['description'])) {
            return $config['description'];
        }

        // Load service description data.
        $data = is_readable($config['description_path'])
            ? include $config['description_path']
            : [];

        if ( ! is_array($data)) {
            throw new \Exception('Service description file must return an array', 1470529124);
        }

        // Override description from local config if set
        if(isset($config['description_override'])){
            $data = array_merge($data, $config['description_override']);
        }

        return new Description($data);
    }

}