<?php
namespace Walmart;

/**
 * Partial Walmart API client implemented with Guzzle.
 *
 * @method array list(array $config = [])
 * @method array get(array $config = [])
 * @method array getFeedItem(array $config = [])
 */
class Feed extends BaseClient
{
    /**
     * @param array $config
     * @param string $env
     */
    public function __construct(array $config = [], $env = self::ENV_PROD)
    {
        // Apply some defaults.
        $config += [
            'description_path' => __DIR__ . '/descriptions/feed.php',
        ];

        // Create the client.
        parent::__construct(
            $config,
            $env
        );

    }
}