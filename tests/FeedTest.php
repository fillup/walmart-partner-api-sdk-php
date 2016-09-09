<?php
namespace WalmartTests;

include __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Command\Exception\CommandClientException;
use Sil\PhpEnv\Env;
use Walmart\Feed;

class FeedTest extends \PHPUnit_Framework_TestCase
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
            'consumerId' => Env::get('CONSUMER_ID', 'hw30cqp3-35fi-1bi0-3312-hw9fgm30d2p4'),
            'privateKey' => Env::get('PRIVATE_KEY', 'MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAKzXEfCYdnBNkKAwVbCpg/tR40WixoZtiuEviSEi4+LdnYAAPy57Qw6+9eqJGTh9iCB2wP/I8lWh5TZ49Hq/chjTCPeJiOqi6bvX1xzyBlSq2ElSY3iEVKeVoQG/5f9MYQLEj5/vfTWSNASsMwnNeBbbHcV1S1aY9tOsXCzRuxapAgMBAAECgYBjkM1j1OA9l2Ed9loWl8BQ8X5D6h4E6Gudhx2uugOe9904FGxRIW6iuvy869dchGv7j41ki+SV0dpRw+HKKCjYE6STKpe0YwIm/tml54aNDQ0vQvF8JWILca1a7v3Go6chf3Ib6JPs6KVsUuNo+Yd+jKR9GAKgnDeXS6NZlTBUAQJBANex815VAySumJ/n8xR+h/dZ2V5qGj6wu3Gsdw6eNYKQn3I8AGQw8N4yzDUoFnrQxqDmP3LOyr3/zgOMNTdszIECQQDNIxiZOVl3/Sjyxy9WHMk5qNfSf5iODynv1OlTG+eWao0Wj/NdfLb4pwxRsf4XZFZ1SQNkbNne7+tEO8FTG1YpAkAwNMY2g/ty3E6iFl3ea7UJlBwfnMkGz8rkye3F55f/+UCZcE2KFuIOVv4Kt03m3vg1h6AQkaUAN8acRl6yZ2+BAkEAke2eiRmYANiR8asqjGqr5x2qcm8ceiplXdwrI1kddQ5VUbCTonSewOIszEz/gWp6arLG/ADHOGWaCo8rptAyiQJACXd1ddXUAKs6x3l752tSH8dOde8nDBgF86NGvgUnBiAPPTmJHuhWrmOZmNaB68PsltEiiFwWByGFV+ld9VKmKg=='),
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