<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Show the landing page with section tiles and featured Fab products.
     */
    public function index(): View
    {
        $sections = Section::active()
            ->ordered()
            ->withCount(['products' => function ($query): void {
                $query->published();
            }])
            ->get();

        $featuredProducts = Product::published()
            ->featured()
            ->with('section')
            ->latest()
            ->take(6)
            ->get();

        $latestNews = News::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('client.home', [
            'sections' => $sections,
            'featuredProducts' => $featuredProducts,
            'latestNews' => $latestNews,
        ]);
    }
}
