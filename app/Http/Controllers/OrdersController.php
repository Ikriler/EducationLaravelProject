<?php

namespace App\Http\Controllers;

use App\Contracts\Services\OrdersServiceContract;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function store(
        Request $request,
        OrdersServiceContract $ordersService
    )
    {
        $basket = auth()->user()->basket;

        $ordersService->create($basket);

        return redirect()->route('account');
    }
}
