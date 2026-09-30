<!DOCTYPE html>
<html lang="ru" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Epic Fab Studio — Инструменты и ассеты для Unreal Engine 5 на Fab.com')</title>
    <meta name="description" content="@yield('meta_description', 'Премиальные C++ плагины, Niagara шейдеры и Nanite 3D ассеты для Unreal Engine 5. Доступно на Fab.com Marketplace.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Rajdhani:wght@500;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Tailwind CSS (CDN for instant styling + animations) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        epic: {
                            bg: '#07080b',
                            card: '#0f1118',
                            border: '#1e2230',
                            blue: '#007dfc',
                            cyan: '#00dfa2',
                            purple: '#8b5cf6',
                            gold: '#f59e0b',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        tech: ['Rajdhani', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js for lightweight reactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <style>
        body {
            background-color: #07080b;
            color: #e2e8f0;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* Unreal Engine / Fab Cyber Grid effect */
        .ue-grid-bg {
            background-image: 
                radial-gradient(circle at 50% 0%, rgba(0, 125, 252, 0.15) 0%, transparent 60%),
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 100% 100%, 48px 48px, 48px 48px;
        }

        .glow-blue {
            box-shadow: 0 0 25px rgba(0, 125, 252, 0.35);
        }

        .glow-border {
            border-color: rgba(0, 125, 252, 0.4);
            box-shadow: inset 0 0 15px rgba(0, 125, 252, 0.15), 0 0 20px rgba(0, 125, 252, 0.2);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #07080b;
        }
        ::-webkit-scrollbar-thumb {
            background: #1e2230;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #007dfc;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col ue-grid-bg selection:bg-blue-600 selection:text-white antialiased" x-data="{ mobileMenu: false }">

    <!-- Top Glow Line -->
    <div class="h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-purple-600 w-full fixed top-0 left-0 z-50"></div>

    <!-- Navigation Header -->
    <header class="sticky top-0 z-40 bg-[#07080b]/85 backdrop-blur-xl border-b border-white/5 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo & Brand -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-blue-600 via-blue-500 to-cyan-400 p-[1.5px] shadow-lg shadow-blue-500/20 group-hover:shadow-blue-500/40 transition-all">
                            <div class="w-full h-full bg-[#07080b] rounded-[10px] flex items-center justify-center">
                                <span class="font-tech font-bold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300 group-hover:scale-110 transition-transform">
                                    <i class="fa-brands fa-unreal"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-tech font-extrabold text-xl tracking-wider text-white group-hover:text-blue-400 transition-colors">
                                    {{ \App\Models\Setting::get('site_name', 'EPIC FAB STUDIO') }}
                                </span>
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-widest bg-blue-500/20 text-cyan-300 border border-blue-500/30">UE 5</span>
                            </div>
                            <span class="text-[11px] text-slate-400 tracking-tight block -mt-1 font-medium">Marketplace & DevLog</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-1 bg-[#0f1118]/80 px-3 py-1.5 rounded-full border border-white/5 shadow-inner">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('home') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30' : 'text-slate-300 hover:text-white hover:bg-white/5' }}">
                        <i class="fa-solid fa-home text-xs mr-1.5 opacity-70"></i> Главная
                    </a>
                    
                    <a href="{{ route('home') }}#catalog-tiles" class="px-4 py-2 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('catalog.*') ? 'bg-blue-600/30 text-blue-300 border border-blue-500/30' : 'text-slate-300 hover:text-white hover:bg-white/5' }}">
                        <i class="fa-solid fa-shapes text-xs mr-1.5 opacity-70"></i> Разделы & Плитка
                    </a>

                    <a href="{{ route('news.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold transition-all {{ request()->routeIs('news.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30' : 'text-slate-300 hover:text-white hover:bg-white/5' }}">
                        <i class="fa-solid fa-newspaper text-xs mr-1.5 opacity-70"></i> DevLog / Новости
                    </a>
                </nav>

                <!-- Right Actions: Fab Button + Admin Lock -->
                <div class="hidden sm:flex items-center gap-3">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-purple-600/20 text-purple-300 border border-purple-500/30 hover:bg-purple-600/30 transition-all flex items-center gap-2">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                Админка
                            </a>
                        @endif
                    @endauth

                    <a href="{{ \App\Models\Setting::get('fab_store_url', 'https://www.fab.com') }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 shadow-md shadow-blue-500/25 transition-all flex items-center gap-2 group hover:scale-[1.02] active:scale-95">
                        <span>Fab.com Store</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:text-white focus:outline-none">
                    <i class="fa-solid fa-bars text-lg" x-show="!mobileMenu"></i>
                    <i class="fa-solid fa-xmark text-lg" x-show="mobileMenu" style="display: none;"></i>
                </button>

            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileMenu" x-transition class="md:hidden border-b border-white/10 bg-[#0a0c12]/95 px-4 pt-3 pb-5 space-y-3" style="display: none;">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-200 hover:bg-white/5">
                <i class="fa-solid fa-home w-6 text-blue-400"></i> Главная
            </a>
            <a href="{{ route('home') }}#catalog-tiles" @click="mobileMenu = false" class="block px-3 py-2 rounded-lg font-medium text-slate-200 hover:bg-white/5">
                <i class="fa-solid fa-shapes w-6 text-cyan-400"></i> Разделы & Плитка
            </a>
            <a href="{{ route('news.index') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-200 hover:bg-white/5">
                <i class="fa-solid fa-newspaper w-6 text-purple-400"></i> DevLog / Новости
            </a>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg font-medium text-purple-300 hover:bg-purple-950/40">
                        <i class="fa-solid fa-screwdriver-wrench w-6"></i> Панель управления
                    </a>
                @endif
            @endauth
            <a href="{{ \App\Models\Setting::get('fab_store_url', 'https://www.fab.com') }}" target="_blank" class="block w-full text-center py-2.5 rounded-xl font-bold text-xs uppercase bg-blue-600 text-white">
                Магазин на Fab.com <i class="fa-solid fa-arrow-up-right-from-square ml-1"></i>
            </a>
        </div>
    </header>

    <!-- Flash Notifications -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-950/50 border border-emerald-500/40 text-emerald-300 text-sm flex items-center justify-between backdrop-blur-md shadow-lg" x-data="{ show: true }" x-show="show">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-xl bg-red-950/50 border border-red-500/40 text-red-300 text-sm flex items-center justify-between backdrop-blur-md shadow-lg" x-data="{ show: true }" x-show="show">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-triangle-exclamation text-red-400 text-lg"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-red-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        @if(session('info'))
            <div class="p-4 rounded-xl bg-blue-950/50 border border-blue-500/40 text-blue-300 text-sm flex items-center justify-between backdrop-blur-md shadow-lg" x-data="{ show: true }" x-show="show">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-info text-blue-400 text-lg"></i>
                    <span>{{ session('info') }}</span>
                </div>
                <button @click="show = false" class="text-blue-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif
    </div>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-24 border-t border-white/10 bg-[#050608] relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                
                <!-- Col 1: Studio Info -->
                <div class="space-y-4 md:col-span-2">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center text-white text-lg font-bold">
                            <i class="fa-brands fa-unreal"></i>
                        </div>
                        <span class="font-tech font-extrabold text-xl tracking-wider text-white">
                            {{ \App\Models\Setting::get('site_name', 'EPIC FAB STUDIO') }}
                        </span>
                    </div>
                    <p class="text-sm text-slate-400 max-w-md leading-relaxed">
                        {{ \App\Models\Setting::get('site_tagline', 'Премиальные плагины, шейдеры и ассеты для Unreal Engine 5 на Fab.com') }}
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        @if(\App\Models\Setting::get('discord_url'))
                            <a href="{{ \App\Models\Setting::get('discord_url') }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:text-white hover:bg-blue-600 hover:border-blue-500 transition-all">
                                <i class="fa-brands fa-discord"></i>
                            </a>
                        @endif
                        @if(\App\Models\Setting::get('youtube_url'))
                            <a href="{{ \App\Models\Setting::get('youtube_url') }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:text-white hover:bg-red-600 hover:border-red-500 transition-all">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        @endif
                        <a href="{{ \App\Models\Setting::get('fab_store_url', 'https://www.fab.com') }}" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 hover:text-white hover:bg-cyan-500 hover:border-cyan-400 transition-all">
                            <i class="fa-solid fa-store"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div class="space-y-3">
                    <h5 class="text-xs font-bold text-slate-200 uppercase tracking-wider font-tech">Навигация</h5>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors">Главная страница</a></li>
                        <li><a href="{{ route('home') }}#catalog-tiles" class="hover:text-blue-400 transition-colors">Разделы ассетов</a></li>
                        <li><a href="{{ route('news.index') }}" class="hover:text-blue-400 transition-colors">Девлог и новости</a></li>
                        <li><a href="{{ route('admin.login') }}" class="text-xs text-slate-500 hover:text-slate-400 flex items-center gap-1.5"><i class="fa-solid fa-lock text-[10px]"></i> Панель автора</a></li>
                    </ul>
                </div>

                <!-- Col 3: Fab & Unreal Notice -->
                <div class="space-y-3">
                    <h5 class="text-xs font-bold text-slate-200 uppercase tracking-wider font-tech">Правовая информация</h5>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Unreal, Unreal Engine, Fab, and Epic Games are trademarks or registered trademarks of Epic Games, Inc. in the United States of America and elsewhere. This independent creator studio is not affiliated directly with Epic Games, Inc.
                    </p>
                </div>

            </div>

            <div class="mt-12 pt-8 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <div>&copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'Epic Fab Studio') }}. Все права защищены.</div>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Unreal Engine 5.3 — 5.5 Production Ready</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
