<?php

namespace App\Services\MoySklad\Manager;

use App\Services\MoySklad\Helper\CurrencyHelper;
use App\Services\MoySklad\Helper\MetaHref;
use App\Services\MoySklad\Enums;
use App\Services\MoySklad\Api;
use App\Services\MoySklad\VO\TableRow;
use Illuminate\Support\Carbon;

class Order
{
    private Entity $entityManager;

    public function __construct(Api\Manager $apiManager)
    {
        $this->entityManager = new Entity($apiManager);
    }

    /**
     * Подготовленные данные для представления.
     * Получилось грязно т.к. уже не хватало времени закончить в срок
     * @return array
     */
    public function listByBuyers(): array
    {
        $result = [];
        $list = $this->entityManager->get(Enums\Entity::orders);

        foreach ($list as $item) {
            /**
             * Блок ниже - получение сразу списка по позициям и поиск для итогового списка.
             * Результаты запросов кэшируются, поэтому не стал пока выносить из цикла
             */
            $agent = $this->get(Enums\Entity::agent, $item['agent']['meta']['href'] ?? null);
            $organization = $this->get(Enums\Entity::organization, $item['organization']['meta']['href'] ?? null);
            $currency = $this->get(Enums\Entity::rate, $item['rate']['currency']['meta']['href'] ?? null);
            $state = $this->get(Enums\Entity::states, $item['state']['meta']['href'] ?? null);
            $owner = $this->get(Enums\Entity::owner, $item['owner']['meta']['href'] ?? null);
            $groups = $this->get(Enums\Entity::owner, $item['group']['meta']['href'] ?? null);

            $result[strtotime($item['moment'])] = [
                'uid' => new TableRow(
                    $item['id'] ?? null,
                ),
                'id' => new TableRow(
                    $item['name'] ?? null,
                        $item['meta']['uuidHref'] ?? null
                ),
                'moment' => new TableRow(
                    Carbon::make($item['moment'] ?? '')->format('d.m.Y H:i') ?? null
                ),
                'agent' => new TableRow(
                    $agent['name'] ?? null,
                        $agent ?? null
                ),
                'organization' => new TableRow(
                    $organization['name'] ?? null
                ),
                'sum' => new TableRow(
                    CurrencyHelper::format($item['sum'] ?? '')
                ),
                'currency' => new TableRow(
                    $currency['name'] ?? null
                ),
                'state' => new TableRow(
                    $state['name'] ?? null
                ),
                'updated' => new TableRow(
                    Carbon::make($item['updated'] ?? '')->format('d.m.Y H:i')
                ),
                'owner' => new TableRow(
                    $owner['name'] ?? null,
                    $owner ?? null
                ),
                'group' => new TableRow(
                    $groups['name'] ?? null,
                        $groups ?? null
                )
            ];
        }

        krsort($result);

        return $result;
    }

    private function get(Enums\Entity $entity, ?string $href)
    {
        return $this->entityManager->get($entity)[MetaHref::cutId($href)] ?? null;
    }
}
