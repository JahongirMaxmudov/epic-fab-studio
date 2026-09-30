<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request): View
    {
        $query = Product::with('section');

        if ($request->filled('section_id')) {
            $query->where('section_id', $request->input('section_id'));
        }

        if ($request->filled('q')) {
            $search = $request->string('q')->trim();
            $query->where('title', 'like', "%{$search}%");
        }

        $products = $query->latest()->paginate(15)->withQueryString();
        $sections = Section::ordered()->get();

        return view('admin.products.index', [
            'products' => $products,
            'sections' => $sections,
        ]);
    }

    /**
     * Show the form for creating a new product with visual block builder.
     */
    public function create(): View
    {
        $sections = Section::ordered()->get();

        return view('admin.products.create', ['sections' => $sections]);
    }

    /**
     * Store a newly created product with visual builder blocks.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'title' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200|unique:products,slug',
            'tagline' => 'nullable|string|max:300',
            'fab_url' => 'nullable|url|max:500',
            'price' => 'nullable|numeric|min:0',
            'version_compatibility' => 'required|string|max:100',
            'featured_image' => 'nullable|string|max:500',
            'featured_image_file' => 'nullable|image|max:5120',
            'video_url' => 'nullable|string|max:500',
            'gallery_urls' => 'nullable|string',
            'blocks_json' => 'nullable|string',
            'is_published' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);

        $featuredImage = $validated['featured_image'] ?? null;
        if ($request->hasFile('featured_image_file')) {
            $path = $request->file('featured_image_file')->store('products', 'public');
            $featuredImage = '/storage/'.$path;
        }

        // Parse gallery images
        $galleryImages = [];
        if (! empty($validated['gallery_urls'])) {
            $galleryImages = array_filter(array_map('trim', explode("\n", $validated['gallery_urls'])));
        }
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $gPath = $file->store('products/gallery', 'public');
                $galleryImages[] = '/storage/'.$gPath;
            }
        }

        // Parse visual blocks
        $blocks = [];
        if (! empty($validated['blocks_json'])) {
            $decoded = json_decode($validated['blocks_json'], true);
            if (is_array($decoded)) {
                $blocks = $decoded;
            }
        }

        Product::create([
            'section_id' => $validated['section_id'],
            'title' => $validated['title'],
            'slug' => $slug,
            'tagline' => $validated['tagline'] ?? null,
            'fab_url' => $validated['fab_url'] ?? null,
            'price' => $validated['price'] ?? null,
            'version_compatibility' => $validated['version_compatibility'],
            'featured_image' => $featuredImage,
            'video_url' => $validated['video_url'] ?? null,
            'gallery_images' => array_values($galleryImages),
            'blocks' => $blocks,
            'is_published' => $request->boolean('is_published', true),
            'is_featured' => $request->boolean('is_featured', false),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Продукт успешно создан и опубликован!');
    }

    /**
     * Show the form for editing the product.
     */
    public function edit(Product $product): View
    {
        $sections = Section::ordered()->get();

        return view('admin.products.edit', [
            'product' => $product,
            'sections' => $sections,
        ]);
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'section_id' => 'required|exists:sections,id',
            'title' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:products,slug,'.$product->id,
            'tagline' => 'nullable|string|max:300',
            'fab_url' => 'nullable|url|max:500',
            'price' => 'nullable|numeric|min:0',
            'version_compatibility' => 'required|string|max:100',
            'featured_image' => 'nullable|string|max:500',
            'featured_image_file' => 'nullable|image|max:5120',
            'video_url' => 'nullable|string|max:500',
            'gallery_urls' => 'nullable|string',
            'blocks_json' => 'nullable|string',
            'is_published' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $featuredImage = $validated['featured_image'] ?? $product->featured_image;
        if ($request->hasFile('featured_image_file')) {
            $path = $request->file('featured_image_file')->store('products', 'public');
            $featuredImage = '/storage/'.$path;
        }

        // Gallery
        $galleryImages = $product->gallery_images ?? [];
        if (isset($validated['gallery_urls'])) {
            $galleryImages = array_filter(array_map('trim', explode("\n", $validated['gallery_urls'])));
        }
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $gPath = $file->store('products/gallery', 'public');
                $galleryImages[] = '/storage/'.$gPath;
            }
        }

        // Parse visual blocks
        $blocks = $product->blocks ?? [];
        if (isset($validated['blocks_json'])) {
            $decoded = json_decode($validated['blocks_json'], true);
            if (is_array($decoded)) {
                $blocks = $decoded;
            }
        }

        $product->update([
            'section_id' => $validated['section_id'],
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'tagline' => $validated['tagline'] ?? null,
            'fab_url' => $validated['fab_url'] ?? null,
            'price' => $validated['price'] ?? null,
            'version_compatibility' => $validated['version_compatibility'],
            'featured_image' => $featuredImage,
            'video_url' => $validated['video_url'] ?? null,
            'gallery_images' => array_values($galleryImages),
            'blocks' => $blocks,
            'is_published' => $request->boolean('is_published'),
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Продукт успешно обновлен!');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Продукт удален.');
    }
}
