@extends('layouts.admin')

@section('title', 'Управление разделами — Epic Fab Studio')
@section('header_title', 'Разделы сайта (Плитка)')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white font-tech uppercase">Категории и Разделы (Плитка)</h2>
            <p class="text-xs text-slate-400">Управляйте разделами витрины (Level 1). Пользователи видят их в виде интерактивной плитки.</p>
        </div>
        <a href="{{ route('admin.sections.create') }}" class="px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs uppercase font-tech tracking-wider shadow-md flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Новый раздел
        </a>
    </div>

    <!-- Sections Table -->
    <div class="rounded-2xl bg-[#0f121b] border border-white/5 overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-white/[0.02] border-b border-white/5 uppercase font-tech text-slate-400 tracking-wider">
                    <tr>
                        <th class="p-4">Порядок</th>
                        <th class="p-4">Иконка</th>
                        <th class="p-4">Название & Slug</th>
                        <th class="p-4">Бейдж</th>
                        <th class="p-4">Цвет</th>
                        <th class="p-4">Продукты</th>
                        <th class="p-4">Статус</th>
                        <th class="p-4 text-right">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($sections as $sec)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="p-4 font-mono font-bold text-slate-400">{{ $sec->sort_order }}</td>
                            <td class="p-4">
                                <div class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-lg" style="color: {{ $sec->accent_color ?? '#007dfc' }};">
                                    <i class="fa-solid fa-{{ $sec->icon ?? 'cube' }}"></i>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-white text-sm">{{ $sec->title }}</div>
                                <div class="font-mono text-[11px] text-slate-500">/section/{{ $sec->slug }}</div>
                            </td>
                            <td class="p-4">
                                @if($sec->badge)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold font-tech uppercase bg-blue-500/10 text-cyan-300 border border-blue-500/20">
                                        {{ $sec->badge }}
                                    </span>
                                @else
                                    <span class="text-slate-600">—</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <span class="w-3.5 h-3.5 rounded-full border border-white/20" style="background-color: {{ $sec->accent_color ?? '#007dfc' }};"></span>
                                    <span class="font-mono text-[11px] text-slate-400">{{ $sec->accent_color ?? '#007dfc' }}</span>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 rounded-lg bg-white/5 font-mono font-bold text-white">
                                    {{ $sec->products_count }}
                                </span>
                            </td>
                            <td class="p-4">
                                @if($sec->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        Активен
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-800 text-slate-400">
                                        Отключен
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('catalog.section', $sec->slug) }}" target="_blank" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-slate-400 hover:text-white" title="Открыть на сайте">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                    <a href="{{ route('admin.sections.edit', $sec->id) }}" class="p-2 rounded-lg bg-blue-600/10 hover:bg-blue-600 text-blue-400 hover:text-white transition-colors" title="Редактировать">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.sections.destroy', $sec->id) }}" method="POST" onsubmit="return confirm('Удалить этот раздел?');" class="inline">
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
                            <td colspan="8" class="p-8 text-center text-slate-500">
                                Разделы еще не созданы.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
