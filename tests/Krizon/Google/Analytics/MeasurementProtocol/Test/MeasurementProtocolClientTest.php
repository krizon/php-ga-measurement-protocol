<?php

/*
 * This file is part of the php-ga-measurement-protocol package.
 *
 * (c) Kristian Zondervan <kristian.zondervan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Krizon\Google\Analytics\MeasurementProtocol\Test;

use Guzzle\Http\Message\Response;
use Guzzle\Plugin\History\HistoryPlugin;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Service\Exception\ValidationException;
use Guzzle\Tests\GuzzleTestCase;
use Krizon\Google\Analytics\MeasurementProtocol\MeasurementProtocolClient;

class MeasurementProtocolClientTest extends GuzzleTestCase
{
    public function testFactoryInitializesClient()
    {
        $client = MeasurementProtocolClient::factory();
        $this->assertInstanceOf('Krizon\Google\Analytics\MeasurementProtocol\MeasurementProtocolClient', $client);
        $this->assertEquals('http://www.google-analytics.com', $client->getBaseUrl());
        $this->assertFalse($client->getConfig('ssl'));
    }

    public function testFactoryInitializesClientWithSsl()
    {
        $client = MeasurementProtocolClient::factory(array(
            'ssl' => true
        ));
        $this->assertEquals('https://ssl.google-analytics.com', $client->getBaseUrl());
        $this->assertTrue($client->getConfig('ssl'));
    }

    public function testAbstractCollect()
    {
        $response = $this->getResponse('abstract.collect', array(
            'tid' => $this->getTrackingId(),
            'cid' => $this->getCustomerId(),
        ), true);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testAbstractCollectRequiredFields()
    {
        try {
            $this->getResponse('abstract.collect', array(), true);
        } catch (ValidationException $e) {
            $this->assertInstanceOf('Guzzle\Service\Exception\ValidationException', $e);
            $this->assertSame('Validation errors: [tid] is required
[cid] is required', $e->getMessage());
        }
    }

    public function testPageview($mockResponse = true)
    {
        $response = $this->getResponse('pageview', array(
            'tid' => $this->getTrackingId(),
            'cid' => $this->getCustomerId(),
            't' => 'pageview',
            'dh' => 'domain.do',
            'dp' => '/php-ga-measurement-protocol/phpunit-test',
            'dt' => 'PHP GA Measurement Protocol'
        ), $mockResponse);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group internet
     */
    public function testPageviewLive()
    {
        $this->testPageview(false);
    }

    public function testEvent($mockResponse = true)
    {
        $response = $this->getResponse('event', array(
            'tid' => $this->getTrackingId(),
            'cid' => $this->getCustomerId(),
            't' => 'event',
            'ec' => 'Event category',
            'ea' => 'Event action',
            'el' => 'Event label',
            'ev' => 300
        ), $mockResponse);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group internet
     */
    public function testEventLive()
    {
        $this->testEvent(false);
    }

    protected function getResponse($operation, array $parameters, $mockResponse = true)
    {
        /** @var MeasurementProtocolClient $client */
        $client = $this->getServiceBuilder()->get('ga_measurement_protocol');

        if (true === $mockResponse) {
            $mock = new MockPlugin(array(new Response('200')), true);
            $client->addSubscriber($mock);
        }

        $history = new HistoryPlugin();
        $history->setLimit(3);
        $client->addSubscriber($history);

        $return = call_user_func(array($client, $operation), $parameters);

        return $return;
    }

    protected function getTrackingId()
    {
        return getenv('tracking_id');
    }

    protected function getCustomerId()
    {
        return '9dc22b58-e588-4a93-b5e6-89431cd9ef14';
    }
}
