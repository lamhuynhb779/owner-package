<?php

namespace Hayashi\Rabbitmq\Commands;

use Illuminate\Console\Command;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Connectors\RabbitMQConnector;

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
            config('queue.connections.rabbitmq.queue'),
            [
                'exchange'             => 'order.fanout',
                'exchange_type'        => 'fanout',
            ]
        );
    }
}
