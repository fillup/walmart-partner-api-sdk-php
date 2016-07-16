<?php
namespace WalmartTests;

include __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Command\Exception\CommandClientException;
use Walmart\Feed;

class FeedTest extends \PHPUnit_Framework_Testcase
{

    public $config = [];
    public $proxy = null;
    //public $proxy = 'tcp://localhost:8888';
    public $verifySsl = false;
    public $env = Feed::ENV_MOCK;
    public $debugOutput = false;

    public function __construct()
    {
        $this->config = [
            'max_retries' => 0,
            'http_client_options' => [
                'defaults' => [
                    'proxy' => $this->proxy,
                    'verify' => $this->verifySsl,
                ]
            ],
            'consumerId' => getenv('CONSUMER_ID'),
            'privateKey' => getenv('PRIVATE_KEY')
        ];

        parent::__construct();
    }

    public function testList()
    {
        $client = $this->getClient();
        try {
            $feed = $client->list([]);
            $this->debug($feed);

            $this->assertEquals(200, $feed['statusCode']);
            $this->assertTrue(is_numeric($feed['totalResults']));
        } catch (CommandClientException $e) {
            $error = $e->getResponse()->getHeader('X-Error');
            $this->fail($e->getMessage() . 'Error: ' . $error);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testGet()
    {
        $client = $this->getClient();
        try {
            $feed = $client->get([
                'feedId' => '1898c657-085c-4761-95fa-4ae515025e87',
                'includeDetails' => 'true',
            ]);
            $this->debug($feed);

            $this->assertEquals(200, $feed['statusCode']);
            $this->assertEquals('PROCESSED', $feed['feedStatus']);

        } catch (CommandClientException $e) {
            $error = $e->getResponse()->getHeader('X-Error');
            $this->fail($e->getMessage() . 'Error: ' . $error);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testGetFeedItem()
    {
        $client = $this->getClient();
        try {
            $feed = $client->getFeedItem([
                'feedId' => '09a3f1b2-3852-4b87-b7e4-2715b3d7a52e',
                'includeDetails' => 'true',
                'limit' => 3,
            ]);
            $this->debug($feed);

            $this->assertEquals(200, $feed['statusCode']);
            $this->assertEquals('INPROGRESS', $feed['meta']['feedStatus']);
            $this->assertEquals(3, count($feed['elements']['itemDetails']['itemIngestionStatus']));

        } catch (CommandClientException $e) {
            $error = $e->getResponse()->getHeader('X-Error');
            $this->fail($e->getMessage() . 'Error: ' . $error);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    private function getClient($extraConfig = [])
    {
        $config = array_merge_recursive($this->config, $extraConfig);
        return new Feed($config, $this->env);
    }

    private function debug($output)
    {
        if ($this->debugOutput) {
            fwrite(STDERR, print_r($output, true));
        }
    }
}