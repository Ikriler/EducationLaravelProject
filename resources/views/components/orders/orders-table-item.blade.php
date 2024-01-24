@props([
    'order'
])
<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
        {{$order->id}}
    </td>
    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
        {{$order->count}}
    </td>
    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
        <x-panels.formatters.price_formatter :price="$order->amount"/>
    </td>
    @switch($order->status)
        @case(\App\Models\Order::NOT_PAYED)
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <div class="h-2.5 w-2.5 rounded-full bg-orange mr-2"></div> Не оплачен
                </div>
            </td>
        @break

        @case(\App\Models\Order::PAYED)
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> Оплачен
                </div>
            </td>
        @break

        @default
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div> Ошибка оплаты
                </div>
            </td>
    @endswitch
</tr>
