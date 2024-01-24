@props([
    'withConfirmation' => false
])
<!-- Password -->

<x-panels.fields.simple_text_input name="password" title="Пароль" placeholder="*********" type="password"/>

<!-- Confirm Password -->

@if ($withConfirmation)
    <x-panels.fields.simple_text_input name="password_confirmation" title="Подтверждение пароля" placeholder="*********" type="password"/>
@endif
