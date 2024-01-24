<x-layouts.app page-title="Каталог" :currentCategory="$currentCategory">

    <div class="p-4">
        <h1 class="text-black text-3xl font-bold mb-4">Каталог</h1>

        <form class="my-4 border rounded p-4 space-y-4">
            <div class="block sm:flex space-y-2 sm:space-y-0 sm:space-x-4 w-full">
                <div class="flex space-x-2 items-center">
                    <label for="fieldFilterName" class="text-gray-700 font-bold">Модель:</label>
                    <input id="fieldFilterName" type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder=""
                    name="model"
                    value="{{request()->get('model', '')}}">
                </div>
                <div class="flex space-x-2 items-center">
                    <label for="fieldFilterPriceFrom" class="text-gray-700 font-bold whitespace-nowrap">Цена от:</label>
                    <input id="fieldFilterPriceFrom" type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder=""
                    name="price_from"
                    value="{{request()->get('price_from', '')}}">
                </div>
                <div class="flex space-x-2 items-center">
                    <label for="fieldFilterPriceTo" class="text-gray-700 font-bold whitespace-nowrap">Цена до:</label>
                    <input id="fieldFilterPriceTo" type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder=""
                    name="price_to"
                    value="{{request()->get('price_to', '')}}">
                </div>
                <div class="flex space-x-2 items-center">
                    <button class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <a href="{{route('catalog', ['slug' => $currentCategory])}}" class="inline-block bg-gray-400 hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
            </div>
            <hr>
            <div class="flex space-x-2 items-center">
                <div class="font-bold">Сортировать по:</div>
                <x-panels.catalog.catalog_sort_button name='order_price' label='Цене'/>
                <x-panels.catalog.catalog_sort_button name='order_model' label='Модели'/>
                {{-- <button class="flex items-center cursor-pointer hover:text-orange hover:no-underline hover:text-opacity-70 outline-none focus:outline-none">
                    Модели
                </button> --}}
            </div>
        </form>

        <x-panels.all_cars_list :cars="$cars"/>

        <div class="text-center mt-4">
            {{$cars->onEachSide(1)->links()}}
        </div>
    </div>

</x-layouts.app>

