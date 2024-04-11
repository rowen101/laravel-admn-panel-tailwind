<?php

return [

    /*
    |--------------------------------------------------------------------------
    | wms Prefix Settings
    |--------------------------------------------------------------------------
    |
    | Wms default prefix is "wms".
    | You can override the value by setting new prefix instead of wms.
    |
    */
    'prefix' => env('WMS_PREFIX', 'wms'),

    /*
    |--------------------------------------------------------------------------
    | Wms Pagination Settings
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default pagination settings for your application.
    |
    */
    'paginate' => [
        'per_page' => 10,
        'each_side' => 2,
    ],
];
