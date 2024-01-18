<?php

namespace App\Http\Controllers;

use App\Services\User;
use Illuminate\Http\Request;
use App\Services\MoySklad;

class StateController extends Controller
{
    /**
     * Обновление статуса заказа в МойСклад
     *
     * @param Request $request
     * @param string $uid
     * @param string $state
     * @return array
     */
    public function changeState(Request $request, string $uid, string $state)
    {
        $msManager = new MoySklad\Api\Manager(User::login(), User::pass());
        $entityManager = new MoySklad\Manager\Entity($msManager);

        $result = $entityManager->updateState($uid, $state);
        return [
            'success' => $result,
            'payload' => null
        ];
    }
}
