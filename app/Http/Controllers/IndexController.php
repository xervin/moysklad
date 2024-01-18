<?php

namespace App\Http\Controllers;

use App\Services\User;
use Illuminate\Http\Request;
use App\Services\MoySklad;

class IndexController extends Controller
{
    private MoySklad\Manager\Order $orderManager;
    private MoySklad\Manager\Entity $entityManager;

    public function __construct() {}

    public function index(Request $request)
    {
        $msManager = new MoySklad\Api\Manager(User::login(), User::pass());
        $this->orderManager = new MoySklad\Manager\Order($msManager);
        $this->entityManager = new MoySklad\Manager\Entity($msManager);

        $states = $this->entityManager->get(MoySklad\Enums\Entity::states); // Список статусов
        $orders = $this->orderManager->listByBuyers(); // Заказы

        return view('index', [
            'rows' => $orders,
            'states' => $states,
        ]);
    }
}
