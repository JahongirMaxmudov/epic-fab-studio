@extends('layouts.admin')

@section('title', 'Отзывы & Модерация — Epic Fab Studio')
@section('header_title', 'Модерация отзывов & Комментариев')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-white font-tech uppercase">Отзывы разработчиков</h2>
            <p class="text-xs text-slate-400">Просматривайте и модерируйте отзывы к продуктам на Fab.com и комментариям в блоге.</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.comments.index') }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-white/5 text-slate-400 hover:text-white' }}">
                Все
            </a>
            <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ request('status') === 'pending' ? 'bg-amber-600 text-white' : 'bg-white/5 text-slate-400 hover:text-white' }}">
                На модерации
            </a>
            <a href="{{ route('admin.comments.index', ['status' => 'approved']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ request('status') === 'approved' ? 'bg-emerald-600 text-white' : 'bg-white/5 text-slate-400 hover:text-white' }}">
                Одобренные
            </a>
        </div>
    </div>

    <!-- Comments Table -->
    <div class="rounded-2xl bg-[#0f121b] border border-white/5 overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-white/[0.02] border-b border-white/5 uppercase font-tech text-slate-400 tracking-wider">
                    <tr>
                        <th class="p-4">Автор & Оценка</th>
                        <th class="p-4">Комментарий</th>
                        <th class="p-4">Материал</th>
                        <th class="p-4">Дата</th>
                        <th class="p-4">Статус</th>
                        <th class="p-4 text-right">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($comments as $comment)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="p-4">
                                <div class="font-bold text-white text-sm">{{ $comment->author_name }}</div>
                                <div class="text-[11px] text-slate-500">{{ $comment->author_email ?? 'Без email' }}</div>
                                <div class="text-amber-400 text-xs mt-1">
                                    @for($i = 1; $i <= $comment->rating; $i++) ★ @endfor
                                </div>
                            </td>
                            <td class="p-4 max-w-md">
                                <p class="text-slate-300 leading-relaxed text-xs">{{ $comment->content }}</p>
                            </td>
                            <td class="p-4">
                                @if($comment->commentable)
                                    <span class="text-xs font-bold text-blue-400 block">{{ $comment->commentable->title }}</span>
                                    <span class="text-[10px] text-slate-500 uppercase font-mono">{{ class_basename($comment->commentable_type) }}</span>
                                @else
                                    <span class="text-slate-600">Удаленный объект</span>
                                @endif
                            </td>
                            <td class="p-4 font-mono text-slate-500 text-[11px]">
                                {{ $comment->created_at->diffForHumans() }}
                            </td>
                            <td class="p-4">
                                @if($comment->is_approved)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-emerald-500/10 text-emerald-400">
                                        Одобрен
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-amber-500/10 text-amber-400">
                                        На проверке
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if(!$comment->is_approved)
                                        <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="p-2 rounded-lg bg-emerald-600/10 hover:bg-emerald-600 text-emerald-400 hover:text-white transition-colors" title="Одобрить">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Удалить отзыв?');" class="inline">
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
                            <td colspan="6" class="p-8 text-center text-slate-500">
                                Отзывов пока нет.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/5">
            {{ $comments->links() }}
        </div>
    </div>

</div>
@endsection
