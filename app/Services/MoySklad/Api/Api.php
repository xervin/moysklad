<?php

namespace App\Services\MoySklad\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Api
{
    private const URL = 'https://api.moysklad.ru/api/remap/1.2/';

    private Client $client;
    public function __construct(string $login, string $pass)
    {
        $this->client = new Client([
            'base_uri' => self::URL,
            'headers' => [
                'Accept-Encoding' => 'gzip',
                'Authorization' => 'Basic ' . base64_encode($login . ':' . $pass),
            ]
        ]);
    }

    public function call(string $method, $uri = '', array $options = [])
    {
        try {
            $request = $this->client->request($method, $uri, $options);
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $respBody = json_decode($response->getBody()->getContents(), true);
            Log::error($response->getStatusCode(), [$respBody]);
        } catch (RequestException $e) {
            Log::error($e->getMessage());
        }

        if (isset($request)) {
            return json_decode($request->getBody()->getContents(), true);
        }

        return [];
    }

    public function fast(string $url, string $method = 'GET')
    {
        return $this->call($method, $url);
    }
}
