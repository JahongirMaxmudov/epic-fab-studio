<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\News;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard with stats and recent activities.
     */
    public function index(): View
    {
        $stats = [
            'products_count' => Product::count(),
            'sections_count' => Section::count(),
            'news_count' => News::count(),
            'comments_count' => Comment::count(),
            'total_views' => Product::sum('views_count') + News::sum('views_count'),
        ];

        $recentProducts = Product::with('section')->latest()->take(5)->get();
        $recentComments = Comment::latest()->take(5)->get();
        $recentNews = News::latest()->take(5)->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'recentProducts' => $recentProducts,
            'recentComments' => $recentComments,
            'recentNews' => $recentNews,
        ]);
    }
}
