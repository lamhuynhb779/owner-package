<?php

namespace Simplexi\ReportShipper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class Shipper
{
    private Client $client;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.slack.api_url'),
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
    }

    public function sendMessageToSlack(string $message): bool
    {
        try {
            $this->client->post("chat.postMessage", [
                'form_params' => [
                    'token' => config('services.slack.bot_user_oauth_token'),
                    'channel' =>  config('services.slack.chanel_id'),
                    'text'=> empty($message) ? 'Message To Slack App' : $message,
                    'as_user' => true,
                ],
            ]);

            return true;

        } catch (\Exception|GuzzleException $exception) {
            Log::error('Exception Error', [
                'message' => $exception->getMessage(),
                'line' => $exception->getFile().':'.$exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ]);
        }

        return false;
    }
}
