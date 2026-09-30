<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'commentable_type' => 'required|in:product,news',
            'commentable_id' => 'required|integer',
            'author_name' => 'required|string|max:100',
            'author_email' => 'nullable|email|max:150',
            'rating' => 'nullable|integer|min:1|max:5',
            'content' => 'required|string|max:2000',
        ]);

        $model = match ($validated['commentable_type']) {
            'product' => Product::published()->findOrFail($validated['commentable_id']),
            'news' => News::published()->findOrFail($validated['commentable_id']),
        };

        $model->allComments()->create([
            'author_name' => $validated['author_name'],
            'author_email' => $validated['author_email'] ?? null,
            'rating' => $validated['rating'] ?? 5,
            'content' => $validated['content'],
            'is_approved' => true,
        ]);

        return back()->with('success', 'Спасибо за ваш отзыв! Он успешно опубликован.');
    }
}
