<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\ArticlesRepositoryContract;
use App\Contracts\Services\ArticleRemoverSerivceContract;
use App\Contracts\Services\TagsSynchronizerServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\TagsRequest;
use App\Models\Article;
use App\Services\UpdateArticleService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ArticlesRepositoryContract $articleRepository): Factory|View|Application
    {
        $this->authorize('viewAny', Article::class);

        $articles = $articleRepository->get(relations: ['tags', 'image']);

        return view('pages.admin.articles', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Article::class);

        return view('pages.admin.admin_article_form', ['article' => new Article()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ArticleRequest $request,
        TagsRequest $tagsRequest,
        ArticlesRepositoryContract $articleRepository,
        TagsSynchronizerServiceContract $tagsSynchronizer
    ): RedirectResponse {
        $this->authorize('create', Article::class);

        $data = $request->only(['title', 'description', 'body']);
        $data['published_at'] = ((bool) $request['published_at']) ? now() : null;
        $data['slug'] = uniqid($data['title']);
        $data['image'] = $request->file('image');

        $article = $articleRepository->create($data);

        $tagsSynchronizer->sync(collect($tagsRequest->get('tags', [])), $article);

        return redirect()
            ->route('admin.articles.index')
            ->with('success_messages', ['Новость успешно создана'])
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $article, ArticlesRepositoryContract $articleRepository): Factory|View|Application
    {
        $article = $articleRepository->findById($article, relations: ['tags', 'image']);

        return view('pages.article', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $article, ArticlesRepositoryContract $articleRepository): Factory|View|Application
    {
        $article = $articleRepository->findById($article, relations: ['tags']);

        $this->authorize('update', $article);

        return view('pages.admin.admin_article_edit_form', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ArticleRequest $request,
        TagsRequest $tagsRequest,
        int $article,
        ArticlesRepositoryContract $articleRepository,
        UpdateArticleService $updateArticleService,
        TagsSynchronizerServiceContract $tagsSynchronizer
    ): RedirectResponse {
        $data = $request->only(['title', 'description', 'body']);
        $data['published_at'] = ((bool) $request['published_at']) ? now() : null;
        $data['slug'] = uniqid($data['title']);
        $data['image'] = $request->file('image');

        $article = $articleRepository->findById($article);

        $this->authorize('update', $article);

        $updateArticleService->update($article, $data);

        $tagsSynchronizer->sync(collect($tagsRequest->get('tags', [])), $article);

        return redirect()
        ->route('admin.articles.index')
        ->with('success_messages', ['Новость успешно обновлена'])
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $article, ArticlesRepositoryContract $articleRepository, ArticleRemoverSerivceContract $articleRemoverSerivce)
    {
        $article = $articleRepository->findById($article);

        $this->authorize('delete', $article);

        $articleRemoverSerivce->delete($article->id);

        return redirect()
        ->route('admin.articles.index')
        ->with('success_messages', ['Новость успешно удалена'])
        ;
    }
}
