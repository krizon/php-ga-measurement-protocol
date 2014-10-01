<?php

/*
 * This file is part of the php-ga-measurement-protocol package.
 *
 * (c) Kristian Zondervan <kristian.zondervan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Krizon\Google\Analytics\MeasurementProtocol;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Event\PrepareEvent;

class MeasurementProtocolClient extends GuzzleClient
{
    const BASE_URL = 'http://www.google-analytics.com';
    const BASE_URL_SSL = 'https://ssl.google-analytics.com';

    public static function factory(array $config = array())
    {
        $config = array_merge(array(
            'ssl' => false,
            'tid' => null
        ), $config);

        $description = include __DIR__ . '/Resources/service.php';
        $description['baseUrl'] = ($config['ssl'] === true) ? self::BASE_URL_SSL : self::BASE_URL;

        $httpClient = new Client($config);
        $description = new Description($description);
        $client = new self($httpClient, $description, $config);

        if (true === isset($config['tid'])) {
            $client->getEmitter()->on('prepare', function(PrepareEvent $event) use($config) {
                $command = $event->getCommand();
                if (false === $command->hasParam('tid')) {
                    $command['tid'] = $config['tid'];
                }
            }, 10);
        }
        return $client;
    }
}
