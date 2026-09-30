<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    /**
     * Display a listing of the sections.
     */
    public function index(): View
    {
        $sections = Section::ordered()->withCount('products')->get();

        return view('admin.sections.index', ['sections' => $sections]);
    }

    /**
     * Show the form for creating a new section.
     */
    public function create(): View
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created section.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'slug' => 'nullable|string|max:150|unique:sections,slug',
            'icon' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
            'banner_image' => 'nullable|string|max:500',
            'banner_file' => 'nullable|image|max:5120',
            'accent_color' => 'nullable|string|max:30',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);

        $bannerImage = $validated['banner_image'] ?? null;
        if ($request->hasFile('banner_file')) {
            $bannerPath = $request->file('banner_file')->store('sections', 'public');
            $bannerImage = '/storage/'.$bannerPath;
        }

        Section::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'icon' => $validated['icon'] ?? 'cube',
            'badge' => $validated['badge'] ?? null,
            'description' => $validated['description'] ?? null,
            'banner_image' => $bannerImage,
            'accent_color' => $validated['accent_color'] ?? '#007dfc',
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.sections.index')->with('success', 'Раздел успешно создан!');
    }

    /**
     * Show the form for editing the section.
     */
    public function edit(Section $section): View
    {
        return view('admin.sections.edit', ['section' => $section]);
    }

    /**
     * Update the specified section.
     */
    public function update(Request $request, Section $section): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'slug' => 'required|string|max:150|unique:sections,slug,'.$section->id,
            'icon' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
            'banner_image' => 'nullable|string|max:500',
            'banner_file' => 'nullable|image|max:5120',
            'accent_color' => 'nullable|string|max:30',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $bannerImage = $validated['banner_image'] ?? $section->banner_image;
        if ($request->hasFile('banner_file')) {
            $bannerPath = $request->file('banner_file')->store('sections', 'public');
            $bannerImage = '/storage/'.$bannerPath;
        }

        $section->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'icon' => $validated['icon'] ?? 'cube',
            'badge' => $validated['badge'] ?? null,
            'description' => $validated['description'] ?? null,
            'banner_image' => $bannerImage,
            'accent_color' => $validated['accent_color'] ?? '#007dfc',
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.sections.index')->with('success', 'Раздел успешно обновлен!');
    }

    /**
     * Remove the specified section.
     */
    public function destroy(Section $section): RedirectResponse
    {
        $section->delete();

        return redirect()->route('admin.sections.index')->with('success', 'Раздел удален.');
    }
}
