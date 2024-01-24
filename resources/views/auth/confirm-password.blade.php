<x-layouts.clearInner
    page-title="Подтверждение пароля"
    title="Подтверждение пароля"
>
<x-panels.messages.form_validation_errors/>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <x-forms.concrete-froms-fields.auth.password/>

        <div class="flex justify-start mt-4">
            <x-panels.fields.submit-button title="Подтвердить"/>
        </div>
    </form>
</x-layouts.clearInner>
