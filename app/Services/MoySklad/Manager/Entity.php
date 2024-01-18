<?php

namespace App\Services\MoySklad\Manager;

use App\Services\MoySklad\Api\Manager;
use \App\Services\MoySklad\Enums;
use Illuminate\Support\Facades\Cache;

readonly class Entity
{
    public function __construct(private Manager $apiManager)
    {
    }

    public function get(Enums\Entity $entity): array
    {
        return Cache::remember(session()->getId() . $entity->value, '30', function () use ($entity) {
            $list = $this->apiManager->getEntity->{$entity->value}();
            $result = [];

            $data = $list['rows'] ?? $list['states'] ?? [];
            foreach ($data as $item) {
                $result[$item['id']] = $item;
            }

            return $result;
        });
    }

    public function updateState(string $uid, string $state): bool
    {
        Cache::delete(session()->getId() . Enums\Entity::agent->value);
        Cache::delete(session()->getId() . Enums\Entity::states->value);
        Cache::delete(session()->getId() . Enums\Entity::orders->value);

        $states = $this->apiManager->getEntity->metadata();
        foreach ($states['states'] as $st) {
            if ($st['name'] === $state) {
                $newState = $st;
            }
        }

        if (isset($newState)) {
            $data['state'] = $newState;
            $result = $this->apiManager->putEntity->customerorder($uid, $data);
            if (isset($result['id'])) {
                Cache::delete(session()->getId() . Enums\Entity::agent->value);
                return true;
            }
        }

        return false;
    }
}
