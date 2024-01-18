<?php

namespace App\Services\MoySklad\Api;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

readonly class PutEntity
{
    public function __construct(private Api $api) {}

    public function customerorder(string $uid, array $data): array|null
    {
        return $this->api->call('PUT', 'entity/customerorder/' . $uid, [
            'json' => $data
        ]);
    }
}
