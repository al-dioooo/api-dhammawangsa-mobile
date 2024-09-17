<?php

namespace App\Services;

use GuzzleHttp\Client;

class Midtrans
{
    protected $client;
    protected $serverKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->serverKey = env('MIDTRANS_SERVER_KEY');
    }

    public function getSnapToken($data)
    {
        $baseUrl = 'https://app.sandbox.midtrans.com';

        $response = $this->client->post("{$baseUrl}/snap/v1/transactions", [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':')
            ],
            'json' => $data
        ]);

        return json_decode($response->getBody(), true);
    }
}
