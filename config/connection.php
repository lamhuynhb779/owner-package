<?php

return [

    /*
     * THESE CONFIGS ARE ONLY FOR COPYING, DO NOT CHANGE ANYTHING
     * make sure you copy and change these configs in queue.php file
     * Copy config bellow to your queue.php configuration file. Put this in queue.connections like this
     * 'connections' => [
     *     'rabbitmq' =>
     * ]
     */
    'rabbitmq'           => [
        /**
         * Set routing key, this key should be the same as project name
         * and must be unique
         * Caution: duplicate routing key lead to your job being consumed by other project
         */
        'routing_key' => 'hayashiEventLogger',

        'driver'      => 'rabbitmq',
        'queue'       => env('RABBITMQ_QUEUE', 'default'),
        'connection'  => PhpAmqpLib\Connection\AMQPSSLConnection::class,

        // These configs are mandatory and must be configured in .env file
        'hosts'       => [
            [
                'host'     => env('RABBITMQ_HOST', '127.0.0.1'),
                'port'     => env('RABBITMQ_PORT', 5672),
                'user'     => env('RABBITMQ_USER', 'guest'),
                'password' => env('RABBITMQ_PASSWORD', 'guest'),
                'vhost'    => env('RABBITMQ_VHOST', '/'),
            ],
        ],
        // These configs are optional and can be skipped
        'options'     => [
            'ssl_options' => [
                'cafile'      => env('RABBITMQ_SSL_CAFILE', null),
                'local_cert'  => env('RABBITMQ_SSL_LOCALCERT', null),
                'local_key'   => env('RABBITMQ_SSL_LOCALKEY', null),
                'verify_peer' => env('RABBITMQ_SSL_VERIFY_PEER', true),
                'passphrase'  => env('RABBITMQ_SSL_PASSPHRASE', null),
            ],
            'queue'       => [
                'job'                => \Hayashi\Rabbitmq\Jobs\ReceivedJob::class,
                'reroute_failed'     => true,
                'failed_exchange'    => 'failed-exchange',
                'failed_routing_key' => 'hayashi-event-failed-%s',
            ],
        ],

        /*
         * Set to "horizon" if you wish to use Laravel Horizon.
         */
        'worker'      => env('RABBITMQ_WORKER', 'default'),
        'retry_after' => 5,
        'max_retries' => 1,
    ],

    /*
     * Copy config bellow to your queue.php configuration file. Put this in queue.connections like this
     * 'connections' => [
     *     'rabbitmq' =>
     * ]
     */
    'hayashi_push_event'   => [
        'driver'      => 'redis',
        'connection'  => 'hayashiEvent',
        'queue'       => 'hayashiEvent',
        'retry_after' => 90,
        'block_for'   => null,
    ],

    /*
     * Copy config bellow to your database.php configuration file. Put this in database.redis like this
     * 'redis' => [
     *     'default' =>
     * ]
     */
    'gotitEvent'         => [
        'url'      => env('REDIS_URL'),
        'host'     => env('REDIS_HOST', '127.0.0.1'),
        'username' => env('REDIS_USERNAME'),
        'password' => env('REDIS_PASSWORD'),
        'port'     => env('REDIS_PORT', '6379'),
        'database' => env('REDIS_HAYASHI_EVENT_DB', '2'),
    ],

    // If true, all events will be fired under the same Event class: GotitEvent.php
    // If false, all events will be fired as separate events
    'use_general_event' => true,

    /**
     * Use this option to register event that you want to listen to
     * Note that: * means you want  to listen to ALL EVENTS
     * 'listen_to'    => ['*'],
     */
    'listen_to'          => ['*'],
];
