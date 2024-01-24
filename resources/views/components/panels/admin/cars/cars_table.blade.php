@props(['cars'])
<table class="border border-collapse w-full">
    <thead>
    <tr>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">id</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">Название модели</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">Цена с учетом скидки</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">Цена без скидки</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">Новинка</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">&nbsp;</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($cars as $car)
        <x-panels.admin.cars.car_in_table :car="$car" />
    @endforeach
    </tbody>
</table>
