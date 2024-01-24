<x-layouts.admin page-title="Управление сайтом" title="Управление сайтом">
    <section class="pb-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="bg-white w-full border border-gray-100 rounded overflow-hidden shadow-lg hover:shadow-2xl pt-4">
                <a class="flex w-full h-40 text-orange justify-center hover:opacity-75" href="{{route('admin.cars.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                </a>
                <div class="px-6 py-4 text-center">
                    <div class="text-black font-bold text-xl mb-2"><a class="hover:text-orange" href="{{route('admin.cars.index')}}">Управление моделями</a></div>
                </div>
            </div>
            <div class="bg-white w-full border border-gray-100 rounded overflow-hidden shadow-lg hover:shadow-2xl pt-4">
                <a class="flex w-full h-40 text-orange justify-center hover:opacity-75" href="{{route('admin.articles.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </a>
                <div class="px-6 py-4 text-center">
                    <div class="text-black font-bold text-xl mb-2"><a class="hover:text-orange" href="{{route('admin.articles.index')}}">Управление новостями</a></div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.admin>
