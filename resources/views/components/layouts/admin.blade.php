<x-layouts.app page-title="{{$pageTitle}}">
    <x-slot:broadcast>
        @isset($boradcast)
            {{$boradcast}}
        @endisset
    </x-slot:broadcast>
    <x-slot:navigation-menu>
        <x-panels.admin.navigation_menu/>
    </x-slot:navigation-menu>
    <div class="p-4">
        <h1 class="text-black text-3xl font-bold mb-4">{{$title ?? ''}}</h1>

        <x-panels.messages.flashes/>

        {{$slot}}
    </div>
    <x-slot:footer-navigation>
    </x-slot:footer-navigation>
</x-layouts.app>
