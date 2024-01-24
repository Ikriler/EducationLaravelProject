<x-layouts.clearInner
    page-title="Восстановление пароля"
    title="Восстановление пароля"
>

    <!-- Session Status -->
    @if(session('status'))
    <x-panels.messages.success_message :messages="(array) session('status')"/>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <x-forms.concrete-froms-fields.auth.email/>

        <div class="flex items-center justify-start mt-4">
            <x-panels.fields.submit-button title="Ссылка для восстановления пароля"/>
        </div>
    </form>
</x-layouts.clearInner>
