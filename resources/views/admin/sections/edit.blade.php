@extends('layouts.admin')

@section('title', 'Редактировать раздел — Epic Fab Studio')
@section('header_title', 'Редактирование раздела')

@section('content')
<div class="max-w-3xl space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white font-tech uppercase">Редактирование раздела: {{ $section->title }}</h2>
            <p class="text-xs text-slate-400">Измените параметры и оформление раздела.</p>
        </div>
        <a href="{{ route('admin.sections.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white font-tech uppercase">
            ← Назад к разделам
        </a>
    </div>

    <div class="rounded-2xl bg-[#0f121b] border border-white/5 p-6 shadow-xl">
        <form action="{{ route('admin.sections.update', $section->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Название раздела *</label>
                    <input type="text" name="title" value="{{ old('title', $section->title) }}" required class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">URL Slug *</label>
                    <input type="text" name="slug" value="{{ old('slug', $section->slug) }}" required class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">FontAwesome Иконка</label>
                    <input type="text" name="icon" value="{{ old('icon', $section->icon) }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Бейдж на плитке</label>
                    <input type="text" name="badge" value="{{ old('badge', $section->badge) }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Акцентный цвет (HEX)</label>
                    <input type="text" name="accent_color" value="{{ old('accent_color', $section->accent_color) }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Описание раздела</label>
                <textarea name="description" rows="3" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500 leading-relaxed">{{ old('description', $section->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Баннер раздела (URL)</label>
                    <input type="text" name="banner_image" value="{{ old('banner_image', $section->banner_image) }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Порядок сортировки</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order) }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $section->is_active ? 'checked' : '' }} class="rounded border-white/10 bg-black text-blue-600 focus:ring-0">
                    <span class="text-xs font-semibold text-slate-200 uppercase font-tech">Раздел активен и отображается на сайте</span>
                </label>
            </div>

            <div class="pt-4 border-t border-white/5 flex items-center justify-end gap-3">
                <a href="{{ route('admin.sections.index') }}" class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 text-xs font-bold uppercase font-tech">
                    Отмена
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold uppercase font-tech shadow-lg shadow-blue-600/30">
                    Сохранить изменения
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
