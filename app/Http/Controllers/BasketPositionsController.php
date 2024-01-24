<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Services\BasketPositionsServiceContract;
use App\Contracts\Services\BasketServiceContract;
use App\Http\Requests\BasketPositionCountRequest;
use Illuminate\Http\Request;

class BasketPositionsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(
        Request $request,
        CarsRepositoryContract $carsRepository,
        BasketServiceContract $basketService
    )
    {
        $requestData = $request->only([
            'car_id',
        ]);

        $car = $carsRepository->findById($requestData['car_id']);

        $basketService->addPosition($car->id, 1, $car->price, auth()->user()->basket->id);

        return redirect()->route('basket');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BasketPositionCountRequest $request,
        string $id,
        BasketPositionsServiceContract $basketPositionsService
    )
    {
        $count = $request->input('count');
        $id = (int) $id;
        $basket_id = auth()->user()->basket->id;

        $basketPositionsService->updateCount($count, $id, $basket_id);

        return redirect()->route('basket');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, BasketServiceContract $basketService)
    {
        $id = (int) $id;
        $basket_id = auth()->user()->basket->id;

        $basketService->removePosition($id, $basket_id);

        return redirect()->route('basket');
    }
}
