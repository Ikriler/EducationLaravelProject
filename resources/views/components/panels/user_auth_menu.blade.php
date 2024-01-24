<nav class="flex sm:justify-end sm:items-center flex-col sm:flex-row space-y-2 md:space-y-0 sm:space-x-8 text-sm">
        <a class="text-gray-500 hover:text-orange flex items-center space-x-1" href="{{route('basket')}}">
            <x-icons.basket class="inline-block text-orange h-4 w-4" />
            <span>{{auth()->user()?->basket->count()}}</span>
        </a>
        <a class="text-black hover:text-orange flex items-center space-x-1" href="#">
            <x-icons.people-in-circle class="inline-block text-orange h-4 w-4"/>
            <span class="inline-block font-bold">{{auth()->user()?->name}}</span>
        </a>
        <a class="text-gray-500 hover:text-orange flex items-center space-x-1" href="{{route('account')}}">
            <x-icons.house class="inline-block text-orange h-4 w-4" />
            <span>Личный кабинет</span>
        </a>
        <a class="text-gray-500 hover:text-orange flex items-center space-x-1" href="{{route('admin.admin')}}">
            <x-icons.admin class="inline-block text-orange h-4 w-4"/>
            <span>Админка</span>
        </a>
        <form method="post" action="{{route('logout')}}" class="inline-block">
            @csrf
            <button type="submit" class="text-gray-500 hover:text-orange flex items-center space-x-1">
            <x-icons.exit class="inline-block text-orange h-4 w-4"/>
            <span>Выйти</span>
            </button>
        </form>
    </nav>
