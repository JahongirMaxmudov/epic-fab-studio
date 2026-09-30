<!DOCTYPE html>
<html lang="ru" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Панель управления — Epic Fab Studio')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Rajdhani:wght@600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        epic: {
                            bg: '#080a0f',
                            sidebar: '#0d0f17',
                            card: '#121520',
                            border: '#1e2333',
                            blue: '#007dfc',
                            cyan: '#00dfa2',
                            purple: '#8b5cf6',
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

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <style>
        body {
            background-color: #080a0f;
            color: #e2e8f0;
            font-family: 'Inter', sans-serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #080a0f;
        }
        ::-webkit-scrollbar-thumb {
            background: #1e2333;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #007dfc;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex bg-[#080a0f]" x-data="{ sidebarOpen: false }">

    <!-- Top Accent Bar -->
    <div class="h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-purple-600 w-full fixed top-0 left-0 z-50"></div>

    <!-- Admin Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" class="fixed md:static inset-y-0 left-0 z-40 w-64 bg-[#0d0f17] border-r border-white/5 flex flex-col justify-between transition-transform duration-300">
        
        <div>
            <!-- Admin Brand -->
            <div class="h-20 flex items-center gap-3 px-6 border-b border-white/5">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center text-white text-xl shadow-lg shadow-blue-500/20">
                    <i class="fa-brands fa-unreal"></i>
                </div>
                <div>
                    <span class="font-tech font-bold text-lg text-white tracking-wider block">EPIC FAB STUDIO</span>
                    <span class="text-[10px] font-mono text-cyan-400 uppercase tracking-widest">Admin Workspace</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider font-tech transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-chart-line text-sm w-5"></i>
                    Дашборд
                </a>

                <a href="{{ route('admin.sections.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider font-tech transition-all {{ request()->routeIs('admin.sections.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-layer-group text-sm w-5"></i>
                    Разделы (Плитка)
                </a>

                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider font-tech transition-all {{ request()->routeIs('admin.products.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-boxes-stacked text-sm w-5"></i>
                    Продукты & Конструктор
                </a>

                <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider font-tech transition-all {{ request()->routeIs('admin.news.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-newspaper text-sm w-5"></i>
                    Новости & Девлог
                </a>

                <a href="{{ route('admin.comments.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider font-tech transition-all {{ request()->routeIs('admin.comments.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-comments text-sm w-5"></i>
                    Отзывы & Модерация
                </a>

                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider font-tech transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-gear text-sm w-5"></i>
                    Настройки сайта
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-white/5 space-y-2">
            <a href="{{ route('home') }}" target="_blank" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-300 bg-white/5 hover:bg-white/10 hover:text-cyan-300 transition-all font-tech uppercase tracking-wider">
                <span>Перейти на сайт</span>
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-red-400 hover:bg-red-500/10 transition-all font-tech uppercase tracking-wider">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Выйти
                </button>
            </form>
        </div>

    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col min-w-0">
        
        <!-- Top Header Bar -->
        <header class="h-20 bg-[#0d0f17]/80 backdrop-blur-md border-b border-white/5 px-6 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-slate-400 hover:text-white">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <h1 class="text-lg font-bold text-white font-tech uppercase tracking-wider">
                    @yield('header_title', 'Панель управления')
                </h1>
            </div>

            <!-- Profile & Quick Action -->
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.products.create') }}" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs uppercase font-tech tracking-wider shadow-md shadow-blue-600/30 flex items-center gap-2 transition-all">
                    <i class="fa-solid fa-plus text-[10px]"></i>
                    <span class="hidden sm:inline">Новый продукт</span>
                </a>

                <div class="flex items-center gap-3 pl-4 border-l border-white/5">
                    <div class="w-8 h-8 rounded-full bg-blue-500/20 text-cyan-300 font-bold text-xs flex items-center justify-center border border-blue-500/30">
                        A
                    </div>
                    <span class="text-xs font-semibold text-slate-300 hidden sm:inline">{{ auth()->user()->name ?? 'Администратор' }}</span>
                </div>
            </div>
        </header>

        <!-- Flash alerts -->
        <div class="px-6 pt-4">
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-950/60 border border-emerald-500/40 text-emerald-300 text-sm flex items-center gap-3 backdrop-blur-md shadow-lg mb-4">
                    <i class="fa-solid fa-circle-check text-emerald-400"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-xl bg-red-950/60 border border-red-500/40 text-red-300 text-sm flex items-center gap-3 backdrop-blur-md shadow-lg mb-4">
                    <i class="fa-solid fa-triangle-exclamation text-red-400"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <!-- View Content -->
        <main class="p-6 flex-grow">
            @yield('content')
        </main>

    </div>

    @stack('scripts')
</body>
</html>
