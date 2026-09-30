@extends('layouts.admin')

@section('title', 'Настройки сайта — Epic Fab Studio')
@section('header_title', 'Конфигурация сайта & Брендинг')

@section('content')
<div class="max-w-4xl space-y-6">

    <div>
        <h2 class="text-xl font-bold text-white font-tech uppercase">Настройки студии</h2>
        <p class="text-xs text-slate-400">Управляйте названиями, ссылками на магазин Fab.com, соцсетями и контактами.</p>
    </div>

    <div class="rounded-2xl bg-[#0f121b] border border-white/5 p-6 shadow-xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Branding -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold text-blue-400 uppercase font-tech tracking-wider border-b border-white/5 pb-2">
                    Брендинг и названия
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Название студии / Сайта</label>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'EPIC FAB STUDIO') }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Email поддержки</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? 'support@epicfabstudio.dev') }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Краткий слоган в шапке / футере</label>
                        <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Hero Section Text -->
            <div class="space-y-4 pt-4">
                <h3 class="text-xs font-bold text-cyan-400 uppercase font-tech tracking-wider border-b border-white/5 pb-2">
                    Главный экран (Hero на лендинге)
                </h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Главный заголовок</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Подзаголовок / Описание</label>
                        <textarea name="hero_subtitle" rows="3" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500 leading-relaxed">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Links to Fab & Socials -->
            <div class="space-y-4 pt-4">
                <h3 class="text-xs font-bold text-purple-400 uppercase font-tech tracking-wider border-b border-white/5 pb-2">
                    Ссылки на маркетплейс и сообщества
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Fab.com Store URL</label>
                        <input type="url" name="fab_store_url" value="{{ old('fab_store_url', $settings['fab_store_url'] ?? '') }}" placeholder="https://www.fab.com/sellers/..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Discord Server URL</label>
                        <input type="url" name="discord_url" value="{{ old('discord_url', $settings['discord_url'] ?? '') }}" placeholder="https://discord.gg/..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">YouTube Канал URL</label>
                        <input type="url" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" placeholder="https://youtube.com/@..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-white/5 flex items-center justify-end">
                <button type="submit" class="px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold uppercase font-tech tracking-wider shadow-lg shadow-blue-600/30 transition-all hover:scale-105 active:scale-95">
                    Сохранить настройки
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
