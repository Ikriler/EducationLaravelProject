<x-layouts.app page-title="Главная страница">
    @push('styles')
        <link href="/assets/css/main_page_template_styles.css" rel="stylesheet">
    @endpush

    <x-slot:header-logo>
        <span class="inline-block sm:inline">
            <img src="/assets/images/logo.png" width="222" height="30" alt="">
        </span>
    </x-slot:header-logo>

    <x-banners :banners="$banners"/>

    <x-panels.cars_list :cars="$cars"/>

    <x-panels.articles :articles="$articles"/>

</x-layouts.app>



