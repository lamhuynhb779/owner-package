<?php

namespace Hayashi\Rabbitmq\Commands;

use Illuminate\Console\Command;

class TestPushJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:push-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connect RabbitMQ and push a job';

    protected $data;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['event'] = 'sample';
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \JsonException
     */
    public function handle()
    {
        $queueManager = app('queue');
        $connection = $queueManager->connection('rabbitmq');
        $connection->push(
            'RabbitMQExecuteJob@handle',
            json_encode(['message' => 'This is a message from producer'], JSON_THROW_ON_ERROR),
            config('queue.connections.rabbitmq.queue'), //  hoặc dùng 'default'
            [
                'exchange'             => 'hayashi-event',
                'exchange_type'        => 'direct',
                'exchange_routing_key' => 'hayashi-event-' . $this->data['event'],
            ]

        );
    }
}
