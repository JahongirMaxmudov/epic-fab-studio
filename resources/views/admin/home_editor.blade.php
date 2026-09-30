@extends('layouts.admin')

@section('title', 'Редактор главной страницы (Визитка) — Epic Fab Studio')
@section('header_title', 'Редактор Главной (Сайт-визитка & Конструктор)')

@section('content')
<div class="max-w-5xl space-y-8">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white font-tech uppercase">Визитка & Конструктор Главной</h2>
            <p class="text-xs text-slate-400">Настройте информацию о себе, ссылки на соцсети (YouTube, Telegram, Fab.com) и соберите главную страницу из любых блоков.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 rounded-xl bg-blue-600/20 text-cyan-300 hover:bg-blue-600/30 border border-blue-500/30 text-xs font-bold uppercase font-tech tracking-wider flex items-center gap-1.5 transition-all">
            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Открыть сайт
        </a>
    </div>

    <form action="{{ route('admin.home_editor.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- 1. Creator Profile / Business Card Section -->
        <div class="rounded-2xl bg-[#0f121b] border border-white/5 p-6 space-y-6 shadow-xl">
            <div class="flex items-center justify-between border-b border-white/5 pb-3">
                <h3 class="text-base font-bold text-white font-tech uppercase flex items-center gap-2">
                    <i class="fa-solid fa-id-card text-blue-400"></i> Профиль создателя (Сайт-визитка)
                </h3>
                <span class="text-[11px] font-mono text-cyan-400 uppercase">Hero Spotlight</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                <div class="sm:col-span-6">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Ваше имя / Никнейм / Название студии</label>
                    <input type="text" name="author_name" value="{{ old('author_name', $settings['author_name'] ?? 'Jahongir Maxmudov') }}" placeholder="Например: Jahongir Maxmudov" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500 font-semibold">
                </div>

                <div class="sm:col-span-6">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Статус / Специализация</label>
                    <input type="text" name="author_status" value="{{ old('author_status', $settings['author_status'] ?? 'Unreal Engine 5 C++ Developer & Technical Artist') }}" placeholder="Unreal Engine 5 Developer & Fab.com Creator" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div class="sm:col-span-4">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Бейдж над заголовком</label>
                    <input type="text" name="hero_badge" value="{{ old('hero_badge', $settings['hero_badge'] ?? 'UE 5.3 — 5.5 Production Ready') }}" placeholder="GameDev & C++ Tools" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div class="sm:col-span-8">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Фото / Аватар (URL)</label>
                    <input type="text" name="author_avatar" value="{{ old('author_avatar', $settings['author_avatar'] ?? '') }}" placeholder="https://..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div class="sm:col-span-12">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">О себе / Приветствие / Чем делюсь</label>
                    <textarea name="author_bio" rows="3" placeholder="Привет! Я занимаюсь разработкой C++ плагинов, систем для Unreal Engine 5 и делюсь проектами на Fab.com, YouTube и в Telegram..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl p-3 text-sm text-slate-200 focus:outline-none focus:border-blue-500 leading-relaxed">{{ old('author_bio', $settings['author_bio'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- Social links -->
            <div class="pt-4 border-t border-white/5">
                <h4 class="text-xs font-bold text-slate-400 uppercase font-tech tracking-wider mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-share-nodes text-cyan-400"></i> Мои ссылки (YouTube, Telegram, Fab.com, Discord, GitHub)
                </h4>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 flex items-center gap-1.5">
                            <i class="fa-brands fa-telegram text-sky-400"></i> Telegram канал / контакт
                        </label>
                        <input type="url" name="telegram_url" value="{{ old('telegram_url', $settings['telegram_url'] ?? '') }}" placeholder="https://t.me/..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200 focus:outline-none focus:border-sky-400">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 flex items-center gap-1.5">
                            <i class="fa-brands fa-youtube text-red-500"></i> YouTube канал
                        </label>
                        <input type="url" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" placeholder="https://youtube.com/@..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200 focus:outline-none focus:border-red-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 flex items-center gap-1.5">
                            <i class="fa-solid fa-store text-cyan-400"></i> Fab.com страница
                        </label>
                        <input type="url" name="fab_store_url" value="{{ old('fab_store_url', $settings['fab_store_url'] ?? '') }}" placeholder="https://www.fab.com/sellers/..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200 focus:outline-none focus:border-cyan-400">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 flex items-center gap-1.5">
                            <i class="fa-brands fa-discord text-indigo-400"></i> Discord сервер
                        </label>
                        <input type="url" name="discord_url" value="{{ old('discord_url', $settings['discord_url'] ?? '') }}" placeholder="https://discord.gg/..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200 focus:outline-none focus:border-indigo-400">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 flex items-center gap-1.5">
                            <i class="fa-brands fa-github text-slate-300"></i> GitHub профиль
                        </label>
                        <input type="url" name="github_url" value="{{ old('github_url', $settings['github_url'] ?? '') }}" placeholder="https://github.com/..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200 focus:outline-none focus:border-white">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 flex items-center gap-1.5">
                            <i class="fa-solid fa-envelope text-emerald-400"></i> Email для связи
                        </label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" placeholder="contact@..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-200 focus:outline-none focus:border-emerald-400">
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Visual Modular Page Builder for the Homepage -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-white font-tech uppercase flex items-center gap-2">
                        <i class="fa-solid fa-cubes-stacked text-purple-400"></i> Блоки главной страницы (Конструктор)
                    </h3>
                    <p class="text-xs text-slate-400">Размещайте любые материалы: вступительные тексты, видео с YouTube, галереи скриншотов, кнопки и ссылки.</p>
                </div>
            </div>

            @include('admin.products._block_builder', ['initialBlocks' => $homeBlocks])
        </div>

        <!-- Save Button -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-white/5">
            <button type="submit" class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-xs font-bold uppercase font-tech tracking-wider shadow-lg shadow-blue-500/30 transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Сохранить главную страницу
            </button>
        </div>

    </form>

</div>
@endsection
