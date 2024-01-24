<x-layouts.admin page-title="Форма создания новости" title="Форма создания новости">

    <x-panels.messages.form_validation_errors/>

    <form method="POST" action="{{route('admin.articles.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="mt-8 max-w-md">
            <div class="grid grid-cols-1 gap-6">

                @include('pages.admin.article_form_body', ['article' => $article])

                <div class="block">
                    <button class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                        Сохранить
                    </button>
                    <a href="{{route('admin.articles.index')}}" class="inline-block bg-gray-400 hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                        Отменить
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
