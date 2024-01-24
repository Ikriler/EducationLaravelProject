<x-layouts.admin page-title="Форма редактирования модели" title="Форма редактирования модели">

    <x-panels.messages.form_validation_errors/>

    <form method="POST" action="{{route('admin.cars.update', ['car' => $car])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-8 max-w-md">
            <div class="grid grid-cols-1 gap-6">

                @include('pages.admin.car_form_body', ['car' => $car, 'carBodies' => $carBodies, 'carEngines' => $carEngines, 'carClasses' => $carClasses])

                <div class="block">
                    <button type="submit" class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                        Сохранить
                    </button>
                    <a href="{{route('admin.cars.index')}}" class="inline-block bg-gray-400 hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                        Отменить
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
