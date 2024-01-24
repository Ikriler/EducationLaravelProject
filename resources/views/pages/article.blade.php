<x-layouts.inner page-title="{{$article->title}}" title="{{$article->title}}">

    <div class="space-y-4">

        <img src="{{$article->imageUrl}}" alt="" title="">

        <x-tags :tags="$article->tags"/>

        {!! $article->body !!}
    </div>

    <div class="mt-4">
        <a class="inline-flex items-center text-orange hover:opacity-75" href="{{route('articles')}}">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>
            К списку новостей
        </a>
    </div>
</x-layouts.inner>
