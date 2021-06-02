<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ingor Name
    |--------------------------------------------------------------------------
    |
    | This is the Ingor main title.
    |
    */

    'name' => 'Ingor',

    /*
    |--------------------------------------------------------------------------
    | Ingor Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Ingor will be accessible from. If this
    | setting is null, Ingor will reside under the same domain as the
    | application. Otherwise, this value will serve as the subdomain.
    |
    */

    'domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Ingor Prefix
    |--------------------------------------------------------------------------
    |
    | This is the URI prefix where Ingor will be accessible from. Feel
    | free to change this prefix to anything you like. Note that the URI will
    | not affect the paths of its internal API that aren't exposed to users.
    |
    */

    'prefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Ingor Controller Namespace
    |--------------------------------------------------------------------------
    |
    | This is the controller namespace of Ingor.
    |
    */

    'controller' => '\Admin\Controllers',

    /*
    |--------------------------------------------------------------------------
    | Ingor Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each Ingor route, giving
    | you the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        \Ingor\Http\Middleware\InertiaRequest::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Ingor Authentication
    |--------------------------------------------------------------------------
    |
    | This is define the Ingor authentication config. More reference
    | the Laravel auth config.
    |
    */

    'auth' => [
        'guard' => 'ingor',

        'guards' => [
            'ingor' => [
                'driver' => 'session',
                'provider' => 'ingor_users',
            ],
        ],

        'providers' => [
            'ingor_users' => [
                'driver' => 'eloquent',
                'model' => \Ingor\Models\User::class,
            ],
        ],
    ],

];
