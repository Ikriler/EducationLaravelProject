@php
    $basket = auth()->user()->basket;
    $basketPositions = $basket->basketPositions;
@endphp

<x-layouts.without-column
    title="Корзина"
    page-title="Корзина"
>
@if ($basketPositions->isNotEmpty())
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <x-basket.basket-table :basketPositions="$basketPositions"/>
    </div>
    <div class="flex items-center pt-6">
        <span class="text-sm font-medium text-gray-400 mr-1">Общая сумма:</span>
        <span class="text-lg font-bold text-gray-800 "><x-panels.formatters.price_formatter :price="$basket->calculateAmount()"/></span>
    </div>
    <form class="pt-3 flex items-center justify-between" method="POST" action="{{route('orders.store')}}">
        @csrf
        <button type="submit" class="bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">Оформить заказ</button>
    </form>
@else
    <span class="text-black text-xl text-center mb-4">В Вашей корзине нет товаров</span>
    <div class="mt-4">
        <a class="inline-flex items-center text-orange hover:opacity-75" href="{{route('catalog')}}">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />-->
            </svg>
            К каталогу
        </a>
    </div>
@endif

</x-layouts.without-column>
