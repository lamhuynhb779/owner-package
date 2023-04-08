<?php

return [
    'rabbitmq' => [
        'driver' => 'rabbitmq',
        'queue' => env('RABBITMQ_QUEUE', 'order1.fanout'),
        'connection' => PhpAmqpLib\Connection\AMQPLazyConnection::class,
        'hosts' => [
            [
                'host' => env('RABBITMQ_HOST', '127.0.0.1'),
                'port' => env('RABBITMQ_PORT', 15672),
                'user' => env('RABBITMQ_USER', 'guest'),
                'password' => env('RABBITMQ_PASSWORD', 'guest'),
                'vhost' => env('RABBITMQ_VHOST', '/'),
            ],
        ],

        'options' => [
            'queue' => [
                'exchange' => 'order.fanout',
                'exchange_type' => 'fanout',
                'prioritize_delayed_messages' =>  false,
                'queue_max_priority' => 10,
            ],
            'exchange' => [

                'name' => env('RABBITMQ_EXCHANGE_NAME', 'order.fanout'),
                /*
             * Determine if exchange should be created if it does not exist.
             */

                'declare' => env('RABBITMQ_EXCHANGE_DECLARE', true),

                /*
             * Read more about possible values at https://www.rabbitmq.com/tutorials/amqp-concepts.html
             */

                'type' => 'fanout',
                'passive' => env('RABBITMQ_EXCHANGE_PASSIVE', false),
                'durable' => env('RABBITMQ_EXCHANGE_DURABLE', true),
                'auto_delete' => env('RABBITMQ_EXCHANGE_AUTODELETE', false),
                'arguments' => env('RABBITMQ_EXCHANGE_ARGUMENTS'),
            ],
            'ssl_options' => [
                'cafile' => env('RABBITMQ_SSL_CAFILE', null),
                'local_cert' => env('RABBITMQ_SSL_LOCALCERT', null),
                'local_key' => env('RABBITMQ_SSL_LOCALKEY', null),
                'verify_peer' => env('RABBITMQ_SSL_VERIFY_PEER', true),
                'passphrase' => env('RABBITMQ_SSL_PASSPHRASE', null),
            ],
        ],

        /*
         * Set to "horizon" if you wish to use Laravel Horizon.
         */
        'worker' => env('RABBITMQ_WORKER', 'default'),

    ],
    'rabbitmq_direct' => [
        'driver' => 'rabbitmq',
        'queue' => 'email.service1',
        'connection' => PhpAmqpLib\Connection\AMQPLazyConnection::class,
        'hosts' => [
            [
                'host' => env('RABBITMQ_HOST', '127.0.0.1'),
                'port' => env('RABBITMQ_PORT', 15672),
                'user' => env('RABBITMQ_USER', 'guest'),
                'password' => env('RABBITMQ_PASSWORD', 'guest'),
                'vhost' => env('RABBITMQ_VHOST', '/'),
            ],
        ],

        'options' => [
            'queue' => [
                'exchange' => 'email.direct',
                'exchange_type' => 'direct',
                'exchange_routing_key' => "email1",
                'prioritize_delayed_messages' =>  false,
                'queue_max_priority' => 10,
            ],
            'exchange' => [

                'name' => 'email.service',
                /*
             * Determine if exchange should be created if it does not exist.
             */

                'declare' => env('RABBITMQ_EXCHANGE_DECLARE', true),

                /*
             * Read more about possible values at https://www.rabbitmq.com/tutorials/amqp-concepts.html
             */

                'type' => 'direct',
                'passive' => env('RABBITMQ_EXCHANGE_PASSIVE', false),
                'durable' => env('RABBITMQ_EXCHANGE_DURABLE', true),
                'auto_delete' => env('RABBITMQ_EXCHANGE_AUTODELETE', false),
                'arguments' => env('RABBITMQ_EXCHANGE_ARGUMENTS'),
            ],
            'ssl_options' => [
                'cafile' => env('RABBITMQ_SSL_CAFILE', null),
                'local_cert' => env('RABBITMQ_SSL_LOCALCERT', null),
                'local_key' => env('RABBITMQ_SSL_LOCALKEY', null),
                'verify_peer' => env('RABBITMQ_SSL_VERIFY_PEER', true),
                'passphrase' => env('RABBITMQ_SSL_PASSPHRASE', null),
            ],
        ],

        /*
         * Set to "horizon" if you wish to use Laravel Horizon.
         */
        'worker' => env('RABBITMQ_WORKER', 'default'),

    ],
];
