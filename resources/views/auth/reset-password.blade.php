<x-layouts.clearInner
    page-title="Сброс пароля"
    title="Сброс пароля"
>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <x-forms.concrete-froms-fields.auth.email/>

        <!-- Password -->
        <x-forms.concrete-froms-fields.auth.password :withConfirmation="true"/>

        <div class="flex items-center justify-start mt-4">
            <x-panels.fields.submit-button title="Сбросить пароль"/>
        </div>
    </form>
</x-layouts.clearInner>
