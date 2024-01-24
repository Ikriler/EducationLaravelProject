<x-layouts.inner page-title="Салоны" title="Салоны">
    <x-slot:broadcast>
        <nav class="container mx-auto bg-gray-100 py-1 px-4 text-sm flex items-center space-x-2">
            <a class="hover:text-orange" href="index.html">Главная</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-3 w-3 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
            </svg>
            <span>Салоны</span>
        </nav>
    </x-slot:broadcast>

    <div class="space-y-4 max-w-4xl">
        <x-panels.left-rigth-salons :salons="$salons"/>
    </div>

    <div class="my-4 space-y-4 max-w-4xl">
        <hr>

        <p class="text-black text-2xl font-bold mb-4">Салоны на карте</p>

        <div class="bg-gray-200">
            Карта с салонами
        </div>
    </div>
</x-layouts.inner>
