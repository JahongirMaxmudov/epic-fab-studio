@extends('layouts.app')

@section('title', 'DevLog & Новости студии — Epic Fab Studio')
@section('meta_description', 'Технические заметки, обновления плагинов на Fab.com и статьи по оптимизации шейдеров и ассетов для Unreal Engine 5.')

@section('content')
<div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="text-center max-w-3xl mx-auto mb-12">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-bold uppercase tracking-wider font-tech mb-3">
            <i class="fa-solid fa-code-commit"></i> DevLog / Новости
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-white font-tech uppercase tracking-wide">
            ДНЕВНИКИ РАЗРАБОТКИ & ОБНОВЛЕНИЯ
        </h1>
        <p class="mt-4 text-slate-300 text-sm sm:text-base leading-relaxed">
            Читайте о последних апдейтах наших C++ плагинов, инсайтах по настройке Niagara VFX и практиках оптимизации Nanite для AAA-проектов.
        </p>
    </div>

    <!-- Category Filters -->
    @if($categories->count() > 0)
        <div class="flex items-center justify-center gap-2 overflow-x-auto pb-4 mb-10 scrollbar-none">
            <a href="{{ route('news.index') }}" class="px-4 py-2 rounded-xl text-xs font-bold font-tech uppercase tracking-wider transition-all {{ !$currentCategory ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/30' : 'bg-[#0f1118] text-slate-400 hover:text-white border border-white/5' }}">
                Все темы
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('news.index', ['category' => $cat]) }}" class="px-4 py-2 rounded-xl text-xs font-bold font-tech uppercase tracking-wider transition-all {{ $currentCategory === $cat ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/30' : 'bg-[#0f1118] text-slate-400 hover:text-white border border-white/5' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>
    @endif

    <!-- News Grid -->
    @if($news->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($news as $article)
                <article class="group rounded-2xl bg-[#0e1017] border border-white/10 hover:border-purple-500/50 transition-all duration-300 overflow-hidden flex flex-col shadow-xl hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-purple-500/10">
                    <a href="{{ route('news.show', $article->slug) }}" class="aspect-video relative overflow-hidden bg-slate-900 block">
                        <img src="{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded text-[10px] font-bold font-tech uppercase tracking-wider bg-black/80 backdrop-blur-md text-purple-300 border border-purple-500/30">
                            {{ $article->category }}
                        </span>
                    </a>

                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="text-[11px] text-slate-500 font-mono mb-2">
                                {{ $article->published_at ? $article->published_at->translatedFormat('d F Y') : 'Недавно' }}
                            </div>

                            <h2 class="text-lg font-bold text-white font-tech group-hover:text-purple-400 transition-colors line-clamp-2">
                                <a href="{{ route('news.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h2>

                            <p class="mt-3 text-xs sm:text-sm text-slate-400 line-clamp-3 leading-relaxed">
                                {{ $article->excerpt }}
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                            <span class="text-slate-500 font-mono">
                                <i class="fa-regular fa-eye mr-1"></i> {{ $article->views_count }}
                            </span>
                            <a href="{{ route('news.show', $article->slug) }}" class="font-bold text-purple-400 group-hover:text-purple-300 flex items-center gap-1 font-tech uppercase tracking-wider text-[11px]">
                                Читать статью <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $news->links() }}
        </div>
    @else
        <div class="text-center py-20 bg-[#0e1017] rounded-3xl border border-white/5 p-8">
            <h3 class="text-xl font-bold text-white font-tech uppercase">Статей пока нет</h3>
            <p class="text-sm text-slate-400 mt-2">В этой категории еще не опубликованы статьи.</p>
        </div>
    @endif

</div>
@endsection
