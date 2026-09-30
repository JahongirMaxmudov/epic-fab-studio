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
     * Show the settings page.
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
            'hero_title',
            'hero_subtitle',
            'fab_store_url',
            'discord_url',
            'youtube_url',
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
