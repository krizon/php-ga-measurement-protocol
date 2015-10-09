<?php

/*
 * This file is part of the php-ga-measurement-protocol package.
 *
 * (c) Kristian Zondervan <kristian.zondervan@gmail.com>
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
                'aip' => array(
                    'description' => 'Anonymize IP',
                    'location' => 'postField'
                ),
                'qt' => array(
                    'description' => 'Queue Time',
                    'location' => 'postField'
                ),
                /** User **/
                'cid' => array(
                    'location' => 'postField',
                    'required' => true
                ),
                'uid' => array(
                    'description' => 'User id',
                    'location' => 'postField'
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
                'cs' => array(
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
                'aid' => array(
                    'description' => 'Application id',
                    'location' => 'postField'
                ),
                'av' => array(
                    'description' => 'Application version',
                    'location' => 'postField'
                ),
                'aiid' => array(
                    'description' => 'Application installer id',
                    'location' => 'postField'
                ),
                /** Content Experiments **/
                'xid' => array(
                    'location' => 'postField',
                    'description' => 'Experiment ID',
                ),
                'xvar' => array(
                    'description' => 'Experiment variant',
                    'location' => 'postField'
                ),
                /** System info **/
                'sr' => array(
                    'description' => 'Screen resolution',
                    'location' => 'postField'
                ),
                'vp' => array(
                    'description' => 'Viewport size',
                    'location' => 'postField'
                ),
                'de' => array(
                    'description' => 'Document encoding',
                    'location' => 'postField',
                    'default' => 'UTF-8'
                ),
                'sd' => array(
                    'description' => 'Screen colors',
                    'location' => 'postField'
                ),
                'ul' => array(
                    'description' => 'User language',
                    'location' => 'postField'
                ),
                'je' => array(
                    'description' => 'Java enabled',
                    'location' => 'postField'
                ),
                'fl' => array(
                    'description' => 'Flash version',
                    'location' => 'postField'
                ),
                /** Hit */
                'ni' => array(
                    'description' => 'Non-Interaction Hit',
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
                'cm21' => array('location' => 'postField'),
                'cm22' => array('location' => 'postField'),
                'cm23' => array('location' => 'postField'),
                'cm24' => array('location' => 'postField'),
                'cm25' => array('location' => 'postField'),
                'cm26' => array('location' => 'postField'),
                'cm27' => array('location' => 'postField'),
                'cm28' => array('location' => 'postField'),
                'cm29' => array('location' => 'postField'),
                'cm30' => array('location' => 'postField'),
                'cm31' => array('location' => 'postField'),
                'cm32' => array('location' => 'postField'),
                'cm33' => array('location' => 'postField'),
                'cm34' => array('location' => 'postField'),
                'cm35' => array('location' => 'postField'),
                'cm36' => array('location' => 'postField'),
                'cm37' => array('location' => 'postField'),
                'cm38' => array('location' => 'postField'),
                'cm39' => array('location' => 'postField'),
                'cm40' => array('location' => 'postField'),
                'cm41' => array('location' => 'postField'),
                'cm42' => array('location' => 'postField'),
                'cm43' => array('location' => 'postField'),
                'cm44' => array('location' => 'postField'),
                'cm45' => array('location' => 'postField'),
                'cm46' => array('location' => 'postField'),
                'cm47' => array('location' => 'postField'),
                'cm48' => array('location' => 'postField'),
                'cm49' => array('location' => 'postField'),
                'cm50' => array('location' => 'postField'),

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
                'cd21' => array('location' => 'postField'),
                'cd22' => array('location' => 'postField'),
                'cd23' => array('location' => 'postField'),
                'cd24' => array('location' => 'postField'),
                'cd25' => array('location' => 'postField'),
                'cd26' => array('location' => 'postField'),
                'cd27' => array('location' => 'postField'),
                'cd28' => array('location' => 'postField'),
                'cd29' => array('location' => 'postField'),
                'cd30' => array('location' => 'postField'),
                'cd31' => array('location' => 'postField'),
                'cd32' => array('location' => 'postField'),
                'cd33' => array('location' => 'postField'),
                'cd34' => array('location' => 'postField'),
                'cd35' => array('location' => 'postField'),
                'cd36' => array('location' => 'postField'),
                'cd37' => array('location' => 'postField'),
                'cd38' => array('location' => 'postField'),
                'cd39' => array('location' => 'postField'),
                'cd40' => array('location' => 'postField'),
                'cd41' => array('location' => 'postField'),
                'cd42' => array('location' => 'postField'),
                'cd43' => array('location' => 'postField'),
                'cd44' => array('location' => 'postField'),
                'cd45' => array('location' => 'postField'),
                'cd46' => array('location' => 'postField'),
                'cd47' => array('location' => 'postField'),
                'cd48' => array('location' => 'postField'),
                'cd49' => array('location' => 'postField'),
                'cd50' => array('location' => 'postField')
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

                // enchaned ecommerce
                'tcc' => array(
                    'description' => 'Transaction coupon code',
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
                    'location' => 'postField'
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

                // enchanced ecommerce
                'pr[\d+]id' => array(
                    'description' => 'Item code / SKU',
                    'location' => 'postField',
                ),
                'pr[\d+]nm' => array(
                    'description' => 'Item name',
                    'location' => 'postField'
                ),
                'pr[\d+]br' => array(
                    'description' => 'Item brand',
                    'location' => 'postField'
                ),
                'pr[\d+]ca' => array(
                    'description' => 'Item category',
                    'location' => 'postField'
                ),
                'pr[\d+]va' => array(
                    'description' => 'Item variation',
                    'location' => 'postField'
                ),
                'pr[\d+]pr' => array(
                    'description' => 'Item price',
                    'location' => 'postField'
                ),
                'pr[\d+]qt' => array(
                    'description' => 'Item quantity',
                    'location' => 'postField'
                ),
                'pr[\d+]cc' => array(
                    'description' => 'Item coupon code',
                    'location' => 'postField'
                ),
                'pr[\d+]ps' => array(
                    'description' => 'Item position',
                    'location' => 'postField'
                ),
                'pr[\d+]cd[index]' => array(
                    'description' => 'Item custom dimension',
                    'location' => 'postField'
                ),
                'pr[\d+]cm[index]' => array(
                    'description' => 'Item custom metric',
                    'location' => 'postField'
                ),
                'pa' => array(
                    'description' => 'Item action',
                    'location' => 'postField'
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
        ),
        /** Timing **/
        'timing' => array(
            'extends' => 'abstract.collect',
            'parameters' => array(
                't' => array(
                    'description' => 'Timing hit type',
                    'location' => 'postField',
                    'default' => 'timing',
                    'static' => true
                ),
                'utc' => array(
                    'description' => 'User timing category',
                    'location' => 'postField'
                ),
                'utv' => array(
                    'description' => 'User timing variable name',
                    'location' => 'postField'
                ),
                'utt' => array(
                    'description' => 'User timing time',
                    'location' => 'postField'
                ),
                'utl' => array(
                    'description' => 'User timing label',
                    'location' => 'postField'
                ),
                'plt' => array(
                    'description' => 'Page Load Time',
                    'location' => 'postField'
                ),
                'dns' => array(
                    'description' => 'DNS Time',
                    'location' => 'postField'
                ),
                'pdt' => array(
                    'description' => 'Page Download Time',
                    'location' => 'postField'
                ),
                'rrt' => array(
                    'description' => 'Redirect Response Time',
                    'location' => 'postField'
                ),
                'tcp' => array(
                    'description' => 'TCP Connect Time',
                    'location' => 'postField'
                ),
                'srt' => array(
                    'description' => 'Server Response Time',
                    'location' => 'postField'
                ),
                'dit' => array(
                    'description' => 'DOM Interactive Time',
                    'location' => 'postField'
                ),
                'clt' => array(
                    'description' => 'Content Load Time',
                    'location' => 'postField'
                ),
            )
        )
    )
);
