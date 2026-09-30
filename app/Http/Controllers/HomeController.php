<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use App\Models\Section;
use App\Models\Setting;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Show the landing page with personal creator bio, custom blocks, and section tiles.
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

        // Custom modular blocks placed on the homepage by the creator
        $homeBlocks = [];
        $rawBlocks = Setting::get('home_blocks');
        if (! empty($rawBlocks)) {
            $decoded = json_decode($rawBlocks, true);
            if (is_array($decoded)) {
                $homeBlocks = $decoded;
            }
        }

        return view('client.home', [
            'sections' => $sections,
            'featuredProducts' => $featuredProducts,
            'latestNews' => $latestNews,
            'homeBlocks' => $homeBlocks,
        ]);
    }
}
