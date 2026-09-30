@extends('layouts.admin')

@section('title', 'Новости & Девлог — Epic Fab Studio')
@section('header_title', 'Новости & Девлог студии')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white font-tech uppercase">Статьи & DevLog</h2>
            <p class="text-xs text-slate-400">Публикуйте технические статьи, чейнджлоги плагинов и новости разработки.</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs uppercase font-tech tracking-wider shadow-md flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Написать статью
        </a>
    </div>

    <!-- News Table -->
    <div class="rounded-2xl bg-[#0f121b] border border-white/5 overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-white/[0.02] border-b border-white/5 uppercase font-tech text-slate-400 tracking-wider">
                    <tr>
                        <th class="p-4">Медиа</th>
                        <th class="p-4">Заголовок</th>
                        <th class="p-4">Категория</th>
                        <th class="p-4">Просмотры</th>
                        <th class="p-4">Дата</th>
                        <th class="p-4">Статус</th>
                        <th class="p-4 text-right">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($articles as $article)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="p-4">
                                <img src="{{ $article->featured_image }}" class="w-14 aspect-video rounded-lg object-cover bg-black">
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-white text-sm max-w-sm truncate">{{ $article->title }}</div>
                                <div class="font-mono text-[11px] text-slate-500">/news/{{ $article->slug }}</div>
                            </td>
                            <td class="p-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold font-tech uppercase bg-purple-500/10 text-purple-300 border border-purple-500/20">
                                    {{ $article->category }}
                                </span>
                            </td>
                            <td class="p-4 font-mono text-slate-400">
                                {{ $article->views_count }}
                            </td>
                            <td class="p-4 font-mono text-slate-400">
                                {{ $article->published_at ? $article->published_at->format('d.m.Y') : '—' }}
                            </td>
                            <td class="p-4">
                                @if($article->is_published)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-emerald-500/10 text-emerald-400">
                                        Опубликовано
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-800 text-slate-400">
                                        Черновик
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('news.show', $article->slug) }}" target="_blank" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-slate-400 hover:text-white" title="Открыть на сайте">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                    <a href="{{ route('admin.news.edit', $article->id) }}" class="p-2 rounded-lg bg-blue-600/10 hover:bg-blue-600 text-blue-400 hover:text-white transition-colors" title="Редактировать">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.news.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Удалить эту статью?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-red-600/10 hover:bg-red-600 text-red-400 hover:text-white transition-colors" title="Удалить">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-500">
                                Статьи еще не написаны.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/5">
            {{ $articles->links() }}
        </div>
    </div>

</div>
@endsection
