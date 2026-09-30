<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Show products within a specific section (Level 2 Tile View).
     */
    public function section(Request $request, string $slug): View
    {
        $section = Section::active()->where('slug', $slug)->firstOrFail();

        $query = $section->products()->published();

        if ($request->filled('q')) {
            $search = $request->string('q')->trim();
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('tagline', 'like', "%{$search}%");
            });
        }

        if ($request->filled('version')) {
            $version = $request->string('version')->trim();
            $query->where('version_compatibility', 'like', "%{$version}%");
        }

        $sort = $request->input('sort', 'latest');
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'views') {
            $query->orderBy('views_count', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(9)->withQueryString();

        $allSections = Section::active()->ordered()->withCount(['products' => function ($q): void {
            $q->published();
        }])->get();

        return view('client.catalog.section', [
            'section' => $section,
            'products' => $products,
            'allSections' => $allSections,
        ]);
    }

    /**
     * Show single product presentation page (Level 3 Fab.com style).
     */
    public function product(string $section_slug, string $product_slug): View
    {
        $section = Section::active()->where('slug', $section_slug)->firstOrFail();

        $product = Product::published()
            ->where('section_id', $section->id)
            ->where('slug', $product_slug)
            ->with(['comments' => function ($query): void {
                $query->latest();
            }])
            ->firstOrFail();

        $product->increment('views_count');

        $relatedProducts = Product::published()
            ->where('section_id', $section->id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('client.catalog.show', [
            'section' => $section,
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
