<x-layouts.clearInner
    page-title="Подтверждение почты"
    title="Подтверждение почты"
>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Отправлена ссылка для подтверждения регистрации.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-panels.fields.submit-button title="Отправить ссылку заново"/>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-panels.fields.submit-button title="Выйти"/>
        </form>
    </div>
</x-guest-layout>
