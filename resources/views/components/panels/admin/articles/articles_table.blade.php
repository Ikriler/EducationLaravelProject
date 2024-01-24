@props(['articles'])
<table class="border border-collapse w-full">
    <thead>
    <tr>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">id</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">Название новости</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">Краткое описание</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">Дата публикации</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">Теги</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">&nbsp;</th>
        <th class="border px-4 py-2 border-gray-600 bg-gray-200 font-bold">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
            <x-panels.admin.articles.article_in_table :article="$article"/>
        @endforeach
    </tbody>
</table>
