<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*'],

    'allowed_methods' => [
        'OPTIONS',
        'GET',
        'POST',
        'PUT',
        'PATCH',
        'DELETE',
    ],

    'allowed_origins' => [
        env('ALLOW_ORIGINS', '*')
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => [
        'Content-Type',
        'Origin',
        'X-Authorization',
        'X-Requested-With',
    ],

    'exposed_headers' => [
        'Cache-Control',
        'Content-Language',
        'Content-Type',
        'Expires',
        'Last-Modified',
        'Pragma',
        'Content-Disposition',
        'X-Authorization',
    ],

    'max_age' => 60 * 60,

    'supports_credentials' => false,

];
