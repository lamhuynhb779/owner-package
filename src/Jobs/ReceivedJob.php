<?php

namespace Owner\Rabbit\Jobs;

use Illuminate\Support\Facades\Log;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob as BaseJob;

/**
 * The job for processing received data in consumer side
 */
class ReceivedJob extends BaseJob
{
    protected $maxAttempts = 3;
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("handle message");
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function fire()
    {
        // Check limit failed to stop handle
        if ($this->isJobFailedCompletely()) {
            $this->markAsFailed();
            return;
        }

        $data = $this->getData();
//         $payload = $this->payload();

        $class = TestJob::class;
        $method = 'handle';

        ($this->instance = $this->resolve($class))->{$method}($data);

        $this->delete();
    }

    protected function isJobFailedCompletely() : bool
    {
        return $this->attempts() > 3;
    }

    public function getData() : array
    {
        $payload = json_decode($this->getRawBody(), true);
        return $payload['data'] ? json_decode($payload['data'], true) : [];
    }

}
