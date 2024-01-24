<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\CarsRepositoryContract;
use App\DTO\CarFilterCatalogDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateCarRequest;
use App\Http\Requests\Api\DeleteCarRequest;
use App\Http\Requests\Api\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Http\Resources\CreateCarResource;
use App\Http\Resources\CUDCarResource;
use App\Http\Resources\DeleteCarResource;
use App\Http\Resources\UpdateCarResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarsController extends Controller
{
    public function index(Request $request, CarsRepositoryContract $carsRepository)
    {
        $filter = new CarFilterCatalogDTO();

        $paginateCount = 16;
        $page = $request->get('page') ?? 1;

        $filter->setModel($request->get('model'));
        $filter->setPriceFrom($request->get('price_from'));
        $filter->setPriceTo($request->get('price_to'));
        $filter->setOrderModel($request->get('order_model'));
        $filter->setOrderPrice($request->get('order_price'));
        $filter->setPaginateCount($paginateCount);
        $filter->setPage($page);

        $cars = $carsRepository->getWithFilter($filter, ['image']);

        return CarResource::collection($cars);
    }

    public function store(CreateCarRequest $request, CarsRepositoryContract $carsRepository)
    {
        return new CUDCarResource($carsRepository->create($request->validated()));
    }

    public function show($id, CarsRepositoryContract $carsRepository)
    {
        return new CarResource($carsRepository->findById($id, ['image']));
    }

    public function update(UpdateCarRequest $request, $id, CarsRepositoryContract $carsRepository)
    {
        $car = $carsRepository->findById($id);

        return new CUDCarResource($carsRepository->update($car, $request->validated()));
    }

    public function destroy($id, CarsRepositoryContract $carsRepository)
    {
        $data = Validator::make(['id' => $id], (new DeleteCarRequest())->rules())->validate();

        $car = $carsRepository->findById($data['id']);

        return new CUDCarResource($carsRepository->delete($car));
    }
}
