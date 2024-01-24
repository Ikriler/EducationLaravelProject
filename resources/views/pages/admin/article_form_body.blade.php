<x-panels.fields.simple_text_input name="title" title="Название новости" placeholder="Парадигма просветляет архетип" type="text" :object="$article" :value="$article->title"/>

<x-panels.fields.checkbox name="published_at" title="Опубликовано" :object="$article"/>

<x-panels.fields.image name="image" title="Изображение новости" :value="$article->image" :src="$article->imageUrl"/>

<x-panels.fields.simple_text_input name="description" title="Краткое описание" placeholder="Парадигма просветляет архетип, таким образом, стратегия поведения, выгодная отдельному человеку" type="text" :object="$article" :value="$article->description"/>

<x-panels.fields.textarea name="body" title="Текст новости" rows="16" :object="$article"/>

<x-panels.fields.simple_text_input name="tags"
                                title="Теги"
                                placeholder="Парадигма, Архетип, Киа Seed"
                                type="text"
                                :object="$article"
                                :value="$article->tags->pluck('name')->implode(',')"/>

{{-- <div class="block">
    <label for="fieldArticleTags" class="text-gray-700 font-bold">Теги</label>
    <input
        id="fieldArticleTags"
        type="text"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        placeholder="Парадигма, Архетип, Киа Seed"
    >
</div> --}}

{{-- <div class="block">
    <label for="field2" class="text-gray-700 font-bold">Пример поля с ошибкой валидации</label>
    <input id="field2" type="text" class="mt-1 block w-full rounded-md border-red-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="">
    <span class="text-xs italic text-red-600">Поле не заполнено</span>
</div> --}}
