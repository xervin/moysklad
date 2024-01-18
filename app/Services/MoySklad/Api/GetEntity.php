<?php

namespace App\Services\MoySklad\Api;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

readonly class GetEntity
{
    public function __construct(private Api $api) {}


    public function customerorder(?string $uid = null): array|null
    {
        return $this->api->call('GET', 'entity/customerorder/' . $uid);
    }

    public function counterparty(?string $uid = null): array|null
    {
        return $this->api->call('GET', 'entity/counterparty/' . $uid);
    }

    public function organization(?string $uid = null): array|null
    {
        return $this->api->call('GET', 'entity/organization/' . $uid);
    }

    public function currency(?string $uid = null): array|null
    {
        return $this->api->call('GET', 'entity/currency/' . $uid);
    }

    public function metadata(): array|null
    {
        return $this->api->call('GET', 'entity/customerorder/metadata');
    }

    public function employee(?string $uid = null): array|null
    {
        return $this->api->call('GET', 'entity/employee/' . $uid);
    }

    public function group(?string $uid = null): array|null
    {
        return $this->api->call('GET', 'entity/group/' . $uid);
    }
}
