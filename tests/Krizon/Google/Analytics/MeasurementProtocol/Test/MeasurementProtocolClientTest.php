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

use GuzzleHttp\Message\Response;
use GuzzleHttp\Subscriber\History;
use GuzzleHttp\Subscriber\Mock;
use Krizon\Google\Analytics\MeasurementProtocol\MeasurementProtocolClient;

class MeasurementProtocolClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var null|History
     */
    private $history = null;

    public function testFactoryInitializesClient()
    {
        $client = MeasurementProtocolClient::factory();
        $this->assertInstanceOf('Krizon\Google\Analytics\MeasurementProtocol\MeasurementProtocolClient', $client);
        $this->assertEquals('http://www.google-analytics.com', $client->getDescription()->getBaseUrl());
        $this->assertFalse($client->getConfig('ssl'));
    }

    public function testFactoryInitializesClientWithSsl()
    {
        $client = MeasurementProtocolClient::factory(array(
            'ssl' => true
        ));
        $this->assertEquals('https://ssl.google-analytics.com', $client->getDescription()->getBaseUrl());
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
        $this->setExpectedException('GuzzleHttp\Command\Exception\CommandException', 'Validation errors: [tid] is required
[cid] is required');
        $this->getResponse('abstract.collect', array(), true);
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

    public function testPageLoadTiming($mockResponse = true)
    {
        $response = $this->getResponse('timing', array(
            'tid' => $this->getTrackingId(),
            'cid' => $this->getCustomerId(),
            't' => 'timing',
            'dns' => 331,
            'pdt' => 400,
            'rrt' => 500,
            'tcp' => 600,
            'srt' => 700,
            'plt' => 3554,
            'dit' => 800,
            'clt' => 900,
            'dh' => 'domain.do',
            'dp' => '/php-ga-measurement-protocol/page-timing-test',
            'dt' => 'PHP GA Measurement Protocol Page Load Timing Test'
        ), $mockResponse);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group internet
     */
    public function testPageLoadTimingLive()
    {
        $this->testPageLoadTiming(false);
    }

    public function testUserTiming($mockResponse = true)
    {
        $response = $this->getResponse('timing', array(
            'tid' => $this->getTrackingId(),
            'cid' => $this->getCustomerId(),
            't' => 'timing',
            'utc' => 'category',
            'utv' => 'lookup',
            'utt' => 10000,
            'utl' => 'label',
        ), $mockResponse);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group internet
     */
    public function testUserTimingLive()
    {
        $this->testUserTiming(false);
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

    public function testBadGatewayTriggersException()
    {
        $this->setExpectedException('GuzzleHttp\Command\Exception\CommandServerException');
        $this->getResponse('abstract.collect', array(
            'cid' => $this->getCustomerId(),
        ), true,  MeasurementProtocolClient::factory(array('tid' => 'BDGW')), 502);
    }

    public function testModifyProxyCurlSetting()
    {
        $proxy = 'tcp://localhost:80';
        $client = MeasurementProtocolClient::factory(array(
            'tid' => $this->getTrackingId(),
            'defaults' => array(
                'config' => array(
                    'curl' => array(
                        CURLOPT_PROXY => $proxy
                    )
                )
            )
        ));
        $this->getResponse('abstract.collect', array(
            'cid' => $this->getCustomerId(),
        ), true, $client);
        $requestCurlOptions = $this->history->getLastRequest()->getConfig()['curl'];
        $this->assertSame($proxy, $requestCurlOptions[CURLOPT_PROXY]);
    }

    /**
     * @param $operation
     * @param array $parameters
     * @param bool $mockResponse
     * @return Response
     */
    protected function getResponse($operation, array $parameters, $mockResponse = true, MeasurementProtocolClient $client = null, $statusCode = 200)
    {
        if (null === $client) {
            $client = MeasurementProtocolClient::factory();
        }

        if (true === $mockResponse) {
            $mock = new Mock(array(new Response($statusCode)), true);
            $client->getHttpClient()->getEmitter()->attach($mock);
        }

        $history = new History(3);
        $client->getHttpClient()->getEmitter()->attach($history);
        $this->history = $history;

        call_user_func(array($client, $operation), $parameters);

        return $history->getLastResponse();
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
