<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of devlog & news items.
     */
    public function index(Request $request): View
    {
        $query = News::published();

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }

        $news = $query->paginate(6)->withQueryString();

        $categories = News::published()->pluck('category')->unique()->filter()->values();

        return view('client.news.index', [
            'news' => $news,
            'categories' => $categories,
            'currentCategory' => $request->query('category'),
        ]);
    }

    /**
     * Display the specified news/devlog article.
     */
    public function show(string $slug): View
    {
        $article = News::published()
            ->where('slug', $slug)
            ->with(['user', 'comments'])
            ->firstOrFail();

        $article->increment('views_count');

        $latestArticles = News::published()
            ->where('id', '!=', $article->id)
            ->take(3)
            ->get();

        return view('client.news.show', [
            'article' => $article,
            'latestArticles' => $latestArticles,
        ]);
    }
}
