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
use Guzzle\Plugin\Async\AsyncPlugin;
use Guzzle\Plugin\History\HistoryPlugin;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Service\Exception\ValidationException;
use Guzzle\Tests\GuzzleTestCase;
use Krizon\Google\Analytics\MeasurementProtocol\MeasurementProtocolClient;

class MeasurementProtocolClientTest extends GuzzleTestCase
{
    /**
     * @var null|HistoryPlugin
     */
    private $history = null;

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

    public function testFactoryInitializesClientWithAsync()
    {
        $client = MeasurementProtocolClient::factory(array(
            'async' => true
        ));
        $this->assertEquals('http://www.google-analytics.com', $client->getBaseUrl());
        // We try to check if the is asynch plugin is correctly registered in the listeners list
        $ed = $client-> getEventDispatcher()->getListeners();
        $classList = array_map(function($elt){return get_class($elt[0]);}, $ed['request.sent']);
        $this->assertContains(get_class(new AsyncPlugin()), $classList);
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

    public function testTransaction($mockResponse = true)
    {
        $response = $this->getResponse('event', array(
            'tid' => $this->getTrackingId(),
            'cid' => $this->getCustomerId(),
            'ti' => time(),
            'ta' => 'westernWear',
            'tr' => '50.00',
            'ts' => '32.00',
            'tt' => '12.00',
            'cu' => 'EUR'
        ), $mockResponse);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group internet
     */
    public function testTransactionLive()
    {
        $this->testTransaction(false);
    }

    public function testTransactionItem($mockResponse = true)
    {
        $response = $this->getResponse('event', array(
            'tid' => $this->getTrackingId(),
            'cid' => $this->getCustomerId(),
            'ti' => time(),
            'in' => 'sofa',
            'ip' => 300,
            'iq' => 2,
            'ic' => 'u3eqds43',
            'iv' => 'furniture',
            'cu' => 'EUR'
        ), $mockResponse);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group internet
     */
    public function testTransactionItemLive()
    {
        $this->testTransactionItem(false);
    }

    public function testSocial($mockResponse = true)
    {
        $response = $this->getResponse('social', array(
            'tid' => $this->getTrackingId(),
            'cid' => $this->getCustomerId(),
            'sa' => 'like',
            'sn' => 'facebook',
            'st' => '/home',
        ), $mockResponse);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group internet
     */
    public function testSocialLive()
    {
        $this->testSocial(false);
    }

    public function testException($mockResponse = true)
    {
        $response = $this->getResponse('exception', array(
            'tid' => $this->getTrackingId(),
            'cid' => $this->getCustomerId(),
            'exd' => 'IOException',
            'exf' => 1
        ), $mockResponse);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group internet
     */
    public function testExceptionLive()
    {
        $this->testException(false);
    }

    public function testTrackingIdAsDefault()
    {
        $this->getResponse('abstract.collect', array(
            'cid' => $this->getCustomerId(),
        ), true, MeasurementProtocolClient::factory(array('tid' => 'X2')));
        $this->assertEquals('X2', $this->history->getLastRequest()->getQuery()->get('tid'));

    }

    public function testTrackingIdAsParam()
    {
        $this->getResponse('abstract.collect', array(
            'tid' => 'X1',
            'cid' => $this->getCustomerId(),
        ), true);
        $this->assertEquals('X1', $this->history->getLastRequest()->getQuery()->get('tid'));
    }

    public function testTrackingIdAsParamWins()
    {
        $this->getResponse('abstract.collect', array(
            'tid' => 'X3',
            'cid' => $this->getCustomerId(),
        ), true,  MeasurementProtocolClient::factory(array('tid' => 'X4')));
        $this->assertEquals('X3', $this->history->getLastRequest()->getQuery()->get('tid'));
    }

    /**
     * @group internet
     */
    public function testAsyncRequestLive()
    {
        $client = MeasurementProtocolClient::factory(array(
            'async' => true
        ));
        $response = $this->getResponse('pageview', array(
            'tid' => $this->getTrackingId(),
            'cid' => $this->getCustomerId(),
            't' => 'pageview',
            'dh' => 'domain.do',
            'dp' => '/php-ga-measurement-protocol/phpunit-test/async',
            'dt' => 'PHP GA Measurement Protocol Async'
        ), false, $client);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @param $operation
     * @param array $parameters
     * @param bool $mockResponse
     * @return Response
     */
    protected function getResponse($operation, array $parameters, $mockResponse = true, MeasurementProtocolClient $client = null)
    {
        if (null === $client) {
            $client = $this->getServiceBuilder()->get('ga_measurement_protocol');
        }

        if (true === $mockResponse) {
            $mock = new MockPlugin(array(new Response('200')), true);
            $client->addSubscriber($mock);
        }

        $history = new HistoryPlugin();
        $history->setLimit(3);
        $client->addSubscriber($history);
        $this->history = $history;

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
