<?php

return [

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'profiles' => [
            'driver' => 'local',
            'root' => storage_path('app/profiles'),
            'url' => env('APP_URL').'/profiles',
            'visibility' => 'public',
        ],

        'forms' => [
            'driver' => 'local',
            'root' => storage_path('app/forms'),
            'url' => env('APP_URL').'/forms',
            'visibility' => 'public',
        ],

        'prizes' => [
            'driver' => 'local',
            'root' => storage_path('app/prizes'),
            'url' => env('APP_URL').'/prizes',
            'visibility' => 'public',
        ],

        'agreements' => [
            'driver' => 'local',
            'root' => storage_path('app/agreements'),
            'url' => env('APP_URL').'/agreements',
            'visibility' => 'private',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
        public_path('profiles') => storage_path('app/profiles'),
        public_path('agreements') => storage_path('app/agreements'),
        public_path('forms') => storage_path('app/forms'),
        public_path('prizes') => storage_path('app/prizes'),
        //public_path('profiles') => storage_path('app/public/profiles'),
    ],

];
