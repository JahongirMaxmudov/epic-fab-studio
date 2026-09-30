<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of news articles.
     */
    public function index(): View
    {
        $articles = News::latest()->paginate(15);

        return view('admin.news.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new article.
     */
    public function create(): View
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created article.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'slug' => 'nullable|string|max:250|unique:news,slug',
            'category' => 'nullable|string|max:100',
            'excerpt' => 'required|string|max:500',
            'featured_image' => 'nullable|string|max:500',
            'featured_image_file' => 'nullable|image|max:5120',
            'blocks_json' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);

        $featuredImage = $validated['featured_image'] ?? null;
        if ($request->hasFile('featured_image_file')) {
            $path = $request->file('featured_image_file')->store('news', 'public');
            $featuredImage = '/storage/'.$path;
        }

        $blocks = [];
        if (! empty($validated['blocks_json'])) {
            $decoded = json_decode($validated['blocks_json'], true);
            if (is_array($decoded)) {
                $blocks = $decoded;
            }
        }

        News::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'] ?? 'Обновления',
            'excerpt' => $validated['excerpt'],
            'featured_image' => $featuredImage,
            'blocks' => $blocks,
            'is_published' => $request->boolean('is_published', true),
            'published_at' => $request->boolean('is_published', true) ? now() : null,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Новость/Девлог успешно опубликована!');
    }

    /**
     * Show the form for editing the article.
     */
    public function edit(News $news): View
    {
        return view('admin.news.edit', ['article' => $news]);
    }

    /**
     * Update the specified article.
     */
    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:250',
            'slug' => 'required|string|max:250|unique:news,slug,'.$news->id,
            'category' => 'nullable|string|max:100',
            'excerpt' => 'required|string|max:500',
            'featured_image' => 'nullable|string|max:500',
            'featured_image_file' => 'nullable|image|max:5120',
            'blocks_json' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        $featuredImage = $validated['featured_image'] ?? $news->featured_image;
        if ($request->hasFile('featured_image_file')) {
            $path = $request->file('featured_image_file')->store('news', 'public');
            $featuredImage = '/storage/'.$path;
        }

        $blocks = $news->blocks ?? [];
        if (isset($validated['blocks_json'])) {
            $decoded = json_decode($validated['blocks_json'], true);
            if (is_array($decoded)) {
                $blocks = $decoded;
            }
        }

        $isPublished = $request->boolean('is_published');
        $publishedAt = $news->published_at;
        if ($isPublished && ! $publishedAt) {
            $publishedAt = now();
        }

        $news->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'category' => $validated['category'] ?? 'Обновления',
            'excerpt' => $validated['excerpt'],
            'featured_image' => $featuredImage,
            'blocks' => $blocks,
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Статья успешно обновлена!');
    }

    /**
     * Remove the specified article.
     */
    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Статья удалена.');
    }
}
