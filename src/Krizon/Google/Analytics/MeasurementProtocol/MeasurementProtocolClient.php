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

use Guzzle\Common\Collection;
use Guzzle\Http\Message\Request;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

class MeasurementProtocolClient extends Client
{
    public static function factory($config = array())
    {
        $default = array(
            'ssl' => false,
            'tid' => null
        );
        $required = array('ssl');

        $config = Collection::fromConfig($config, $default, $required);

        $baseUrl = ($config->get('ssl') === true) ? 'https://ssl.google-analytics.com' : 'http://www.google-analytics.com';

        $client = new self($baseUrl, $config);

        $description = ServiceDescription::factory(__DIR__ . '/Resources/service.php');
        $client->setDescription($description);

        if (true === isset($config['tid'])) {
            $client->getEventDispatcher()->addListener('client.create_request', function ($e) use ($config) {
                /** @var Request $request */
                $request = $e['request'];
                if (false === $request->getQuery()->hasKey('tid')) {
                    $request->getQuery()->set('tid', $config['tid']);
                }
            });
        }

        return $client;
    }
}
