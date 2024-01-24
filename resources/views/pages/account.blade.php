<x-layouts.without-column
    title="Личный кабинет"
    page-title="Личный кабинет"
>
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <h2 class="text-black text-xl font-bold mb-4">Список заказов</h2>
    @if($orders->isNotEmpty())
        <div class="pt-6 relative overflow-x-auto shadow-md sm:rounded-lg">
            <x-orders.orders-table :orders="$orders"/>
        </div>
    @else
        <span class="text-black text-xl text-center mb-4">У вас нет заказов</span>
        <div class="mt-4">
            <a class="inline-flex items-center text-orange hover:opacity-75" href="{{route('catalog')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
                К каталогу
            </a>
        </div>
    @endif
</div>

</x-layouts.without-column>
