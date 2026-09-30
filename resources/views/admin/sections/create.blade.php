@extends('layouts.admin')

@section('title', 'Создать раздел — Epic Fab Studio')
@section('header_title', 'Новый раздел каталога')

@section('content')
<div class="max-w-3xl space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white font-tech uppercase">Создание раздела (Плитки)</h2>
            <p class="text-xs text-slate-400">Заполните параметры нового раздела для главной страницы и каталога.</p>
        </div>
        <a href="{{ route('admin.sections.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white font-tech uppercase">
            ← Назад к разделам
        </a>
    </div>

    <div class="rounded-2xl bg-[#0f121b] border border-white/5 p-6 shadow-xl">
        <form action="{{ route('admin.sections.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Название раздела *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Например: Плагины на Fab.com" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">URL Slug (оставьте пустым для авто)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="fab-plugins" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">FontAwesome Иконка</label>
                    <input type="text" name="icon" value="{{ old('icon', 'plug') }}" placeholder="plug, cube, wand-magic-sparkles" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                    <span class="text-[10px] text-slate-500 mt-1 block">Название иконки без fa-</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Бейдж на плитке</label>
                    <input type="text" name="badge" value="{{ old('badge', 'C++ & Blueprint') }}" placeholder="C++ & Blueprint, Niagara" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Акцентный цвет (HEX)</label>
                    <input type="text" name="accent_color" value="{{ old('accent_color', '#007dfc') }}" placeholder="#007dfc" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Описание раздела</label>
                <textarea name="description" rows="3" placeholder="Краткое описание ассетов и плагинов в этом разделе..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500 leading-relaxed">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Баннер раздела (URL)</label>
                    <input type="text" name="banner_image" value="{{ old('banner_image') }}" placeholder="https://..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Порядок сортировки</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 1) }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded border-white/10 bg-black text-blue-600 focus:ring-0">
                    <span class="text-xs font-semibold text-slate-200 uppercase font-tech">Раздел активен и отображается на сайте</span>
                </label>
            </div>

            <div class="pt-4 border-t border-white/5 flex items-center justify-end gap-3">
                <a href="{{ route('admin.sections.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 text-xs font-bold uppercase font-tech">
                    Отмена
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold uppercase font-tech shadow-lg shadow-blue-600/30">
                    Создать раздел
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
