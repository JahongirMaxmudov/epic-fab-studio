@extends('layouts.admin')

@section('title', 'Создать продукт — Epic Fab Studio')
@section('header_title', 'Новый продукт & Конструктор блоков')

@section('content')
<div class="max-w-5xl space-y-8">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white font-tech uppercase">Создание продукта</h2>
            <p class="text-xs text-slate-400">Настройте параметры ассета и сконструируйте презентационную страницу с помощью визуальных блоков.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-slate-400 hover:text-white font-tech uppercase">
            ← Назад к продуктам
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- 1. General Product Info Card -->
        <div class="rounded-2xl bg-[#0f121b] border border-white/5 p-6 space-y-6 shadow-xl">
            <h3 class="text-base font-bold text-white font-tech uppercase border-b border-white/5 pb-3 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-blue-400"></i> Основная информация
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                <div class="sm:col-span-4">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Раздел (Плитка) *</label>
                    <select name="section_id" required class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                        <option value="">Выберите раздел</option>
                        @foreach($sections as $s)
                            <option value="{{ $s->id }}" {{ old('section_id') == $s->id ? 'selected' : '' }}>{{ $s->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:col-span-8">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Название продукта *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Например: OmniDialogue Pro: Node Narrative System" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div class="sm:col-span-6">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">URL Slug (оставьте пустым для авто)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="omnidialogue-pro-ue5" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div class="sm:col-span-6">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Совместимость версий UE *</label>
                    <input type="text" name="version_compatibility" value="{{ old('version_compatibility', 'UE 5.3, 5.4, 5.5') }}" required placeholder="UE 5.3, 5.4, 5.5" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div class="sm:col-span-12">
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Краткий слоган / Подзаголовок</label>
                    <input type="text" name="tagline" value="{{ old('tagline') }}" placeholder="Комплексная система диалогов с визуальным редактором графов Slate и синхронизацией MetaHuman" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <!-- Marketplace Fab.com and Price -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Ссылка на Fab.com Marketplace</label>
                    <div class="relative">
                        <i class="fa-solid fa-store absolute left-4 top-3 text-slate-500 text-xs"></i>
                        <input type="url" name="fab_url" value="{{ old('fab_url') }}" placeholder="https://www.fab.com/listings/..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Стоимость ($ USD, оставьте пустым если Free)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-2.5 text-slate-500 font-bold">$</span>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="49.99" class="w-full bg-[#080a0f] border border-white/10 rounded-xl pl-9 pr-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500 font-mono">
                    </div>
                </div>
            </div>

            <!-- Media Links -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Главное изображение (URL)</label>
                    <input type="text" name="featured_image" value="{{ old('featured_image') }}" placeholder="https://..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">Видео трейлер (YouTube URL)</label>
                    <input type="text" name="video_url" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=..." class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <!-- Gallery URLs -->
            <div>
                <label class="block text-xs font-bold text-slate-300 uppercase font-tech mb-1.5">URL изображений галереи (по одной ссылке на строку)</label>
                <textarea name="gallery_urls" rows="3" placeholder="https://image1.jpg&#10;https://image2.jpg" class="w-full bg-[#080a0f] border border-white/10 rounded-xl px-4 py-2 text-xs font-mono text-slate-200 focus:outline-none focus:border-blue-500 leading-relaxed">{{ old('gallery_urls') }}</textarea>
            </div>

            <!-- Checkboxes -->
            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" checked class="rounded border-white/10 bg-black text-blue-600 focus:ring-0">
                    <span class="text-xs font-semibold text-slate-200 uppercase font-tech">Опубликовать сразу</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" class="rounded border-white/10 bg-black text-blue-600 focus:ring-0">
                    <span class="text-xs font-semibold text-slate-200 uppercase font-tech">Закрепить в избранном на главной</span>
                </label>
            </div>
        </div>

        <!-- 2. Visual Modular Page Builder ("Widget/Block Designer") -->
        @include('admin.products._block_builder', ['initialBlocks' => []])

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-white/5">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 text-xs font-bold uppercase font-tech">
                Отмена
            </a>
            <button type="submit" class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white text-xs font-bold uppercase font-tech tracking-wider shadow-lg shadow-blue-500/30 transition-all hover:scale-105 active:scale-95">
                Опубликовать продукт
            </button>
        </div>

    </form>

</div>
@endsection
