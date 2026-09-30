@extends('layouts.app')

@section('title', \App\Models\Setting::get('site_name', 'Epic Fab Studio') . ' — Плагины и ассеты для Unreal Engine 5')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-12 pb-20 md:pt-24 md:pb-32 overflow-hidden border-b border-white/5">
        <!-- Radial Spotlight Glow -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[450px] bg-gradient-to-tr from-blue-600/20 via-cyan-500/15 to-purple-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            
            <!-- Tech Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-slate-300 mb-6 backdrop-blur-md shadow-lg">
                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
                <span class="font-tech text-cyan-300 uppercase tracking-widest text-[11px]">Unreal Engine 5.3 — 5.5 Production Ready</span>
                <span class="text-slate-500">|</span>
                <span class="text-slate-300">Официально на Fab.com</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-white tracking-tight font-tech uppercase max-w-5xl mx-auto leading-none">
                {{ \App\Models\Setting::get('hero_title', 'ИНСТРУМЕНТЫ НОВОГО ПОКОЛЕНИЯ ДЛЯ UNREAL ENGINE 5') }}
            </h1>

            <!-- Subtitle -->
            <p class="mt-6 text-lg sm:text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed font-normal">
                {{ \App\Models\Setting::get('hero_subtitle', 'Авторские C++ плагины, фотореалистичные шейдеры Niagara и Nanite 3D ассеты с полной оптимизацией под современные консоли и ПК.') }}
            </p>

            <!-- CTA Buttons -->
            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#catalog-tiles" class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-500 shadow-xl shadow-blue-600/30 flex items-center justify-center gap-3 transition-all hover:scale-105 active:scale-95 text-base font-tech uppercase tracking-wider">
                    <i class="fa-solid fa-shapes"></i>
                    Исследовать разделы (Плитка)
                </a>

                <a href="{{ \App\Models\Setting::get('fab_store_url', 'https://www.fab.com') }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-slate-200 bg-[#0f1118] hover:bg-white/10 border border-white/10 hover:border-cyan-500/50 shadow-xl flex items-center justify-center gap-3 transition-all hover:scale-105 active:scale-95 text-base font-tech uppercase tracking-wider">
                    <i class="fa-solid fa-store text-cyan-400"></i>
                    Витрина на Fab.com
                </a>
            </div>

            <!-- Key Feature Metrics Counter -->
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto pt-10 border-t border-white/5">
                <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/5">
                    <div class="text-3xl font-extrabold text-white font-tech">UE 5.5</div>
                    <div class="text-xs text-slate-400 mt-1 uppercase font-semibold">Совместимость версий</div>
                </div>
                <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/5">
                    <div class="text-3xl font-extrabold text-cyan-400 font-tech">100% C++</div>
                    <div class="text-xs text-slate-400 mt-1 uppercase font-semibold">Исходный код включен</div>
                </div>
                <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/5">
                    <div class="text-3xl font-extrabold text-blue-400 font-tech">Nanite / Lumen</div>
                    <div class="text-xs text-slate-400 mt-1 uppercase font-semibold">Next-Gen технологии</div>
                </div>
                <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/5">
                    <div class="text-3xl font-extrabold text-amber-400 font-tech">5.0 ★</div>
                    <div class="text-xs text-slate-400 mt-1 uppercase font-semibold">Рейтинг разработчиков</div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 1: THE TILE SYSTEM ("ПЛИТКА" LEVEL 1) -->
    <section id="catalog-tiles" class="py-20 md:py-28 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-wider font-tech mb-2">
                    <i class="fa-solid fa-layer-group"></i> Уровень 1: Разделы
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white font-tech uppercase tracking-wide">
                    КАТЕГОРИИ АССЕТОВ & РАЗДЕЛЫ
                </h2>
                <p class="text-slate-400 text-sm sm:text-base mt-2 max-w-xl">
                    Выберите плитку интересующей категории для перехода в каталог продуктов с фильтрацией по версиям движка и тегам.
                </p>
            </div>
            <div class="text-xs text-slate-500 font-mono">
                Всего категорий: {{ $sections->count() }}
            </div>
        </div>

        <!-- The Section Tiles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($sections as $sec)
                <a href="{{ route('catalog.section', $sec->slug) }}" class="group relative rounded-2xl p-6 bg-gradient-to-b from-[#10131d] to-[#0a0c12] border border-white/10 hover:border-blue-500/60 transition-all duration-300 flex flex-col justify-between overflow-hidden shadow-xl hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-blue-500/10">
                    
                    <!-- Decorative subtle accent background glow -->
                    <div class="absolute -right-8 -top-8 w-32 h-32 rounded-full blur-2xl opacity-10 group-hover:opacity-30 transition-opacity" style="background-color: {{ $sec->accent_color ?? '#007dfc' }};"></div>

                    <div>
                        <!-- Top Icon & Badge -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-2xl group-hover:scale-110 group-hover:bg-blue-600/20 group-hover:border-blue-500/40 transition-all duration-300" style="color: {{ $sec->accent_color ?? '#007dfc' }};">
                                <i class="fa-solid fa-{{ $sec->icon ?? 'cube' }}"></i>
                            </div>

                            @if($sec->badge)
                                <span class="px-2.5 py-1 rounded-md text-[11px] font-bold font-tech uppercase tracking-wider bg-white/5 text-slate-300 border border-white/10 group-hover:border-blue-500/30 group-hover:text-cyan-300 transition-colors">
                                    {{ $sec->badge }}
                                </span>
                            @endif
                        </div>

                        <!-- Section Title -->
                        <h3 class="text-xl font-bold text-white font-tech group-hover:text-blue-400 transition-colors flex items-center gap-2">
                            {{ $sec->title }}
                            <i class="fa-solid fa-chevron-right text-xs opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all"></i>
                        </h3>

                        <!-- Section Description -->
                        <p class="mt-3 text-xs sm:text-sm text-slate-400 leading-relaxed line-clamp-3">
                            {{ $sec->description }}
                        </p>
                    </div>

                    <!-- Footer of the Tile: Product count + Button -->
                    <div class="mt-8 pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                        <span class="text-slate-400 font-medium flex items-center gap-1.5">
                            <i class="fa-solid fa-box-open text-blue-400"></i>
                            {{ $sec->products_count }} {{ trans_choice('продукт|продукта|продуктов', $sec->products_count) }}
                        </span>
                        
                        <span class="font-bold text-blue-400 group-hover:text-cyan-300 flex items-center gap-1 transition-colors uppercase tracking-wider text-[11px]">
                            Перейти
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </span>
                    </div>

                </a>
            @endforeach
        </div>
    </section>

    <!-- SECTION 2: FEATURED FAB.COM PRODUCTS SPOTLIGHT -->
    <section class="py-16 bg-[#0a0c12]/60 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-xs font-bold uppercase tracking-wider font-tech mb-2">
                        <i class="fa-solid fa-fire"></i> Fab.com Витрина
                    </div>
                    <h2 class="text-3xl font-extrabold text-white font-tech uppercase tracking-wide">
                        ПОПУЛЯРНЫЕ ПРОДУКТЫ & ПЛАГИНЫ
                    </h2>
                    <p class="text-slate-400 text-sm mt-1">
                        Проверенные решения студии для ускорения производства ваших проектов в UE5.
                    </p>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProducts as $product)
                    <div class="group rounded-2xl bg-[#0e1017] border border-white/10 hover:border-blue-500/50 transition-all duration-300 flex flex-col overflow-hidden shadow-xl hover:-translate-y-1 hover:shadow-2xl hover:shadow-blue-500/10">
                        
                        <!-- Thumbnail 16:9 -->
                        <a href="{{ route('catalog.product', ['section_slug' => $product->section->slug, 'product_slug' => $product->slug]) }}" class="relative aspect-video overflow-hidden bg-slate-900 block">
                            <img src="{{ $product->featured_image ?? 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            
                            <!-- Badges over Image -->
                            <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold font-tech uppercase tracking-wider bg-black/75 backdrop-blur-md text-cyan-300 border border-cyan-500/30">
                                    {{ $product->section->title }}
                                </span>
                            </div>

                            <div class="absolute top-3 right-3">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold font-tech uppercase tracking-wider bg-blue-600/90 backdrop-blur-md text-white">
                                    {{ $product->version_compatibility }}
                                </span>
                            </div>

                            @if($product->video_url)
                                <div class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-black/70 backdrop-blur-md flex items-center justify-center text-white text-xs border border-white/20">
                                    <i class="fa-solid fa-play"></i>
                                </div>
                            @endif
                        </a>

                        <!-- Card Body -->
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-white font-tech group-hover:text-blue-400 transition-colors line-clamp-1">
                                    <a href="{{ route('catalog.product', ['section_slug' => $product->section->slug, 'product_slug' => $product->slug]) }}">
                                        {{ $product->title }}
                                    </a>
                                </h3>

                                <p class="mt-2 text-xs sm:text-sm text-slate-400 line-clamp-2 leading-relaxed">
                                    {{ $product->tagline }}
                                </p>
                            </div>

                            <!-- Price & Actions -->
                            <div class="mt-6 pt-4 border-t border-white/5 flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] uppercase font-bold text-slate-500 block">Стоимость</span>
                                    <span class="text-xl font-extrabold text-white font-tech">
                                        {{ $product->price ? '$' . number_format($product->price, 2) : 'Бесплатно' }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('catalog.product', ['section_slug' => $product->section->slug, 'product_slug' => $product->slug]) }}" class="px-3.5 py-2 rounded-lg text-xs font-semibold bg-white/5 hover:bg-white/10 text-slate-300 transition-colors">
                                        Обзор
                                    </a>
                                    @if($product->fab_url)
                                        <a href="{{ $product->fab_url }}" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 rounded-lg text-xs font-bold bg-blue-600 hover:bg-blue-500 text-white transition-all shadow-md shadow-blue-600/30 flex items-center gap-1.5">
                                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Fab
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- SECTION 3: DEVLOG & NEWS UPDATES -->
    @if($latestNews->count() > 0)
        <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-bold uppercase tracking-wider font-tech mb-2">
                        <i class="fa-solid fa-code-commit"></i> DevLog & Инсайты
                    </div>
                    <h2 class="text-3xl font-extrabold text-white font-tech uppercase tracking-wide">
                        ПОСЛЕДНИЕ СТАТЬИ И ОБНОВЛЕНИЯ
                    </h2>
                    <p class="text-slate-400 text-sm mt-1">
                        Новости о релизах плагинов, статьи по оптимизации шейдеров и технические заметки.
                    </p>
                </div>
                <a href="{{ route('news.index') }}" class="text-xs font-bold text-blue-400 hover:text-cyan-300 font-tech uppercase tracking-wider flex items-center gap-1">
                    Все записи блога <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestNews as $article)
                    <article class="group rounded-2xl bg-[#0d0f16] border border-white/5 hover:border-purple-500/40 transition-all duration-300 overflow-hidden flex flex-col">
                        <a href="{{ route('news.show', $article->slug) }}" class="aspect-video relative overflow-hidden bg-slate-900 block">
                            <img src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            <span class="absolute top-3 left-3 px-2 py-0.5 rounded text-[10px] font-bold font-tech uppercase tracking-wider bg-black/80 backdrop-blur-md text-purple-300 border border-purple-500/30">
                                {{ $article->category }}
                            </span>
                        </a>

                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <div class="text-[11px] text-slate-500 font-mono mb-2">
                                    {{ $article->published_at ? $article->published_at->translatedFormat('d F Y') : 'Недавно' }}
                                </div>
                                <h3 class="text-base font-bold text-white group-hover:text-purple-400 transition-colors line-clamp-2">
                                    <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                                </h3>
                                <p class="mt-2 text-xs text-slate-400 line-clamp-3 leading-relaxed">
                                    {{ $article->excerpt }}
                                </p>
                            </div>

                            <div class="mt-6 pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                                <span class="text-slate-500 font-mono">
                                    <i class="fa-regular fa-eye mr-1"></i> {{ $article->views_count }}
                                </span>
                                <a href="{{ route('news.show', $article->slug) }}" class="font-bold text-purple-400 group-hover:text-purple-300 flex items-center gap-1">
                                    Читать <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <!-- SECTION 4: FAB.COM ECOSYSTEM BANNER -->
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-blue-500/20 bg-gradient-to-r from-blue-950/30 via-[#0e111a] to-blue-950/30 p-8 sm:p-12 relative overflow-hidden backdrop-blur-xl">
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-2xl">
                <span class="px-3 py-1 rounded text-xs font-bold font-tech uppercase tracking-wider bg-blue-500/20 text-cyan-300 border border-blue-500/30">
                    Официальная страница на Fab.com
                </span>
                <h2 class="mt-4 text-2xl sm:text-4xl font-extrabold text-white font-tech uppercase tracking-tight">
                    ПОЛУЧАЙТЕ АССЕТЫ НАПРЯМУЮ В EPIC GAMES LAUNCHER
                </h2>
                <p class="mt-3 text-sm text-slate-300 leading-relaxed">
                    Все наши разработки публикуются на Fab.com с мгновенной привязкой к вашей библиотеке Epic Games, автоматическими обновлениями и гарантией совместимости с последними версиями Unreal Engine.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ \App\Models\Setting::get('fab_store_url', 'https://www.fab.com') }}" target="_blank" class="px-6 py-3.5 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-500 shadow-lg shadow-blue-600/30 flex items-center gap-2 text-sm uppercase font-tech tracking-wider transition-all hover:scale-105">
                        <i class="fa-solid fa-store"></i> Перейти на Fab.com
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
