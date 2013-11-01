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
        ),
        'transaction' => array(
            'extends' => 'abstract.collect',
            'parameters' => array(
                't' => array(
                    'description' => 'Transaction hit type',
                    'location' => 'postField',
                    'default' => 'transaction',
                    'static' => true
                ),
                'ti' => array(
                    'description' => 'transaction ID',
                    'location' => 'postField',
                    'required' => true
                ),
                'ta' => array(
                    'description' => 'Transaction affiliation',
                    'location' => 'postField',
                ),
                'tr' => array(
                    'description' => 'Transaction revenue',
                    'location' => 'postField',
                ),
                'ts' => array(
                    'description' => 'Transaction shipping',
                    'location' => 'postField',
                ),
                'tt' => array(
                    'description' => 'Transaction shipping',
                    'location' => 'postField',
                ),
                'cu' => array(
                    'description' => 'Currency code',
                    'location' => 'postField',
                ),
            )
        ),
        'item' => array(
            'extends' => 'abstract.collect',
            'parameters' => array(
                't' => array(
                    'description' => 'Item hit type',
                    'location' => 'postField',
                    'default' => 'item',
                    'static' => true
                ),
                'ti' => array(
                    'description' => 'transaction ID',
                    'location' => 'postField',
                    'required' => true
                ),
                'in' => array(
                    'description' => 'Item name',
                    'location' => 'postField',
                    'required' => true
                ),
                'ip' => array(
                    'description' => 'Item price',
                    'location' => 'postField',
                ),
                'iq' => array(
                    'description' => 'Item quantity',
                    'location' => 'postField',
                ),
                'ic' => array(
                    'description' => 'Item quantity',
                    'location' => 'postField',
                ),
                'iv' => array(
                    'description' => 'Item variation / category',
                    'location' => 'postField',
                ),
                'cu' => array(
                    'description' => 'Currency code',
                    'location' => 'postField',
                ),
            )
        ),
        'social' => array(
            'extends' => 'abstract.collect',
            'parameters' => array(
                't' => array(
                    'description' => 'Social hit type',
                    'location' => 'postField',
                    'default' => 'social',
                    'static' => true
                ),
                'sa' => array(
                    'description' => 'Social Action',
                    'location' => 'postField',
                    'required' => true
                ),
                'sn' => array(
                    'description' => 'Social Network',
                    'location' => 'postField',
                    'required' => true
                ),
                'st' => array(
                    'description' => 'Social Target',
                    'location' => 'postField',
                    'required' => true
                ),
            )
        ),
        'exception' => array(
            'extends' => 'abstract.collect',
            'parameters' => array(
                't' => array(
                    'description' => 'Exception hit type',
                    'location' => 'postField',
                    'default' => 'exception',
                    'static' => true
                ),
                'exd' => array(
                    'description' => 'Exception description',
                    'location' => 'postField'
                ),
                'exf' => array(
                    'description' => 'Exception is fatal?',
                    'location' => 'postField'
                )
            )
        )
    )
);
