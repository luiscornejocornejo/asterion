<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],
        'sftp' => [
            'driver' => 'sftp',
            'host' => '146.190.138.96',
            'username' => 'root',
            'password' => 'YmsZy2P7SeQetG',
            'root' => '/var/www/laravel',
            'timeout' => 10,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
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
            'throw' => false,
        ],
        'do' => [
            'driver' => 's3',
            'key' => env('DIGITALOCEAN_SPACES_KEY', 'DO00V2VKR42PK2HD8MZN'),
            'secret' => env('DIGITALOCEAN_SPACES_SECRET', '3AA9n67+yR1qZ6lbo6LHYZJP3K/p3c9R0vIeGhwywLU'),
            'endpoint' => env('DIGITALOCEAN_SPACES_ENDPOINT', 'https://sfo3.digitaloceanspaces.com'),
            'region' => env('DIGITALOCEAN_SPACES_REGION', 'sfo3'),
            'bucket' => env('DIGITALOCEAN_SPACES_BUCKET', 'sienamedia'),
            'visibility' => 'public',
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
    ],

];
