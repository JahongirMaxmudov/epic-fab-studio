<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show the dedicated Homepage & Creator Bio Editor.
     */
    public function homeEditor(): View
    {
        $settings = Setting::all()->pluck('value', 'key');

        $homeBlocks = [];
        if (! empty($settings['home_blocks'])) {
            $decoded = json_decode($settings['home_blocks'], true);
            if (is_array($decoded)) {
                $homeBlocks = $decoded;
            }
        }

        return view('admin.home_editor', [
            'settings' => $settings,
            'homeBlocks' => $homeBlocks,
        ]);
    }

    /**
     * Update the homepage visual builder and creator profile.
     */
    public function updateHomeEditor(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'author_name' => 'nullable|string|max:150',
            'author_status' => 'nullable|string|max:200',
            'author_bio' => 'nullable|string|max:2000',
            'author_avatar' => 'nullable|string|max:500',
            'author_avatar_file' => 'nullable|image|max:5120',
            'hero_badge' => 'nullable|string|max:100',
            'telegram_url' => 'nullable|url|max:500',
            'youtube_url' => 'nullable|url|max:500',
            'fab_store_url' => 'nullable|url|max:500',
            'discord_url' => 'nullable|url|max:500',
            'github_url' => 'nullable|url|max:500',
            'contact_email' => 'nullable|email|max:150',
            'blocks_json' => 'nullable|string',
        ]);

        $avatar = $validated['author_avatar'] ?? Setting::get('author_avatar');
        if ($request->hasFile('author_avatar_file')) {
            $path = $request->file('author_avatar_file')->store('profile', 'public');
            $avatar = '/storage/'.$path;
        }

        $fields = [
            'author_name' => $validated['author_name'] ?? '',
            'author_status' => $validated['author_status'] ?? '',
            'author_bio' => $validated['author_bio'] ?? '',
            'author_avatar' => $avatar ?? '',
            'hero_badge' => $validated['hero_badge'] ?? 'Unreal Engine 5 & Fab.com Creator',
            'telegram_url' => $validated['telegram_url'] ?? '',
            'youtube_url' => $validated['youtube_url'] ?? '',
            'fab_store_url' => $validated['fab_store_url'] ?? '',
            'discord_url' => $validated['discord_url'] ?? '',
            'github_url' => $validated['github_url'] ?? '',
            'contact_email' => $validated['contact_email'] ?? '',
        ];

        foreach ($fields as $key => $val) {
            Setting::set($key, $val, 'profile');
        }

        if (isset($validated['blocks_json'])) {
            Setting::set('home_blocks', $validated['blocks_json'], 'homepage');
        }

        return back()->with('success', 'Главная страница и визитка успешно обновлены!');
    }

    /**
     * Show the general settings page.
     */
    public function index(): View
    {
        $settings = Setting::all()->pluck('value', 'key');

        return view('admin.settings.index', ['settings' => $settings]);
    }

    /**
     * Update application settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $fields = [
            'site_name',
            'site_tagline',
            'fab_store_url',
            'telegram_url',
            'discord_url',
            'youtube_url',
            'github_url',
            'contact_email',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        return back()->with('success', 'Настройки сайта успешно сохранены!');
    }
}
