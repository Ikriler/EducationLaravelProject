<x-layouts.clearInner
    page-title="Авторизация"
    title="Авторизация"
>
    @if(session('status'))
    <x-panels.messages.success_message :messages="(array) session('status')"/>
    @endif

    <x-panels.messages.form_validation_errors/>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mt-8 max-w-md">
            <div class="grid grid-cols-1 gap-6">
                <!-- Email Address -->

                <x-forms.concrete-froms-fields.auth.email/>

                <!-- Password -->

                <x-forms.concrete-froms-fields.auth.password/>

                <!-- Remember Me -->

                <x-panels.fields.checkbox name="remember" title="Запомнить меня"/>

                <div class="flex items-center justify-start mt-3">
                    <x-panels.fields.submit-button title="Войти"/>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2" href="{{route('password.request')}}">
                            Забыли пароль?
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </form>
</x-layouts.clearInner>
