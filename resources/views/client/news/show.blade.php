@extends('layouts.app')

@section('title', $article->title . ' — DevLog | Epic Fab Studio')
@section('meta_description', $article->excerpt)

@section('content')
<div class="py-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1">
            <i class="fa-solid fa-home text-[10px]"></i> Главная
        </a>
        <span>/</span>
        <a href="{{ route('news.index') }}" class="hover:text-blue-400 transition-colors">DevLog</a>
        <span>/</span>
        <span class="text-slate-300 font-semibold truncate">{{ $article->title }}</span>
    </nav>

    <!-- Article Header -->
    <header class="mb-10 space-y-4">
        <div class="flex flex-wrap items-center gap-3">
            <span class="px-2.5 py-1 rounded-md text-[11px] font-bold font-tech uppercase tracking-wider bg-purple-500/10 text-purple-300 border border-purple-500/30">
                {{ $article->category }}
            </span>
            <span class="text-xs text-slate-500 font-mono">
                <i class="fa-regular fa-calendar mr-1"></i> {{ $article->published_at ? $article->published_at->translatedFormat('d F Y') : 'Недавно' }}
            </span>
            <span class="text-xs text-slate-500 font-mono">
                <i class="fa-regular fa-eye mr-1"></i> {{ $article->views_count }} просмотров
            </span>
        </div>

        <h1 class="text-3xl sm:text-5xl font-extrabold text-white font-tech uppercase tracking-tight leading-tight">
            {{ $article->title }}
        </h1>

        <!-- Excerpt lead -->
        <p class="text-base sm:text-lg text-slate-300 leading-relaxed font-normal p-4 rounded-2xl bg-white/[0.02] border-l-4 border-purple-500">
            {{ $article->excerpt }}
        </p>
    </header>

    <!-- Featured Image -->
    @if($article->featured_image)
        <div class="rounded-3xl overflow-hidden border border-white/10 mb-12 shadow-2xl">
            <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-full max-h-[500px] object-cover">
        </div>
    @endif

    <!-- Modular Content Blocks -->
    <div class="mb-16">
        <x-blocks.render :blocks="$article->blocks" />
    </div>

    <!-- Comments for this article -->
    <div class="pt-12 border-t border-white/10 mb-16">
        <h3 class="text-2xl font-extrabold text-white font-tech uppercase tracking-wide mb-6 flex items-center gap-2">
            <i class="fa-solid fa-comments text-purple-400"></i>
            Обсуждение статьи ({{ $article->comments->count() }})
        </h3>

        <!-- Comment Form -->
        <div class="rounded-2xl border border-white/10 bg-[#0e1119] p-6 mb-8 shadow-xl">
            <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="commentable_type" value="news">
                <input type="hidden" name="commentable_id" value="{{ $article->id }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase font-tech">Ваше имя *</label>
                        <input type="text" name="author_name" required placeholder="Ваше имя" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-4 py-2 text-sm text-slate-200 focus:outline-none focus:border-purple-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase font-tech">Email</label>
                        <input type="email" name="author_email" placeholder="dev@example.com" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-4 py-2 text-sm text-slate-200 focus:outline-none focus:border-purple-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase font-tech">Комментарий *</label>
                    <textarea name="content" rows="3" required placeholder="Напишите комментарий к статье..." class="w-full bg-[#07080b] border border-white/10 rounded-xl px-4 py-2 text-sm text-slate-200 focus:outline-none focus:border-purple-500"></textarea>
                </div>

                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white bg-purple-600 hover:bg-purple-500 shadow-md shadow-purple-600/30 text-xs uppercase font-tech tracking-wider transition-all">
                    Отправить комментарий
                </button>
            </form>
        </div>

        <!-- Comments List -->
        <div class="space-y-4">
            @forelse($article->comments as $comment)
                <div class="rounded-2xl border border-white/5 bg-[#0a0c12] p-5">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-full bg-purple-600/20 text-purple-400 font-bold text-xs flex items-center justify-center">
                                {{ mb_substr($comment->author_name, 0, 1) }}
                            </span>
                            <span class="text-sm font-bold text-white">{{ $comment->author_name }}</span>
                        </div>
                        <span class="text-xs text-slate-500 font-mono">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-slate-300 leading-relaxed">{{ $comment->content }}</p>
                </div>
            @empty
                <div class="text-center py-6 text-slate-500 text-sm">
                    Комментариев пока нет. Будьте первым!
                </div>
            @endforelse
        </div>
    </div>

    <!-- Related Articles -->
    @if($latestArticles->count() > 0)
        <div class="pt-12 border-t border-white/10">
            <h3 class="text-xl font-bold text-white font-tech uppercase tracking-wide mb-6">
                ДРУГИЕ МАТЕРИАЛЫ
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach($latestArticles as $rel)
                    <a href="{{ route('news.show', $rel->slug) }}" class="p-4 rounded-xl bg-[#0e1017] border border-white/5 hover:border-purple-500/40 transition-all block">
                        <span class="text-[10px] uppercase font-tech text-purple-400 font-bold block mb-1">{{ $rel->category }}</span>
                        <h4 class="text-sm font-bold text-white line-clamp-2 hover:text-purple-300">{{ $rel->title }}</h4>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
