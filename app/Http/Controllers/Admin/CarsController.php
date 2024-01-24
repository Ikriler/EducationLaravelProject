<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\CarsRepositoryContract;
use App\Contracts\Services\CarRemoverSerivceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\CarBody;
use App\Models\CarClass;
use App\Models\CarEngine;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CarsRepositoryContract $carsRepository)
    {
        $cars = $carsRepository->get();

        return view('pages.admin.admin_cars', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carBodies = CarBody::get();
        $carEngines = CarEngine::get();
        $carClasses = CarClass::get();

        return view('pages.admin.admin_car_form', ['car' => new Car(), 'carBodies' => $carBodies, 'carEngines' => $carEngines, 'carClasses' => $carClasses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request, CarsRepositoryContract $carsRepository)
    {
        $data = $request->only([
            'name',
            'price',
            'old_price',
            'body',
            'salon',
            'kpp',
            'year',
            'color',
            'is_new',
            'car_class_id',
            'car_body_id',
            'car_engine_id'
        ]);

        $data['image'] = $request->file('image');

        $carsRepository->create($data);

        return redirect()
            ->route('admin.cars.index')
            ->with('success_messages', ['Модель успешно создана'])
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $car, CarsRepositoryContract $carsRepository)
    {
        $car = $carsRepository->findById($car, ['images', 'categories', 'carClass', 'carEngine', 'carBody', 'image']);

        return view('pages.detail', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $car, CarsRepositoryContract $carsRepository)
    {
        $carBodies = CarBody::get();
        $carEngines = CarEngine::get();
        $carClasses = CarClass::get();

        $car = $carsRepository->findById($car);

        return view('pages.admin.admin_car_edit_form', ['car' => $car, 'carBodies' => $carBodies, 'carEngines' => $carEngines, 'carClasses' => $carClasses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, Car $car, CarsRepositoryContract $carsRepository)
    {
        $data = $request->only([
            'name',
            'price',
            'old_price',
            'body',
            'salon',
            'kpp',
            'year',
            'color',
            'is_new',
            'car_class_id',
            'car_body_id',
            'car_engine_id',
        ]);

        $data['image'] = $request->file('image');

        if (isset($data['is_new'])) {
            $data['is_new'] = (bool) $data['is_new'];
        }
        else {
            $data['is_new'] = false;
        }

        $carsRepository->update($car, $data);

        return redirect()
        ->route('admin.cars.index')
        ->with('success_messages', ['Модель успешно обновлена'])
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $car, CarsRepositoryContract $carsRepository, CarRemoverSerivceContract $carRemoverSerivce)
    {
        $car = $carsRepository->findById($car);

        $carRemoverSerivce->delete($car->id);

        return redirect()
        ->route('admin.cars.index')
        ->with('success_messages', ['Модель успешно удалена'])
        ;
    }
}
