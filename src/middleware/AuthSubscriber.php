<?php
namespace Walmart\middleware;

use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use phpseclib\Crypt\Random;
use Walmart\Auth\Signature;
use Walmart\Utils;

class AuthSubscriber implements SubscriberInterface
{
    public function getEvents()
    {
        return [
            // need to attach before request
            'before'   => ['addAuthHeaders', RequestEvents::PREPARE_REQUEST],
        ];
    }

    public function addAuthHeaders(BeforeEvent $event)
    {
        /*
         * Get Consumer ID and Private Key from auth and then unset it
         */
        $auth = $event->getClient()->getDefaultOption('auth');
        if ($auth === null) {
            throw new \Exception('Http client is missing \'auth\' parameters', 1466965269);
        }
        $consumerId = $auth[0];
        $privateKey = $auth[1];
        $event->getClient()->setDefaultOption('auth', null);

        /*
         * Get Request URL, method, and timestamp to calculate signature
         */
        $requestUrl = $event->getRequest()->getUrl();

        //decode url back to normal to nextCursor issue. automatic url encoding
        $requestUrl = rawurldecode($requestUrl);
        $event->getRequest()->setUrl($requestUrl);

        $requestMethod = $event->getRequest()->getMethod();
        $timestamp = Utils::getMilliseconds();
        $signature = Signature::calculateSignature($consumerId, $privateKey, $requestUrl, $requestMethod, $timestamp);

        /*
         * Add required headers to request
         */
        $headers = [
            'WM_SVC.NAME' => 'Walmart Marketplace',
            'WM_QOS.CORRELATION_ID' => base64_encode(Random::string(16)),
            'WM_SEC.TIMESTAMP' => $timestamp,
            'WM_SEC.AUTH_SIGNATURE' => $signature,
            'WM_CONSUMER.ID' => $consumerId,
        ];
        $currentHeaders = $event->getRequest()->getHeaders();
        unset($currentHeaders['Authorization']);
        $updatedHeaders = array_merge($currentHeaders, $headers);
        $event->getRequest()->setHeaders($updatedHeaders);
    }

}
