<nav class="order-1">
    <ul class="block lg:flex">
        <li class="group">
            <a class="inline-block p-4  @if ($selectedCategory(null)) text-orange @else text-black @endif font-bold border-l border-r border-transparent group-hover:text-orange group-hover:bg-gray-100 group-hover:border-l group-hover:border-r group-hover:border-gray-200 group-hover:shadow" href="{{route('catalog')}}">
                Каталог
            </a>
        </li>
        @foreach ($categories as $category)
        <li class="group">
            @if($category->children->isNotEmpty())
            <a class="inline-block p-4  @if ($selectedCategory($category)) text-orange @else text-black @endif font-bold border-l border-r border-transparent group-hover:text-orange group-hover:bg-gray-100 group-hover:border-l group-hover:border-r group-hover:border-gray-200 group-hover:shadow" href="{{route('catalog', ['slug' => $category])}}">
                {{$category->name}}
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
            <ul class="dropdown-navigation-submenu absolute hidden group-hover:block bg-white shadow-lg">
                @foreach ($category->children as $children)
                    <li><a class="block py-2 px-4   @if ($selectedCategory($children)) text-orange @else text-black @endif hover:text-orange hover:bg-gray-100" href="{{route('catalog', ['slug' => $children])}}">{{$children->name}}</a></li>
                @endforeach
            </ul>
            @else
            <li><a class="inline-block p-4  @if ($selectedCategory($category)) text-orange @else text-black @endif font-bold border-l border-r border-transparent group-hover:text-orange group-hover:bg-gray-100 group-hover:border-l group-hover:border-r group-hover:border-gray-200 group-hover:shadow" href="{{route('catalog', ['slug' => $category])}}">{{$category->name}}</a></li>
            @endif
        </li>
        @endforeach
        </ul>
</nav>
