@extends('layouts.app')

@section('title', $section->title . ' — Epic Fab Studio')
@section('meta_description', $section->description)

@section('content')
<div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1">
            <i class="fa-solid fa-home text-[10px]"></i> Главная
        </a>
        <span>/</span>
        <a href="{{ route('home') }}#catalog-tiles" class="hover:text-blue-400 transition-colors">Разделы</a>
        <span>/</span>
        <span class="text-slate-300 font-semibold">{{ $section->title }}</span>
    </nav>

    <!-- Section Spotlight Banner (Level 2 Header) -->
    <div class="relative rounded-3xl p-8 sm:p-12 border border-white/10 bg-gradient-to-br from-[#121520] via-[#0d0f17] to-[#08090d] shadow-2xl overflow-hidden mb-12">
        <!-- Accent Glow -->
        <div class="absolute -right-16 -top-16 w-80 h-80 rounded-full blur-3xl opacity-20 pointer-events-none" style="background-color: {{ $section->accent_color ?? '#007dfc' }};"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="space-y-4 max-w-3xl">
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-3xl shadow-inner" style="color: {{ $section->accent_color ?? '#007dfc' }};">
                        <i class="fa-solid fa-{{ $section->icon ?? 'cube' }}"></i>
                    </div>
                    <div>
                        @if($section->badge)
                            <span class="px-2.5 py-0.5 rounded text-[11px] font-bold font-tech uppercase tracking-wider bg-white/5 text-cyan-300 border border-white/10">
                                {{ $section->badge }}
                            </span>
                        @endif
                        <h1 class="text-3xl sm:text-5xl font-extrabold text-white font-tech uppercase tracking-wide">
                            {{ $section->title }}
                        </h1>
                    </div>
                </div>

                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    {{ $section->description }}
                </p>
            </div>

            <!-- Stats in banner -->
            <div class="flex-shrink-0 bg-white/[0.03] border border-white/5 p-6 rounded-2xl text-center min-w-[160px]">
                <span class="text-3xl font-extrabold text-white font-tech block">{{ $products->total() }}</span>
                <span class="text-xs uppercase text-slate-400 font-semibold tracking-wider">Всего ассетов</span>
            </div>
        </div>

        <!-- Section Switcher Tabs -->
        <div class="mt-8 pt-6 border-t border-white/5 flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
            <span class="text-xs text-slate-500 font-mono mr-2 flex-shrink-0 uppercase">Другие разделы:</span>
            @foreach($allSections as $s)
                <a href="{{ route('catalog.section', $s->slug) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold whitespace-nowrap transition-all flex items-center gap-1.5 {{ $s->id === $section->id ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30' : 'bg-white/5 text-slate-400 hover:text-white hover:bg-white/10 border border-white/5' }}">
                    <i class="fa-solid fa-{{ $s->icon ?? 'cube' }} text-[11px]"></i>
                    {{ $s->title }}
                    <span class="text-[10px] opacity-75">({{ $s->products_count }})</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Filter and Search Toolbar -->
    <div class="bg-[#0f1118] border border-white/5 p-4 rounded-2xl mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
        
        <!-- Engine Version Quick Filters -->
        <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 scrollbar-none">
            <span class="text-xs text-slate-400 font-mono mr-1">Версия:</span>
            
            <a href="{{ route('catalog.section', array_merge(['slug' => $section->slug], request()->except('version', 'page'))) }}" class="px-3 py-1 rounded-md text-xs font-semibold transition-all {{ !request('version') ? 'bg-white/10 text-white border border-white/20' : 'text-slate-400 hover:text-white' }}">
                Все
            </a>
            
            @foreach(['5.5', '5.4', '5.3', '5.2'] as $ver)
                <a href="{{ route('catalog.section', array_merge(['slug' => $section->slug, 'version' => $ver], request()->except('page'))) }}" class="px-3 py-1 rounded-md text-xs font-semibold transition-all {{ request('version') === $ver ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-400 hover:text-white bg-white/[0.03]' }}">
                    UE {{ $ver }}
                </a>
            @endforeach
        </div>

        <!-- Search Form and Sort -->
        <form method="GET" action="{{ route('catalog.section', $section->slug) }}" class="flex items-center gap-3 w-full md:w-auto">
            @if(request('version'))
                <input type="hidden" name="version" value="{{ request('version') }}">
            @endif

            <div class="relative flex-grow md:w-64">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск в разделе..." class="w-full bg-[#07080b] border border-white/10 rounded-xl px-4 py-2 text-xs text-slate-200 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors">
                @if(request('q'))
                    <a href="{{ route('catalog.section', array_merge(['slug' => $section->slug], request()->except('q', 'page'))) }}" class="absolute right-3 top-2.5 text-xs text-slate-500 hover:text-white">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
            </div>

            <select name="sort" onchange="this.form.submit()" class="bg-[#07080b] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-300 focus:outline-none focus:border-blue-500">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Новые</option>
                <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>Популярные</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Цена: по возрастанию</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Цена: по убыванию</option>
            </select>
        </form>

    </div>

    <!-- Product Grid (Level 2 Tile View) -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
                <div class="group rounded-2xl bg-[#0e1017] border border-white/10 hover:border-blue-500/50 transition-all duration-300 flex flex-col overflow-hidden shadow-xl hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-blue-500/10">
                    
                    <!-- Thumbnail 16:9 -->
                    <a href="{{ route('catalog.product', ['section_slug' => $section->slug, 'product_slug' => $product->slug]) }}" class="relative aspect-video overflow-hidden bg-slate-900 block">
                        <img src="{{ $product->featured_image ?? 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        
                        <div class="absolute top-3 right-3">
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold font-tech uppercase tracking-wider bg-blue-600/90 backdrop-blur-md text-white shadow">
                                {{ $product->version_compatibility }}
                            </span>
                        </div>

                        @if($product->video_url)
                            <div class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-black/75 backdrop-blur-md flex items-center justify-center text-white text-xs border border-white/20">
                                <i class="fa-solid fa-play"></i>
                            </div>
                        @endif
                    </a>

                    <!-- Card Content -->
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-white font-tech group-hover:text-blue-400 transition-colors line-clamp-1">
                                <a href="{{ route('catalog.product', ['section_slug' => $section->slug, 'product_slug' => $product->slug]) }}">
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
                                <a href="{{ route('catalog.product', ['section_slug' => $section->slug, 'product_slug' => $product->slug]) }}" class="px-3.5 py-2 rounded-xl text-xs font-bold bg-white/5 hover:bg-white/10 text-slate-200 transition-colors">
                                    Подробнее →
                                </a>
                                @if($product->fab_url)
                                    <a href="{{ $product->fab_url }}" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-500 text-white transition-all shadow-md shadow-blue-600/30 flex items-center gap-1.5">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Fab
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-20 bg-[#0e1017] rounded-3xl border border-white/5 p-8">
            <div class="w-16 h-16 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-3xl text-slate-500 mx-auto mb-4">
                <i class="fa-solid fa-box-open"></i>
            </div>
            <h3 class="text-xl font-bold text-white font-tech uppercase">Продукты не найдены</h3>
            <p class="text-sm text-slate-400 mt-2 max-w-md mx-auto">
                По вашему фильтру продуктов не найдено. Попробуйте сбросить параметры поиска.
            </p>
            <a href="{{ route('catalog.section', $section->slug) }}" class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs uppercase font-tech transition-all">
                Сбросить фильтры
            </a>
        </div>
    @endif

</div>
@endsection
