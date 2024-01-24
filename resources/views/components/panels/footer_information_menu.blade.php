@props(['menu'])
<nav>
    <ul class="bullet-list-item">
        @foreach ($menu as $item)
            <li><a class="@if (request()->routeIs($item['path'])) text-orange cursor-default @else text-gray-600 hover:text-orange @endif" href="{{ route($item['path']) }}">{{ $item['title'] }}</a></li>
        @endforeach
    </ul>
</nav>
