<?php

/*
 * This file is part of the php-ga-measurement-protocol package.
 *
 * (c) Kristian Zondervan <kristian.zondervan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array(
    'name'       => 'Google Analytics Measurement Protocol PHP Client',
    'operations'            => array(
        'abstract.collect' => array(
            'httpMethod' => 'POST',
            'uri'       => 'collect',
            'summary'   => 'Collect data',
            'parameters' => array(
                'v' => array(
                    'location' => 'postField',
                    'default'=> 1,
                    'static' => true
                ),
                'tid' => array(
                    'location' => 'postField',
                    'required' => true
                ),
                'cid' => array(
                    'location' => 'postField',
                    'required' => true
                ),
                'ua' => array(
                    'location' => 'header',
                    'sentAs' => 'User-Agent',
                    'default' => 'PHP GA Measurement Protocol'
                )
            )
        ),
        'pageview' => array(
            'extends' => 'abstract.collect',
            'parameters' => array(
                't' => array(
                    'description' => 'Pageview hit type',
                    'location' => 'postField',
                    'default' => 'pageview',
                    'static' => true
                ),
                'dh' => array(
                    'description' => 'Document hostname',
                    'location' => 'postField',
                ),
                'dp' => array(
                    'description' => 'Page',
                    'location' => 'postField',
                ),
                'dt' => array(
                    'description' => 'Title',
                    'location' => 'postField',
                ),
            )
        ),
        'event' => array(
            'extends' => 'abstract.collect',
            'parameters' => array(
                't' => array(
                    'description' => 'Event hit type',
                    'location' => 'postField',
                    'default' => 'event',
                    'static' => true
                ),
                'ec' => array(
                    'description' => 'Event category',
                    'location' => 'postField',
                ),
                'ea' => array(
                    'description' => 'Event action',
                    'location' => 'postField',
                ),
                'el' => array(
                    'description' => 'Event label',
                    'location' => 'postField',
                ),
                'ev' => array(
                    'description' => 'Event value',
                    'location' => 'postField',
                ),
            )
        )
    )
);
