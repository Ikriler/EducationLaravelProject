<ul class="flex justify-center sm:justify-end items-center space-x-8 text-sm">
    <li>
        <a class="text-gray-500 hover:text-orange flex items-center space-x-1" href="{{route('register')}}">
            <x-icons.user class="inline-block text-orange h-4 w-4"/>
            <span>Регистрация</span>
        </a>
    </li>
    <li>
        <a class="text-gray-500 hover:text-orange flex items-center space-x-1" href="{{route('login')}}">
            <x-icons.lock class="inline-block text-orange h-4 w-4"/>
            <span>Авторизация</span>
        </a>
    </li>
</ul>
