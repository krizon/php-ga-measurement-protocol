<?php

/*
 * This file is part of the php-ga-measurement-protocol package.
 *
 * (c) Kristian Zondervan <kristian.zondervan@gmail.com>
 * (c) Alexandre Assouad <alexandre.assouad@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * for more information, refer to google documentation :
 * https://developers.google.com/analytics/devguides/collection/protocol/v1/parameters
 *
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
                    'location' => 'query',
                    'required' => true,
                ),
                'cid' => array(
                    'location' => 'postField',
                    'required' => true
                ),
                /** Content information **/
                'dl' => array(
                    'description' => 'Document location url',
                    'location' => 'postField',
                ),
                'dh' => array(
                    'description' => 'Document hostname',
                    'location' => 'postField',
                ),
                'dp' => array(
                    'description' => 'Document path',
                    'location' => 'postField',
                ),
                'dt' => array(
                    'description' => 'Document title',
                    'location' => 'postField',
                ),
                'cd' => array(
                    'description' => 'Content description',
                    'location' => 'postField',
                ),
                'linkid' => array(
                    'description' => 'The ID of a clicked DOM element',
                    'location' => 'postField',
                ),
                /** Session **/
                'sc' => array(
                    'location' => 'postField',
                    'description' => 'Session control',
                ),
                /** Traffic Sources **/
                'dr' => array(
                    'location' => 'postField',
                    'description' => 'Document referrer',
                ),
                'cn' => array(
                    'location' => 'postField',
                    'description' => 'Specifies the campaign name',
                ),
                'cr' => array(
                    'location' => 'postField',
                    'description' => 'Specifies the campaign source',
                ),
                'cm' => array(
                    'location' => 'postField',
                    'description' => 'Specifies the campaign medium',
                ),
                'ck' => array(
                    'location' => 'postField',
                    'description' => 'Specifies the campaign keyword',
                ),
                'cc' => array(
                    'location' => 'postField',
                    'description' => 'Specifies the campaign content',
                ),
                'ci' => array(
                    'location' => 'postField',
                    'description' => 'Specifies the campaign ID',
                ),
                'gclid' => array(
                    'location' => 'postField',
                    'description' => 'Specifies the Google AdWords Id',
                ),
                'dclid' => array(
                    'location' => 'postField',
                    'description' => 'Specifies the Google Display Ads Id',
                ),
                /** Application tracking **/
                'an' => array(
                    'location' => 'postField',
                    'description' => 'Application name',
                ),
                'av' => array(
                    'description' => 'Application version',
                    'location' => 'postField'
                ),
                /** unofficial **/
                'ua' => array(
                    'location' => 'postField',
                    'description' => 'User-agent override',
                ),
                'uip' => array(
                    'description' => 'ip override',
                    'location' => 'postField'
                ),
                'cm1' => array(
                    'description' => 'Custom metric 1',
                    'location' => 'postField',
                ),
                'cm2' => array('location' => 'postField'),
                'cm3' => array('location' => 'postField'),
                'cm4' => array('location' => 'postField'),
                'cm5' => array('location' => 'postField'),
                'cm6' => array('location' => 'postField'),
                'cm7' => array('location' => 'postField'),
                'cm8' => array('location' => 'postField'),
                'cm9' => array('location' => 'postField'),
                'cm10' => array('location' => 'postField'),
                'cm11' => array('location' => 'postField'),
                'cm12' => array('location' => 'postField'),
                'cm13' => array('location' => 'postField'),
                'cm14' => array('location' => 'postField'),
                'cm15' => array('location' => 'postField'),
                'cm16' => array('location' => 'postField'),
                'cm17' => array('location' => 'postField'),
                'cm18' => array('location' => 'postField'),
                'cm19' => array('location' => 'postField'),
                'cm20' => array('location' => 'postField'),
                'cd1' => array(
                    'description' => 'Custom dimension 1',
                    'location' => 'postField',
                ),
                'cd2' => array('location' => 'postField'),
                'cd3' => array('location' => 'postField'),
                'cd4' => array('location' => 'postField'),
                'cd5' => array('location' => 'postField'),
                'cd6' => array('location' => 'postField'),
                'cd7' => array('location' => 'postField'),
                'cd8' => array('location' => 'postField'),
                'cd9' => array('location' => 'postField'),
                'cd10' => array('location' => 'postField'),
                'cd11' => array('location' => 'postField'),
                'cd12' => array('location' => 'postField'),
                'cd13' => array('location' => 'postField'),
                'cd14' => array('location' => 'postField'),
                'cd15' => array('location' => 'postField'),
                'cd16' => array('location' => 'postField'),
                'cd17' => array('location' => 'postField'),
                'cd18' => array('location' => 'postField'),
                'cd19' => array('location' => 'postField'),
                'cd20' => array('location' => 'postField'),
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
                )
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
                )
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
                    'description' => 'Transaction tax',
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
                    'description' => 'Item code / SKU',
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
