@extends('layouts.admin')

@section('title', 'Дашборд — Epic Fab Studio')
@section('header_title', 'Обзор студии & Метрики')

@section('content')
<div class="space-y-8">

    <!-- Metrics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        
        <div class="p-5 rounded-2xl bg-[#0f121b] border border-white/5 shadow-md flex items-center justify-between">
            <div>
                <span class="text-[11px] font-mono uppercase text-slate-400 font-semibold block">Продукты</span>
                <span class="text-3xl font-extrabold text-white font-tech">{{ $stats['products_count'] }}</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-blue-600/10 text-blue-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-[#0f121b] border border-white/5 shadow-md flex items-center justify-between">
            <div>
                <span class="text-[11px] font-mono uppercase text-slate-400 font-semibold block">Разделы (Плитка)</span>
                <span class="text-3xl font-extrabold text-cyan-400 font-tech">{{ $stats['sections_count'] }}</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-[#0f121b] border border-white/5 shadow-md flex items-center justify-between">
            <div>
                <span class="text-[11px] font-mono uppercase text-slate-400 font-semibold block">Новости / DevLog</span>
                <span class="text-3xl font-extrabold text-purple-400 font-tech">{{ $stats['news_count'] }}</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-[#0f121b] border border-white/5 shadow-md flex items-center justify-between">
            <div>
                <span class="text-[11px] font-mono uppercase text-slate-400 font-semibold block">Отзывы</span>
                <span class="text-3xl font-extrabold text-amber-400 font-tech">{{ $stats['comments_count'] }}</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-comments"></i>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-[#0f121b] border border-white/5 shadow-md flex items-center justify-between">
            <div>
                <span class="text-[11px] font-mono uppercase text-slate-400 font-semibold block">Просмотры</span>
                <span class="text-3xl font-extrabold text-emerald-400 font-tech">{{ $stats['total_views'] }}</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-eye"></i>
            </div>
        </div>

    </div>

    <!-- Quick Action Banner -->
    <div class="p-6 rounded-2xl border border-blue-500/20 bg-gradient-to-r from-blue-950/30 via-[#0e111a] to-blue-950/30 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-white font-tech uppercase">Визуальный конструктор страниц Fab.com</h3>
            <p class="text-xs text-slate-400 mt-0.5">Создавайте новые продукты и страницы с гибкими блоками заголовков, галерей, спецификаций и видео.</p>
        </div>
        <div class="flex items-center gap-3 flex-shrink-0">
            <a href="{{ route('admin.products.create') }}" class="px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs uppercase font-tech tracking-wider shadow-lg flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Добавить продукт
            </a>
            <a href="{{ route('admin.sections.create') }}" class="px-4 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 font-bold text-xs uppercase font-tech tracking-wider border border-white/10">
                Новый раздел
            </a>
        </div>
    </div>

    <!-- Two-column tables: Recent Products & Recent Comments -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left: Recent Products (7 cols) -->
        <div class="lg:col-span-7 rounded-2xl bg-[#0f121b] border border-white/5 p-6 shadow-md">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/5">
                <h3 class="text-base font-bold text-white font-tech uppercase flex items-center gap-2">
                    <i class="fa-solid fa-box text-blue-400"></i> Последние продукты
                </h3>
                <a href="{{ route('admin.products.index') }}" class="text-xs text-blue-400 hover:text-cyan-300 font-tech uppercase">
                    Все продукты →
                </a>
            </div>

            <div class="space-y-3">
                @foreach($recentProducts as $p)
                    <div class="flex items-center justify-between p-3 rounded-xl bg-white/[0.02] hover:bg-white/[0.04] transition-colors border border-white/5">
                        <div class="flex items-center gap-3 min-w-0">
                            <img src="{{ $p->featured_image }}" class="w-12 h-8 rounded-lg object-cover bg-black flex-shrink-0">
                            <div class="min-w-0">
                                <h4 class="text-xs font-bold text-white truncate">{{ $p->title }}</h4>
                                <span class="text-[10px] text-slate-400 font-mono">{{ $p->section->title }} &bull; {{ $p->version_compatibility }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 flex-shrink-0 pl-3">
                            <span class="text-xs font-bold text-white font-tech">{{ $p->price ? '$' . $p->price : 'Free' }}</span>
                            <a href="{{ route('admin.products.edit', $p->id) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/10 text-xs">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right: Recent Comments (5 cols) -->
        <div class="lg:col-span-5 rounded-2xl bg-[#0f121b] border border-white/5 p-6 shadow-md">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/5">
                <h3 class="text-base font-bold text-white font-tech uppercase flex items-center gap-2">
                    <i class="fa-solid fa-comments text-amber-400"></i> Свежие отзывы
                </h3>
                <a href="{{ route('admin.comments.index') }}" class="text-xs text-blue-400 hover:text-cyan-300 font-tech uppercase">
                    Модерация →
                </a>
            </div>

            <div class="space-y-3">
                @forelse($recentComments as $c)
                    <div class="p-3 rounded-xl bg-white/[0.02] border border-white/5 space-y-1.5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-200">{{ $c->author_name }}</span>
                            <div class="text-amber-400 text-[10px]">
                                @for($i = 1; $i <= $c->rating; $i++) ★ @endfor
                            </div>
                        </div>
                        <p class="text-xs text-slate-400 line-clamp-2">{{ $c->content }}</p>
                        <div class="flex items-center justify-between text-[10px] text-slate-500 pt-1 font-mono">
                            <span>{{ $c->created_at->diffForHumans() }}</span>
                            @if($c->is_approved)
                                <span class="text-emerald-400">Одобрен</span>
                            @else
                                <span class="text-amber-400">На модерации</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-slate-500 text-xs">
                        Новых отзывов пока нет.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
