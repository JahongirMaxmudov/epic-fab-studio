@extends('layouts.app')

@section('title', \App\Models\Setting::get('author_name', 'Jahongir Maxmudov') . ' — Сайт-визитка & Unreal Engine Fab.com Creator')
@section('meta_description', \App\Models\Setting::get('author_bio'))

@section('content')
    <!-- CREATOR PROFILE / BUSINESS CARD HERO (САЙТ-ВИЗИТКА) -->
    <section class="relative pt-10 pb-16 md:pt-16 md:pb-24 overflow-hidden border-b border-white/5">
        <!-- Radial Cyber Spotlight Glow -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[650px] h-[400px] bg-gradient-to-tr from-blue-600/20 via-cyan-500/15 to-purple-600/10 rounded-full blur-[130px] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="rounded-3xl border border-white/10 bg-gradient-to-b from-[#11141e]/90 to-[#0a0c12]/90 backdrop-blur-2xl p-8 sm:p-12 shadow-2xl relative overflow-hidden">
                <!-- Background Accent Glow -->
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                    
                    <!-- Creator Avatar -->
                    <div class="relative flex-shrink-0 group">
                        <div class="w-32 h-32 sm:w-36 sm:h-36 rounded-3xl p-[2px] bg-gradient-to-br from-blue-500 via-cyan-400 to-purple-500 shadow-xl shadow-blue-500/25">
                            <img src="{{ \App\Models\Setting::get('author_avatar', 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=300&q=80') }}" alt="{{ \App\Models\Setting::get('author_name', 'Creator') }}" class="w-full h-full object-cover rounded-[22px]">
                        </div>
                        <span class="absolute -bottom-2 -right-2 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider font-tech bg-emerald-500 text-black shadow-md flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-black animate-pulse"></span>
                            Online
                        </span>
                    </div>

                    <!-- Creator Bio Info -->
                    <div class="space-y-4 text-center md:text-left flex-grow">
                        
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-bold font-tech uppercase tracking-wider bg-blue-500/10 text-cyan-300 border border-blue-500/30">
                                <i class="fa-solid fa-code text-[11px] mr-1"></i> {{ \App\Models\Setting::get('hero_badge', 'Unreal Engine 5 & Fab.com Creator') }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold font-tech uppercase tracking-wider bg-purple-500/10 text-purple-300 border border-purple-500/30">
                                C++ & Blueprint
                            </span>
                        </div>

                        <div>
                            <h1 class="text-3xl sm:text-5xl font-extrabold text-white font-tech uppercase tracking-tight">
                                {{ \App\Models\Setting::get('author_name', 'Jahongir Maxmudov') }}
                            </h1>
                            <p class="text-sm sm:text-base font-semibold text-blue-400 font-tech mt-1 uppercase tracking-wider">
                                {{ \App\Models\Setting::get('author_status', 'Unreal Engine 5 C++ Developer & Technical Artist') }}
                            </p>
                        </div>

                        <!-- Bio / Description -->
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl">
                            {{ \App\Models\Setting::get('author_bio', 'Привет! Я разработчик игровых механик, C++ плагинов и шейдеров для Unreal Engine 5. Здесь я делюсь своими проектами, официальными продуктами на Fab.com, обучающими роликами на YouTube и новостями разработки в Telegram.') }}
                        </p>

                        <!-- Social Channels Buttons -->
                        <div class="pt-4 flex flex-wrap items-center justify-center md:justify-start gap-3">
                            
                            @if(\App\Models\Setting::get('telegram_url'))
                                <a href="{{ \App\Models\Setting::get('telegram_url') }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2.5 rounded-xl font-bold text-xs uppercase font-tech tracking-wider text-white bg-sky-600 hover:bg-sky-500 shadow-md shadow-sky-600/30 flex items-center gap-2 transition-all hover:scale-105 active:scale-95">
                                    <i class="fa-brands fa-telegram text-base"></i> Telegram Канал
                                </a>
                            @endif

                            @if(\App\Models\Setting::get('youtube_url'))
                                <a href="{{ \App\Models\Setting::get('youtube_url') }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2.5 rounded-xl font-bold text-xs uppercase font-tech tracking-wider text-white bg-red-600 hover:bg-red-500 shadow-md shadow-red-600/30 flex items-center gap-2 transition-all hover:scale-105 active:scale-95">
                                    <i class="fa-brands fa-youtube text-base"></i> YouTube
                                </a>
                            @endif

                            @if(\App\Models\Setting::get('fab_store_url'))
                                <a href="{{ \App\Models\Setting::get('fab_store_url') }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2.5 rounded-xl font-bold text-xs uppercase font-tech tracking-wider text-white bg-blue-600 hover:bg-blue-500 shadow-md shadow-blue-600/30 flex items-center gap-2 transition-all hover:scale-105 active:scale-95">
                                    <i class="fa-solid fa-store text-sm text-cyan-300"></i> Мой Fab.com
                                </a>
                            @endif

                            @if(\App\Models\Setting::get('github_url'))
                                <a href="{{ \App\Models\Setting::get('github_url') }}" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2.5 rounded-xl font-bold text-xs uppercase font-tech tracking-wider text-slate-300 bg-white/5 hover:bg-white/10 hover:text-white border border-white/10 flex items-center gap-2 transition-all">
                                    <i class="fa-brands fa-github text-base"></i> GitHub
                                </a>
                            @endif

                            @if(\App\Models\Setting::get('discord_url'))
                                <a href="{{ \App\Models\Setting::get('discord_url') }}" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2.5 rounded-xl font-bold text-xs uppercase font-tech tracking-wider text-indigo-300 bg-indigo-950/40 hover:bg-indigo-900/50 border border-indigo-500/30 flex items-center gap-2 transition-all">
                                    <i class="fa-brands fa-discord text-base"></i> Discord
                                </a>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- CUSTOM HOMEPAGE MODULAR BLOCKS (EDITABLE FROM ADMIN HOMEPAGE BUILDER) -->
    @if(!empty($homeBlocks) && count($homeBlocks) > 0)
        <section class="py-16 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-blocks.render :blocks="$homeBlocks" />
        </section>
    @endif

    <!-- SECTION: THE TILE SYSTEM ("ПЛИТКА" - МОИ РАЗДЕЛЫ НА FAB.COM) -->
    <section id="catalog-tiles" class="py-16 md:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative border-t border-white/5">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-wider font-tech mb-2">
                    <i class="fa-solid fa-shapes"></i> Плитка разделов
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white font-tech uppercase tracking-wide">
                    МОИ РАЗДЕЛЫ НА FAB.COM
                </h2>
                <p class="text-slate-400 text-sm mt-1 max-w-xl">
                    Выберите категорию, чтобы открыть плитку с плагинами, шейдерами или готовыми системами для Unreal Engine.
                </p>
            </div>
            <div class="text-xs text-slate-500 font-mono">
                Разделов: {{ $sections->count() }}
            </div>
        </div>

        <!-- The Section Tiles Grid (Level 1) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($sections as $sec)
                <a href="{{ route('catalog.section', $sec->slug) }}" class="group relative rounded-2xl p-6 bg-gradient-to-b from-[#10131d] to-[#0a0c12] border border-white/10 hover:border-blue-500/60 transition-all duration-300 flex flex-col justify-between overflow-hidden shadow-xl hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-blue-500/10">
                    
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

                    <!-- Footer of the Tile -->
                    <div class="mt-8 pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                        <span class="text-slate-400 font-medium flex items-center gap-1.5">
                            <i class="fa-solid fa-box-open text-blue-400"></i>
                            {{ $sec->products_count }} {{ trans_choice('продукт|продукта|продуктов', $sec->products_count) }}
                        </span>
                        
                        <span class="font-bold text-blue-400 group-hover:text-cyan-300 flex items-center gap-1 transition-colors uppercase tracking-wider text-[11px]">
                            Открыть
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </span>
                    </div>

                </a>
            @endforeach
        </div>
    </section>

    <!-- SECTION: FEATURED FAB.COM PRODUCTS SPOTLIGHT -->
    <section class="py-16 bg-[#0a0c12]/60 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-xs font-bold uppercase tracking-wider font-tech mb-2">
                        <i class="fa-solid fa-fire"></i> Fab.com Витрина
                    </div>
                    <h2 class="text-3xl font-extrabold text-white font-tech uppercase tracking-wide">
                        ИЗБРАННЫЕ ПЛАГИНЫ & ПРОЕКТЫ
                    </h2>
                    <p class="text-slate-400 text-sm mt-1">
                        Мои авторские разработки, доступные для загрузки и использования в Unreal Engine 5.
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

    <!-- SECTION: DEVLOG & NEWS UPDATES -->
    @if($latestNews->count() > 0)
        <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-bold uppercase tracking-wider font-tech mb-2">
                        <i class="fa-solid fa-code-commit"></i> Блог & Новости
                    </div>
                    <h2 class="text-3xl font-extrabold text-white font-tech uppercase tracking-wide">
                        ПОСЛЕДНИЕ СТАТЬИ И ДЕВЛОГИ
                    </h2>
                    <p class="text-slate-400 text-sm mt-1">
                        Новости о релизах плагинов, статьи по оптимизации шейдеров и технические заметки.
                    </p>
                </div>
                <a href="{{ route('news.index') }}" class="text-xs font-bold text-blue-400 hover:text-cyan-300 font-tech uppercase tracking-wider flex items-center gap-1">
                    Все статьи <i class="fa-solid fa-arrow-right"></i>
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
                                <a href="{{ route('news.show', $article->slug) }}" class="font-bold text-purple-400 group-hover:text-purple-300 flex items-center gap-1 font-tech uppercase tracking-wider text-[11px]">
                                    Читать <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
@endsection
