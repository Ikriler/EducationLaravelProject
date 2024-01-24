@props(['articles'])
<div class="space-y-4">
    @foreach ($articles as $article)
        <x-panels.article_line_up :article="$article"/>
    @endforeach

    <div>
        {{$articles->onEachSide(1)->links()}}
    </div>
</div>
</div>
