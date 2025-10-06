<?php

return [
    // development mode, assets will not be internalized
    // For Railway deployment, keep dev_mode true to serve CDN assets directly
    // without local caching (which doesn't work with ephemeral filesystem)
    'dev_mode' => env('BASSET_DEV_MODE', true),

    // verify ssl certificate while fetching assets
    'verify_ssl_certificate' => env('BASSET_VERIFY_SSL_CERTIFICATE', true),

    // disk and path where to store bassets
    'disk' => env('BASSET_DISK', 'public'),
    'path' => 'basset',

    // use cache map file (.basset)
    'cache_map' => env('BASSET_CACHE_MAP', true),

    // view paths that may use @basset
    // used to internalize assets in advance with artisan basset:internalize
    'view_paths' => [
        resource_path('views'),
    ],

    // content security policy nonce
    'nonce' => null,

    // use relative path
    'relative_paths' => env('BASSET_RELATIVE_PATHS', true),
];
