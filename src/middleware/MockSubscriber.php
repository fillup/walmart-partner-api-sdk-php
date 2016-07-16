<?php
namespace Walmart\middleware;

use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use Walmart\mock\MockResponse;
use Walmart\Utils;

class MockSubscriber implements SubscriberInterface
{
    public function getEvents()
    {
        return [
            // need to attach before request, but after AuthSubscriber
            'before'   => ['interceptResponse', RequestEvents::PREPARE_REQUEST - 1],
        ];
    }

    public function interceptResponse(BeforeEvent $event, $name)
    {
        $response = MockResponse::getResponse($event->getRequest());
        $event->intercept($response);
        $event->stopPropagation();
    }
}