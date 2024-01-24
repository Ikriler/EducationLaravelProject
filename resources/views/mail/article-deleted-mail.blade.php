<x-mail::message>
# Была удалена статья

<b>Название новости:</b> <br>{{$article->title}}<br><br>
<b>Текст новости:</b> <br>{{$article->body}}<br><br>
<b>Тип события:</b> <br>deleted<br>

Спасибо,<br>
{{ config('app.name') }}
</x-mail::message>
