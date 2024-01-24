@props(['name', 'label'])
@php
    $currentValue = request()->get($name);
    $nextValue = match ($currentValue) {
        'asc' => 'desc',
        'desc' => '',
        default => 'asc'
    }
@endphp

<input type="hidden" name="{{$name}}" value="{{$currentValue}}"/>
<button
name="{{$name}}"
value="{{$nextValue}}"
class="flex items-center @empty($currentValue) hover:text-orange @else text-orange underline @endempty cursor-pointer hover:no-underline hover:text-opacity-70 outline-none focus:outline-none">
    {{$label}}
    @if ($currentValue === 'asc')
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7l4-4m0 0l4 4m-4-4v18" />
    </svg>
    @endif
    @if ($currentValue === 'desc')
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16 17l-4 4m0 0l-4-4m4 4V3" />
     </svg>
    @endif
</button>
