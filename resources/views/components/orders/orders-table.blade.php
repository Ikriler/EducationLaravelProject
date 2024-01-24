@props([
    'orders'
])
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        <th scope="col" class="px-6 py-3 font-bold">
            Номер заказа
        </th>
        <th scope="col" class="px-6 py-3 font-bold">
            Товаров в заказе
        </th>
        <th scope="col" class="px-6 py-3 font-bold">
            Общая стоимость
        </th>
        <th scope="col" class="px-6 py-3 font-bold">
            Статус оплаты
        </th>
    </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <x-orders.orders-table-item :order="$order"/>
        @endforeach
    </tbody>
</table>
