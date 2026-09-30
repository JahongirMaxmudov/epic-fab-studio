@props(['blocks' => []])

@if(!empty($blocks) && is_array($blocks))
    <div class="space-y-10 block-content-wrapper">
        @foreach($blocks as $index => $block)
            @php
                $type = $block['type'] ?? 'text';
            @endphp

            @if($type === 'heading')
                <div class="relative pt-4 pb-2 border-b border-white/5">
                    @if(!empty($block['badge']))
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold tracking-wider uppercase bg-blue-500/10 text-blue-400 border border-blue-500/30 mb-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                            {{ $block['badge'] }}
                        </span>
                    @endif

                    @php
                        $level = $block['level'] ?? 'h2';
                    @endphp

                    @if($level === 'h3')
                        <h3 class="text-xl md:text-2xl font-bold text-white tracking-tight flex items-center gap-2">
                            <span class="text-blue-500">#</span> {{ $block['content'] ?? '' }}
                        </h3>
                    @elseif($level === 'h4')
                        <h4 class="text-lg md:text-xl font-semibold text-slate-200 tracking-tight">
                            {{ $block['content'] ?? '' }}
                        </h4>
                    @else
                        <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-gradient-to-b from-blue-500 to-cyan-400 rounded-sm"></span>
                            {{ $block['content'] ?? '' }}
                        </h2>
                    @endif
                </div>

            @elseif($type === 'text')
                <div class="prose prose-invert max-w-none text-slate-300 leading-relaxed text-base md:text-lg">
                    {!! $block['content'] ?? '' !!}
                </div>

            @elseif($type === 'image')
                <figure class="relative rounded-2xl overflow-hidden border border-white/10 bg-slate-900/60 shadow-2xl group">
                    <img src="{{ $block['url'] ?? '' }}" alt="{{ $block['title'] ?? 'Product Media' }}" class="w-full h-auto object-cover max-h-[600px] transition-transform duration-500 group-hover:scale-[1.01]" loading="lazy">
                    @if(!empty($block['title']) || !empty($block['caption']))
                        <figcaption class="p-4 bg-gradient-to-t from-black/90 to-transparent border-t border-white/5">
                            @if(!empty($block['title']))
                                <div class="font-bold text-white text-base">{{ $block['title'] }}</div>
                            @endif
                            @if(!empty($block['caption']))
                                <div class="text-xs text-slate-400 mt-0.5">{{ $block['caption'] }}</div>
                            @endif
                        </figcaption>
                    @endif
                </figure>

            @elseif($type === 'gallery')
                <div class="space-y-4">
                    @if(!empty($block['title']))
                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                            <i class="fa-solid fa-images text-cyan-400"></i>
                            {{ $block['title'] }}
                        </h3>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($block['images'] ?? [] as $img)
                            <a href="{{ is_array($img) ? ($img['url'] ?? '') : $img }}" target="_blank" class="group relative rounded-xl overflow-hidden border border-white/10 bg-slate-900 aspect-video block shadow-lg hover:border-blue-500/50 transition-all">
                                <img src="{{ is_array($img) ? ($img['url'] ?? '') : $img }}" alt="{{ is_array($img) ? ($img['title'] ?? 'Скриншот') : 'Скриншот' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-3">
                                    <span class="text-xs font-medium text-white truncate flex items-center gap-1.5">
                                        <i class="fa-solid fa-magnifying-glass-plus text-blue-400"></i>
                                        {{ is_array($img) ? ($img['title'] ?? 'Увеличить скриншот') : 'Увеличить' }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

            @elseif($type === 'video')
                <div class="space-y-3">
                    @if(!empty($block['title']))
                        <h3 class="text-xl font-bold text-white flex items-center gap-2">
                            <i class="fa-solid fa-circle-play text-red-500"></i>
                            {{ $block['title'] }}
                        </h3>
                    @endif
                    <div class="relative rounded-2xl overflow-hidden border border-white/10 bg-black aspect-video shadow-2xl">
                        @php
                            $videoUrl = $block['url'] ?? '';
                            // Auto-convert standard YouTube watch URLs to embed format
                            if (str_contains($videoUrl, 'watch?v=')) {
                                $videoUrl = str_replace('watch?v=', 'embed/', $videoUrl);
                            } elseif (str_contains($videoUrl, 'youtu.be/')) {
                                $videoUrl = str_replace('youtu.be/', 'www.youtube.com/embed/', $videoUrl);
                            }
                        @endphp
                        <iframe src="{{ $videoUrl }}" title="{{ $block['title'] ?? 'Video player' }}" class="w-full h-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>

            @elseif($type === 'fab_button')
                <div class="p-6 md:p-8 rounded-2xl border border-blue-500/30 bg-gradient-to-r from-blue-950/40 via-slate-900/80 to-blue-950/40 backdrop-blur-xl shadow-2xl flex flex-col sm:flex-row items-center justify-between gap-6 relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="space-y-1 text-center sm:text-left">
                        <div class="flex items-center justify-center sm:justify-start gap-2 mb-1">
                            <span class="px-2.5 py-0.5 rounded text-[11px] font-bold uppercase tracking-wider bg-blue-500/20 text-blue-400 border border-blue-500/30">
                                {{ $block['badge'] ?? 'Epic Games Marketplace' }}
                            </span>
                        </div>
                        <h4 class="text-xl md:text-2xl font-bold text-white">{{ $block['title'] ?? 'Купить на Fab.com' }}</h4>
                        <p class="text-sm text-slate-400">Официальная страница ассета с мгновенной привязкой к библиотеке Epic Games Launcher</p>
                    </div>
                    <div class="flex items-center gap-4 flex-shrink-0">
                        @if(!empty($block['price']))
                            <div class="text-right">
                                <span class="text-xs text-slate-400 block uppercase">Стоимость</span>
                                <span class="text-2xl font-extrabold text-white">{{ $block['price'] }}</span>
                            </div>
                        @endif
                        <a href="{{ $block['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="px-7 py-3.5 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 shadow-lg shadow-blue-500/25 flex items-center gap-3 transition-all hover:scale-105 active:scale-95 text-base">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            Fab.com
                        </a>
                    </div>
                </div>

            @elseif($type === 'specs')
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-microchip text-blue-400"></i>
                        Технические характеристики
                    </h3>
                    <div class="rounded-2xl border border-white/10 overflow-hidden bg-slate-900/60 divide-y divide-white/5">
                        @foreach($block['items'] ?? [] as $spec)
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 hover:bg-white/[0.02] transition-colors gap-1 sm:gap-4">
                                <span class="text-sm font-semibold text-slate-400">{{ $spec['label'] ?? '' }}</span>
                                <span class="text-sm font-medium text-slate-200 text-left sm:text-right">{{ $spec['value'] ?? '' }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            @elseif($type === 'code')
                <div class="rounded-2xl border border-white/10 overflow-hidden bg-[#0a0c12] shadow-2xl">
                    <div class="px-4 py-2.5 bg-white/5 border-b border-white/10 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-red-500/60"></span>
                            <span class="w-3 h-3 rounded-full bg-yellow-500/60"></span>
                            <span class="w-3 h-3 rounded-full bg-green-500/60"></span>
                            <span class="text-xs font-mono text-slate-400 ml-2">{{ $block['title'] ?? ($block['language'] ?? 'code') }}</span>
                        </div>
                        <span class="text-[11px] font-mono uppercase text-blue-400 font-semibold">{{ $block['language'] ?? 'cpp' }}</span>
                    </div>
                    <pre class="p-4 text-sm font-mono text-cyan-300/90 overflow-x-auto leading-relaxed"><code>{{ $block['code'] ?? '' }}</code></pre>
                </div>
            @endif
        @endforeach
    </div>
@endif
