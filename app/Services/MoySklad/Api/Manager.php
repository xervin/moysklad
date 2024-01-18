<?php

namespace App\Services\MoySklad\Api;


readonly class Manager
{
    public Api $api;
    public GetEntity $getEntity;
    public PutEntity $putEntity;
    public function __construct(string $login, string $pass)
    {
        $this->api = new Api($login, $pass);
        $this->getEntity = new GetEntity($this->api);
        $this->putEntity = new PutEntity($this->api);
    }
}
