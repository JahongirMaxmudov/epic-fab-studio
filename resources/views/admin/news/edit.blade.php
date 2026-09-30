@extends('layouts.admin')

@section('title', 'Редактировать статью — Epic Fab Studio')
@section('header_title', 'Редактирование статьи / Девлога')

@section('content')
<div class="max-w-4xl space-y-8">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white font-tech uppercase">Редактирование: {{ $article->title }}</h2>
            <p class="text-xs text-slate-400">Внесите правки в текст и структуру блоков статьи.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('news.show', $article->slug) }}" target="_blank" class="text-xs font-semibold text-purple-400 hover:text-white font-tech uppercase flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> На сайте
            </a>
            <a href="{{ route('admin.news.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white font-tech uppercase">
                ← Назад к статьям
            </a>
        </div>
    </div>

    <form action="{{ route('admin.news.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="rounded-2xl bg-[#0f121b] border border-white/5 p-6 space-y-4 shadow-xl">
            <h3 class="text-base font-bold text-white font-tech uppercase border-b border-white/5 pb-3">Метаданные статьи</h3>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                <div class="sm:col-span-8">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Заголовок *</label>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" required class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div class="sm:col-span-4">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Категория</label>
                    <input type="text" name="category" value="{{ old('category', $article->category) }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div class="sm:col-span-6">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">URL Slug *</label>
                    <input type="text" name="slug" value="{{ old('slug', $article->slug) }}" required class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div class="sm:col-span-6">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Обложка (URL)</label>
                    <input type="text" name="featured_image" value="{{ old('featured_image', $article->featured_image) }}" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div class="sm:col-span-12">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Краткое описание (лид) *</label>
                    <textarea name="excerpt" rows="2" required class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2 text-xs text-slate-200 focus:outline-none focus:border-blue-500 leading-relaxed">{{ old('excerpt', $article->excerpt) }}</textarea>
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ $article->is_published ? 'checked' : '' }} class="rounded border-white/10 bg-black text-blue-600 focus:ring-0">
                    <span class="text-xs font-semibold text-slate-200 uppercase font-tech">Опубликовано</span>
                </label>
            </div>
        </div>

        <!-- Visual Block Builder -->
        @include('admin.products._block_builder', ['initialBlocks' => $article->blocks ?? []])

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-white/5">
            <a href="{{ route('admin.news.index') }}" class="px-6 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 text-xs font-bold uppercase font-tech">
                Отмена
            </a>
            <button type="submit" class="px-8 py-3.5 rounded-xl bg-purple-600 hover:bg-purple-500 text-white text-xs font-bold uppercase font-tech tracking-wider shadow-lg shadow-purple-600/30 transition-all">
                Сохранить изменения
            </button>
        </div>

    </form>

</div>
@endsection
