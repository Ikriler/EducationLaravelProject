@props([
    'salons' => []
])
@if (! $salons->isEmpty())
    @for ($i = 0; $i < count($salons); $i++)
        @if($i % 2 === 1)
            <div class="w-full flex justify-end bg-gray-100 p-4">
                <div class="px-4 flex flex-col justify-between leading-normal text-right">
                    <div class="mb-8">
                        <div class="text-black font-bold text-xl mb-2">{{$salons[$i]->name}}</div>
                        <div class="text-base space-y-2">
                            <p class="text-gray-400">{{$salons[$i]->address}}</p>
                            <p class="text-black">{{$salons[$i]->phone}}</p>
                            <p class="text-sm">Часы работы:<br> {{$salons[$i]->work_hours}}</p>
                        </div>
                    </div>
                </div>
                <div class="h-48 lg:h-auto w-32 xl:w-48 flex-none text-center rounded-lg overflow-hidden">
                    <img src="{{$salons[$i]->image}}" class="w-full h-full object-cover" alt="">
                </div>
            </div>
        @else
            <div class="w-full flex p-4">
                <div class="h-48 lg:h-auto w-32 xl:w-48 flex-none text-center rounded-lg overflow-hidden">
                    <img src="{{$salons[$i]->image}}" class="w-full h-full object-cover" alt="">
                </div>
                <div class="px-4 flex flex-col justify-between leading-normal">
                    <div class="mb-8">
                        <div class="text-black font-bold text-xl mb-2">{{$salons[$i]->name}}</div>
                        <div class="text-base space-y-2">
                            <p class="text-gray-400">{{$salons[$i]->address}}</p>
                            <p class="text-black">{{$salons[$i]->phone}}</p>
                            <p class="text-sm">Часы работы:<br> {{$salons[$i]->work_hours}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endfor
@else
<div>Салоны не были найдены. Попробуйте обновить страницу чуть позже.</div>
@endif
