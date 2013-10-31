<?php

/*
 * This file is part of the php-ga-measurement-protocol package.
 *
 * (c) Kristian Zondervan <kristian.zondervan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!file_exists(dirname(__DIR__) . '/composer.lock')) {
    die("Dependencies must be installed using composer:\n\nphp composer.phar install\n\n"
        . "See http://getcomposer.org for help with installing composer\n");
}

$loader = require dirname(__DIR__) . '/vendor/autoload.php';
$loader->add('Krizon\\GoogleA\\nalytics\\MeasurementProtocol\\Test', __DIR__);

Guzzle\Tests\GuzzleTestCase::setMockBasePath(__DIR__ . '/mock');

Guzzle\Tests\GuzzleTestCase::setServiceBuilder(Guzzle\Service\Builder\ServiceBuilder::factory(array(
    'ga_measurement_protocol' => array(
        'class' => 'Krizon\Google\Analytics\MeasurementProtocol\MeasurementProtocolClient',
        'params' => array(
        )
    )
)));
