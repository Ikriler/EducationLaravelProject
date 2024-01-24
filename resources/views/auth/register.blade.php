<x-layouts.clearInner
    page-title="Регистрация"
    title="Регистрация"
>

    <x-panels.messages.form_validation_errors/>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mt-8 max-w-md">
            <div class="grid grid-cols-1 gap-6">
                <!-- Name -->

                <x-panels.fields.simple_text_input name="name" title="ФИО" placeholder="ФИО" type="text"/>

                <!-- Email Address -->

                <x-forms.concrete-froms-fields.auth.email/>

                <!-- Password -->

                <x-forms.concrete-froms-fields.auth.password :withConfirmation="true"/>


                <div class="flex items-center justify-start mt-3">
                    <x-panels.fields.submit-button title="Регистрация"/>
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2" href="{{ route('login') }}">
                        Уже зарегистрировались?
                    </a>
                </div>
            </div>
        </div>

    </form>

</x-layouts.clearInner>
