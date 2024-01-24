<x-mail::message>
# Была создана новая статья

<b>Название новости:</b> <br>{{$article->title}}<br><br>
<b>Текст новости:</b> <br>{{$article->body}}<br><br>
<b>Тип события:</b> <br>created<br>

<x-mail::button :url="route('article', ['article' => $article], true)">
Перейти
</x-mail::button>

Спасибо,<br>
{{ config('app.name') }}
</x-mail::message>
