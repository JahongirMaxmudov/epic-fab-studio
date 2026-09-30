@extends('layouts.app')

@section('title', $product->title . ' — ' . $section->title . ' | Epic Fab Studio')
@section('meta_description', $product->tagline)

@section('content')
<div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs font-mono text-slate-500 mb-8 overflow-x-auto whitespace-nowrap scrollbar-none">
        <a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors flex items-center gap-1">
            <i class="fa-solid fa-home text-[10px]"></i> Главная
        </a>
        <span>/</span>
        <a href="{{ route('home') }}#catalog-tiles" class="hover:text-blue-400 transition-colors">Разделы</a>
        <span>/</span>
        <a href="{{ route('catalog.section', $section->slug) }}" class="hover:text-blue-400 transition-colors">{{ $section->title }}</a>
        <span>/</span>
        <span class="text-slate-300 font-semibold truncate">{{ $product->title }}</span>
    </nav>

    <!-- LEVEL 3: FAB.COM STYLE PRODUCT HERO SHOWCASE -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 mb-16" x-data="{
        activeMedia: '{{ $product->video_url ? 'video' : 'image' }}',
        activeImage: '{{ $product->featured_image ?? ($product->gallery_images[0] ?? '') }}',
        activeVideo: '{{ $product->video_url ? (str_contains($product->video_url, 'watch?v=') ? str_replace('watch?v=', 'embed/', $product->video_url) : $product->video_url) : '' }}'
    }">
        
        <!-- Left: Media Viewer & Gallery (7 cols on lg) -->
        <div class="lg:col-span-7 space-y-4">
            
            <!-- Main Screen Area (16:9) -->
            <div class="relative rounded-2xl overflow-hidden border border-white/10 bg-[#0a0c12] aspect-video shadow-2xl group">
                
                <!-- Video Display -->
                <template x-if="activeMedia === 'video' && activeVideo">
                    <iframe :src="activeVideo" class="w-full h-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </template>

                <!-- Image Display -->
                <template x-if="activeMedia === 'image'">
                    <img :src="activeImage" alt="{{ $product->title }}" class="w-full h-full object-cover">
                </template>

                <!-- Fullscreen / Lightbox trigger -->
                <a :href="activeImage" target="_blank" x-show="activeMedia === 'image'" class="absolute bottom-4 right-4 px-3 py-1.5 rounded-lg bg-black/75 hover:bg-black text-white text-xs font-semibold backdrop-blur-md border border-white/20 transition-all flex items-center gap-1.5">
                    <i class="fa-solid fa-expand"></i> В полном размере
                </a>
            </div>

            <!-- Media Selector Strip (Thumbnails) -->
            <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-none">
                
                @if($product->video_url)
                    <button @click="activeMedia = 'video'" :class="activeMedia === 'video' ? 'ring-2 ring-blue-500 border-blue-500' : 'border-white/10 hover:border-white/30'" class="relative w-28 aspect-video rounded-xl overflow-hidden bg-slate-900 border flex-shrink-0 flex items-center justify-center group transition-all">
                        <img src="{{ $product->featured_image }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-80 transition-opacity">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="w-8 h-8 rounded-full bg-blue-600/90 text-white flex items-center justify-center text-xs shadow-md">
                                <i class="fa-solid fa-play ml-0.5"></i>
                            </span>
                        </div>
                    </button>
                @endif

                @if($product->featured_image)
                    <button @click="activeMedia = 'image'; activeImage = '{{ $product->featured_image }}'" :class="activeMedia === 'image' && activeImage === '{{ $product->featured_image }}' ? 'ring-2 ring-blue-500 border-blue-500' : 'border-white/10 hover:border-white/30'" class="w-28 aspect-video rounded-xl overflow-hidden bg-slate-900 border flex-shrink-0 transition-all">
                        <img src="{{ $product->featured_image }}" class="w-full h-full object-cover">
                    </button>
                @endif

                @if(!empty($product->gallery_images))
                    @foreach($product->gallery_images as $gImg)
                        @php
                            $imgUrl = is_array($gImg) ? ($gImg['url'] ?? '') : $gImg;
                        @endphp
                        @if($imgUrl)
                            <button @click="activeMedia = 'image'; activeImage = '{{ $imgUrl }}'" :class="activeMedia === 'image' && activeImage === '{{ $imgUrl }}' ? 'ring-2 ring-blue-500 border-blue-500' : 'border-white/10 hover:border-white/30'" class="w-28 aspect-video rounded-xl overflow-hidden bg-slate-900 border flex-shrink-0 transition-all">
                                <img src="{{ $imgUrl }}" class="w-full h-full object-cover">
                            </button>
                        @endif
                    @endforeach
                @endif

            </div>

        </div>

        <!-- Right: Fab.com Purchase & Meta Card (5 cols on lg) -->
        <div class="lg:col-span-5 space-y-6">
            <div class="rounded-3xl border border-white/10 bg-gradient-to-b from-[#11141e] to-[#0c0e15] p-6 sm:p-8 shadow-2xl space-y-6 relative overflow-hidden">
                
                <!-- Glowing corner accent -->
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-500/10 rounded-full blur-2xl pointer-events-none"></div>

                <!-- Badges -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="px-2.5 py-1 rounded-md text-[11px] font-bold font-tech uppercase tracking-wider bg-blue-500/10 text-cyan-300 border border-blue-500/30">
                        <i class="fa-solid fa-tag text-[10px] mr-1"></i> {{ $section->title }}
                    </span>
                    <span class="px-2.5 py-1 rounded-md text-[11px] font-bold font-tech uppercase tracking-wider bg-purple-500/10 text-purple-300 border border-purple-500/30">
                        {{ $product->version_compatibility }}
                    </span>
                </div>

                <!-- Product Title & Tagline -->
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white font-tech uppercase tracking-wide leading-tight">
                        {{ $product->title }}
                    </h1>
                    <p class="mt-3 text-sm text-slate-300 leading-relaxed">
                        {{ $product->tagline }}
                    </p>
                </div>

                <!-- Price Box -->
                <div class="p-4 rounded-2xl bg-white/[0.03] border border-white/5 flex items-baseline justify-between">
                    <div>
                        <span class="text-xs uppercase font-bold text-slate-500 block font-tech">Стоимость на Fab</span>
                        <div class="text-3xl font-extrabold text-white font-tech tracking-tight">
                            {{ $product->price ? '$' . number_format($product->price, 2) : 'Бесплатно' }}
                        </div>
                    </div>
                    <span class="text-xs text-slate-400 font-mono">Бессрочная лицензия</span>
                </div>

                <!-- FAB.COM BUY ACTION CTA -->
                @if($product->fab_url)
                    <div class="space-y-2">
                        <a href="{{ $product->fab_url }}" target="_blank" rel="noopener noreferrer" class="w-full py-4 px-6 rounded-2xl font-extrabold text-white bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 shadow-xl shadow-blue-500/30 flex items-center justify-center gap-3 transition-all hover:scale-[1.02] active:scale-98 text-base font-tech uppercase tracking-wider group">
                            <span>Приобрести на Fab.com</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-sm group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
                        </a>
                        <p class="text-[11px] text-center text-slate-400">
                            <i class="fa-solid fa-shield-halved text-cyan-400 mr-1"></i> Официальная покупка в защищенном маркетплейсе Epic Games
                        </p>
                    </div>
                @endif

                <!-- Technical Specs Mini Grid -->
                <div class="pt-4 border-t border-white/5 space-y-3 text-xs">
                    <div class="flex justify-between py-1 border-b border-white/5">
                        <span class="text-slate-400">Совместимость:</span>
                        <span class="text-slate-200 font-semibold">{{ $product->version_compatibility }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-white/5">
                        <span class="text-slate-400">Категория:</span>
                        <span class="text-blue-400 font-semibold">{{ $section->title }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-white/5">
                        <span class="text-slate-400">Просмотры:</span>
                        <span class="text-slate-300 font-mono"><i class="fa-regular fa-eye mr-1"></i> {{ $product->views_count }}</span>
                    </div>
                    <div class="flex justify-between py-1">
                        <span class="text-slate-400">Отзывы покупателей:</span>
                        <span class="text-amber-400 font-semibold"><i class="fa-solid fa-star text-[11px]"></i> {{ $product->comments->count() }} {{ trans_choice('отзыв|отзыва|отзывов', $product->comments->count()) }}</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- MODULAR PAGE BUILDER CONTENT (HEADINGS, SPECS, TEXT, GALLERIES, VIDEOS) -->
    <div class="max-w-4xl mx-auto mb-20">
        <div class="mb-8 flex items-center gap-3 pb-4 border-b border-white/10">
            <span class="w-2.5 h-7 bg-blue-500 rounded-sm"></span>
            <h2 class="text-2xl font-extrabold text-white font-tech uppercase tracking-wide">
                ПОДРОБНОЕ ОПИСАНИЕ И СПЕЦИФИКАЦИИ
            </h2>
        </div>

        <x-blocks.render :blocks="$product->blocks" />
    </div>

    <!-- DEVELOPER REVIEWS & COMMENTS SECTION -->
    <div class="max-w-4xl mx-auto pt-12 border-t border-white/10 mb-20" id="comments">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h3 class="text-2xl font-extrabold text-white font-tech uppercase tracking-wide flex items-center gap-2">
                    <i class="fa-solid fa-comments text-blue-400"></i>
                    Отзывы и обсуждение ({{ $product->comments->count() }})
                </h3>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">Оставьте свой отзыв или задайте вопрос по интеграции ассета в Unreal Engine.</p>
            </div>
        </div>

        <!-- Add Comment Form -->
        <div class="rounded-3xl border border-white/10 bg-[#0e1119] p-6 sm:p-8 mb-10 shadow-xl">
            <h4 class="text-base font-bold text-white font-tech uppercase mb-4 flex items-center gap-2">
                <i class="fa-solid fa-pen text-cyan-400"></i> Написать отзыв
            </h4>

            <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="commentable_type" value="product">
                <input type="hidden" name="commentable_id" value="{{ $product->id }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase font-tech">Ваше имя / Студия *</label>
                        <input type="text" name="author_name" required placeholder="Например: CyberTech Games" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase font-tech">Email (не публикуется)</label>
                        <input type="email" name="author_email" placeholder="dev@example.com" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase font-tech">Оценка ассета</label>
                        <select name="rating" class="w-full bg-[#07080b] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-amber-400 focus:outline-none focus:border-blue-500 font-semibold">
                            <option value="5">★★★★★ — 5 звёзд (Превосходно)</option>
                            <option value="4">★★★★☆ — 4 звезды (Хорошо)</option>
                            <option value="3">★★★☆☆ — 3 звезды (Нормально)</option>
                            <option value="2">★★☆☆☆ — 2 звезды (Требует доработок)</option>
                            <option value="1">★☆☆☆☆ — 1 звезда (Проблемный)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase font-tech">Ваш отзыв / Вопрос *</label>
                    <textarea name="content" rows="4" required placeholder="Поделитесь опытом использования ассета в ваших проектах..." class="w-full bg-[#07080b] border border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors leading-relaxed"></textarea>
                </div>

                <button type="submit" class="px-6 py-3 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-500 shadow-lg shadow-blue-600/30 text-xs uppercase font-tech tracking-wider transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i> Отправить отзыв
                </button>
            </form>
        </div>

        <!-- List of Existing Comments -->
        <div class="space-y-4">
            @forelse($product->comments as $comment)
                <div class="rounded-2xl border border-white/5 bg-[#0a0c12] p-6 shadow-md">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-blue-600/20 border border-blue-500/30 flex items-center justify-center text-blue-400 font-bold text-sm">
                                {{ mb_substr($comment->author_name, 0, 1) }}
                            </div>
                            <div>
                                <h5 class="text-sm font-bold text-white">{{ $comment->author_name }}</h5>
                                <span class="text-[11px] text-slate-500 font-mono">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <!-- Stars -->
                        <div class="text-amber-400 text-xs">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $i <= $comment->rating ? '' : 'text-slate-700' }}"></i>
                            @endfor
                        </div>
                    </div>

                    <p class="text-sm text-slate-300 leading-relaxed">
                        {{ $comment->content }}
                    </p>
                </div>
            @empty
                <div class="text-center py-8 text-slate-500 text-sm">
                    Пока никто не оставил отзыв. Станьте первым!
                </div>
            @endforelse
        </div>

    </div>

    <!-- RELATED ASSETS FROM THE SAME SECTION -->
    @if($relatedProducts->count() > 0)
        <div class="pt-16 border-t border-white/10">
            <h3 class="text-2xl font-extrabold text-white font-tech uppercase tracking-wide mb-8">
                ДРУГИЕ АССЕТЫ ИЗ РАЗДЕЛА "{{ $section->title }}"
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedProducts as $rel)
                    <a href="{{ route('catalog.product', ['section_slug' => $section->slug, 'product_slug' => $rel->slug]) }}" class="group rounded-2xl bg-[#0e1017] border border-white/10 hover:border-blue-500/50 transition-all overflow-hidden flex flex-col shadow-lg">
                        <div class="aspect-video relative overflow-hidden bg-slate-900">
                            <img src="{{ $rel->featured_image }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <span class="absolute top-2 right-2 px-2 py-0.5 rounded text-[10px] font-bold font-tech bg-blue-600 text-white">
                                {{ $rel->version_compatibility }}
                            </span>
                        </div>
                        <div class="p-4 flex-grow flex flex-col justify-between">
                            <h4 class="font-bold text-white font-tech group-hover:text-blue-400 transition-colors line-clamp-1">
                                {{ $rel->title }}
                            </h4>
                            <div class="mt-3 pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                                <span class="font-bold text-white font-tech text-base">
                                    {{ $rel->price ? '$' . number_format($rel->price, 2) : 'Бесплатно' }}
                                </span>
                                <span class="text-blue-400 font-semibold">Смотреть →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
