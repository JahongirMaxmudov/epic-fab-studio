<!DOCTYPE html>
<html lang="ru" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в панель управления — Epic Fab Studio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Rajdhani:wght@600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        tech: ['Rajdhani', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-[#07080b] flex items-center justify-center p-4 selection:bg-blue-600 selection:text-white relative overflow-hidden">

    <!-- Background glowing orbs -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[350px] bg-blue-600/15 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Brand Header -->
        <div class="text-center mb-8">
            <div class="inline-flex w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-400 p-[1.5px] shadow-xl shadow-blue-500/25 mb-4">
                <div class="w-full h-full bg-[#07080b] rounded-[14px] flex items-center justify-center text-3xl text-cyan-400">
                    <i class="fa-brands fa-unreal"></i>
                </div>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white font-tech uppercase tracking-wider">
                EPIC FAB STUDIO
            </h1>
            <p class="text-xs text-slate-400 mt-1 uppercase tracking-widest font-mono">Панель управления создателя</p>
        </div>

        <!-- Login Card -->
        <div class="rounded-3xl border border-white/10 bg-[#0e111a]/90 backdrop-blur-xl p-8 shadow-2xl space-y-6">
            
            @if($errors->any())
                <div class="p-4 rounded-xl bg-red-950/60 border border-red-500/40 text-red-300 text-xs">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider font-tech mb-1.5">Email администратора</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-4 top-3 text-slate-500 text-xs"></i>
                        <input type="email" name="email" value="{{ old('email', 'admin@example.com') }}" required class="w-full bg-[#07080b] border border-white/10 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider font-tech mb-1.5">Пароль</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-3 text-slate-500 text-xs"></i>
                        <input type="password" name="password" value="password123" required class="w-full bg-[#07080b] border border-white/10 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" checked class="rounded border-white/10 bg-black text-blue-600 focus:ring-0">
                        <span>Запомнить меня</span>
                    </label>
                    <span class="text-[11px] text-slate-500 font-mono">admin@example.com / password123</span>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 shadow-lg shadow-blue-500/30 text-xs uppercase font-tech tracking-wider transition-all hover:scale-[1.01] active:scale-98">
                    Войти в систему
                </button>
            </form>

            <div class="pt-4 border-t border-white/5 text-center">
                <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-white transition-colors">
                    ← Вернуться на главную страницу сайта
                </a>
            </div>

        </div>

    </div>

</body>
</html>
