@if (session()->has('error_messages'))
    <x-panels.messages.error_message :messages="(array)session('error_messages', [])"/>
@endif

@if (session()->has('success_messages'))
    <x-panels.messages.success_message :messages="(array)session('success_messages', [])"/>
@endif
