<!doctype html>
<html class="antialiased" lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts')

    <title>Рога и Сила - {{$pageTitle ?? 'Главная страница'}}</title>
    <link href="/assets/favicon.ico" rel="shortcut icon" type="image/x-icon">
</head>
<body class="bg-white text-gray-600 font-sans leading-normal text-base tracking-normal flex min-h-screen flex-col">
<div class="wrapper flex flex-1 flex-col">
    <x-panels.header :currentCategory="$currentCategory ?? null">
        @isset($headerLogo)
            <x-slot:header-logo>
                {{$headerLogo}}
            </x-slot:header-logo>
        @endisset

        @isset($navigationMenu)
            <x-slot:navigation-menu>
                {{$navigationMenu}}
            </x-slot:navigation-menu>
        @endisset
    </x-panels.header>

    <x-breadcrumbs/>

    <main class="flex-1 container mx-auto bg-white">
        {{$slot}}
    </main>

    <x-panels.footer>
        @isset($footerNavigation)
            <x-slot:footer-navigation>
                {{$footerNavigation}}
            </x-slot:footer-navigation>
        @endisset
    </x-panels.footer>
</div>

</body>
</html>
