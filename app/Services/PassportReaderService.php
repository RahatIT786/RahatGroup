<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PassportReaderService
{
    protected $apiUrl;
    protected $token;
    protected $client;

    public function __construct()
    {
        $config = config('services.passport_reader');
        $this->apiUrl = $config['api_url'] ?? 'https://ping.arya.ai/api/v1/kyc';
        $this->token = $config['token'];
        $this->client = new Client();
    }

    public function readPassport($filePath, $reqId)
    {
        try {
            $documentContent = file_get_contents($filePath);
            $documentBase64 = base64_encode($documentContent);

            // Make the POST request using Guzzle
            $response = $this->client->post($this->apiUrl, [
                'headers' => [
                    'token' => $this->token,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'doc_base64' => $documentBase64,
                    'req_id' => $reqId,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                return $response->getBody()->getContents();
            } else {
                return 'Unexpected HTTP status: ' . $response->getStatusCode() . ' ' . $response->getReasonPhrase();
            }
        } catch (RequestException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
