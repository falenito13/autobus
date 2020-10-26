<?php

return [

    /* -----------------------------------------------------------------
     |  Settings
     | -----------------------------------------------------------------
     */

    'supported-locales'      => ['ka', 'en'],

    'accept-language-header' => true,

    'hide-default-in-url'    => false,

    'redirection-code'       => 302,

    'utf-8-suffix'           => '.UTF-8',

    /* -----------------------------------------------------------------
     |  Route
     | -----------------------------------------------------------------
     */

    'route'                  => [
        'middleware' => [
            'localization-session-redirect' => true,
            'localization-cookie-redirect'  => false,
            'localization-redirect'         => true,
            'localized-routes'              => true,
            'translation-redirect'          => true,
        ],
    ],

    /* -----------------------------------------------------------------
     |  Ignored URI from localization
     | -----------------------------------------------------------------
     */

    'ignored-uri' => [
        //
    ],

    /* -----------------------------------------------------------------
     |  Locales
     | -----------------------------------------------------------------
     */

    'locales'   => [
        // EN
        //====================================================>
        'en'          => [
            'name'     => 'English',
            'script'   => 'Latn',
            'dir'      => 'ltr',
            'native'   => 'English',
            'regional' => 'en_GB',
        ],

        // KA
        //====================================================>
        'ka'          => [
            'name'     => 'Georgian',
            'script'   => 'Geor',
            'dir'      => 'ltr',
            'native'   => 'ქართული',
            'regional' => 'ka_GE',
        ],

        // RU
        //====================================================>
        'ru'          => [
            'name'     => 'Russian',
            'script'   => 'Cyrl',
            'dir'      => 'ltr',
            'native'   => 'Русский',
            'regional' => 'ru_RU',
        ],

    ],

];
