@extends('layouts.admin')

@section('title', 'Продукты — Epic Fab Studio')
@section('header_title', 'Каталог продуктов & Ассетов')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-white font-tech uppercase">Продукты студии</h2>
            <p class="text-xs text-slate-400">Управляйте страницами плагинов и ассетов, настроенными в визуальном конструкторе.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs uppercase font-tech tracking-wider shadow-md flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Добавить продукт
        </a>
    </div>

    <!-- Filter by section & search -->
    <div class="p-4 rounded-2xl bg-[#0f121b] border border-white/5 flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-wrap items-center gap-3 w-full">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Поиск по названию..." class="bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2 text-xs text-slate-200 focus:outline-none focus:border-blue-500">
            
            <select name="section_id" onchange="this.form.submit()" class="bg-[#080a0f] border border-white/10 rounded-xl px-3 py-2 text-xs text-slate-300 focus:outline-none focus:border-blue-500">
                <option value="">Все разделы</option>
                @foreach($sections as $s)
                    <option value="{{ $s->id }}" {{ request('section_id') == $s->id ? 'selected' : '' }}>{{ $s->title }}</option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 text-xs font-bold uppercase font-tech">
                Применить
            </button>
            @if(request('q') || request('section_id'))
                <a href="{{ route('admin.products.index') }}" class="text-xs text-slate-500 hover:text-white">Сбросить</a>
            @endif
        </form>
    </div>

    <!-- Products Table -->
    <div class="rounded-2xl bg-[#0f121b] border border-white/5 overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-white/[0.02] border-b border-white/5 uppercase font-tech text-slate-400 tracking-wider">
                    <tr>
                        <th class="p-4">Медиа</th>
                        <th class="p-4">Название & Раздел</th>
                        <th class="p-4">Совместимость</th>
                        <th class="p-4">Стоимость</th>
                        <th class="p-4">Блоки</th>
                        <th class="p-4">Просмотры</th>
                        <th class="p-4">Статус</th>
                        <th class="p-4 text-right">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($products as $product)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="p-4">
                                <img src="{{ $product->featured_image }}" class="w-14 aspect-video rounded-lg object-cover bg-black">
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-white text-sm truncate max-w-xs">{{ $product->title }}</div>
                                <span class="text-[10px] text-blue-400 font-semibold uppercase font-tech">{{ $product->section->title }}</span>
                            </td>
                            <td class="p-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold font-tech uppercase bg-white/5 text-slate-300 border border-white/10">
                                    {{ $product->version_compatibility }}
                                </span>
                            </td>
                            <td class="p-4 font-bold text-white font-tech text-sm">
                                {{ $product->price ? '$' . number_format($product->price, 2) : 'Бесплатно' }}
                            </td>
                            <td class="p-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-purple-500/10 text-purple-300 border border-purple-500/20">
                                    {{ is_array($product->blocks) ? count($product->blocks) : 0 }} виджетов
                                </span>
                            </td>
                            <td class="p-4 font-mono text-slate-400">
                                {{ $product->views_count }}
                            </td>
                            <td class="p-4">
                                @if($product->is_published)
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        Опубликован
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-800 text-slate-400">
                                        Черновик
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('catalog.product', ['section_slug' => $product->section->slug, 'product_slug' => $product->slug]) }}" target="_blank" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-slate-400 hover:text-white" title="Открыть на сайте">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                    @if($product->fab_url)
                                        <a href="{{ $product->fab_url }}" target="_blank" class="p-2 rounded-lg bg-cyan-600/10 hover:bg-cyan-600 text-cyan-400 hover:text-white" title="Открыть на Fab.com">
                                            <i class="fa-solid fa-store"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 rounded-lg bg-blue-600/10 hover:bg-blue-600 text-blue-400 hover:text-white transition-colors" title="Редактировать">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Удалить этот продукт?');" class="inline">
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
                                Продукты пока не созданы.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-white/5">
            {{ $products->links() }}
        </div>
    </div>

</div>
@endsection
