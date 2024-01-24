@props([
    'salons' => []
])
<div>
    <p class="inline-block text-3xl text-black font-bold mb-4">Наши салоны</p>
    <span class="inline-block pl-1"> / <a href="{{route('salons')}}" class="inline-block pl-1 text-gray-600 hover:text-orange"><b>Все</b></a></span>
</div>

<div class="grid gap-6 grid-cols-1 lg:grid-cols-2">
    @if (! $salons->isEmpty())
        @foreach ($salons as $salon)
        <div class="w-full flex">
            <div class="h-48 lg:h-auto w-32 xl:w-48 flex-none text-center rounded-lg overflow-hidden">
                <a class="block w-full h-full hover:opacity-75" href="salons.html"><img src="{{$salon->image}}" class="w-full h-full object-cover" alt=""></a>
            </div>
            <div class="px-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                    <div class="text-black font-bold text-xl mb-2">
                        <a class="hover:text-orange" href="salons.html">{{$salon->name}}</a>
                    </div>
                    <div class="text-base space-y-2">
                        <p class="text-gray-400">{{$salon->address}}</p>
                        <p class="text-black">{{$salon->phone}}</p>
                        <p class="text-sm">Часы работы:<br>{{$salon->work_hours}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div>Салоны не были найдены. Попробуйте обновить страницу чуть позже.</div>
    @endif
</div>
