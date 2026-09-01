<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ATFALAH PRIVATE — Qur\'an & Islamic Studies Programs')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        },
                        gold: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        arabic: ['Amiri', 'Traditional Arabic', 'serif'],
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Google Fonts (Inter & Amiri) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .font-arabic { font-family: 'Amiri', serif; }
    </style>
    @yield('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">
    <!-- Top Bar Notice -->
    <div class="bg-primary-900 text-primary-100 text-xs py-2 px-4 text-center font-medium tracking-wide">
        ✨ Program Pembelajaran Privat Al-Qur'an & Islamic Studies Personal Berbasis Progress. <a href="{{ route('assessment') }}" class="underline text-gold-400 font-semibold ml-1 hover:text-white">Cek Rekomendasi Level Belajarmu &rarr;</a>
    </div>

    <!-- Navigation -->
    <header class="bg-white/95 backdrop-blur border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-primary-800 to-primary-600 flex items-center justify-center text-white shadow-md shadow-primary-700/20 group-hover:scale-105 transition-transform">
                    <span class="font-bold text-xl tracking-tighter">أ</span>
                </div>
                <div>
                    <div class="font-extrabold text-xl tracking-tight text-slate-900 leading-tight">ATFALAH <span class="text-primary-700">PRIVATE</span></div>
                    <div class="text-[10px] tracking-wider uppercase text-slate-500 font-semibold">Qur'an & Islamic Studies</div>
                </div>
            </a>

            <!-- Desktop Nav Items -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <a href="{{ route('home') }}" class="hover:text-primary-700 transition-colors {{ request()->routeIs('home') ? 'text-primary-700 font-semibold' : '' }}">Beranda</a>
                <a href="{{ route('programs') }}" class="hover:text-primary-700 transition-colors {{ request()->routeIs('programs*') ? 'text-primary-700 font-semibold' : '' }}">Program</a>
                <a href="{{ route('learning.method') }}" class="hover:text-primary-700 transition-colors {{ request()->routeIs('learning.method') ? 'text-primary-700 font-semibold' : '' }}">Metode</a>
                <a href="{{ route('teachers') }}" class="hover:text-primary-700 transition-colors {{ request()->routeIs('teachers') ? 'text-primary-700 font-semibold' : '' }}">Pengajar</a>
                <a href="{{ route('about') }}" class="hover:text-primary-700 transition-colors {{ request()->routeIs('about') ? 'text-primary-700 font-semibold' : '' }}">Tentang Kami</a>
                <a href="{{ route('faq') }}" class="hover:text-primary-700 transition-colors {{ request()->routeIs('faq') ? 'text-primary-700 font-semibold' : '' }}">FAQ</a>
            </nav>

            <!-- Action Buttons -->
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('assessment') }}" class="px-4 py-2 text-xs font-semibold rounded-xl border border-primary-600 text-primary-700 hover:bg-primary-50 transition-colors">
                    Placement Test
                </a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-xs font-semibold rounded-xl bg-slate-900 text-white hover:bg-slate-800 transition-colors shadow">
                            Admin Portal
                        </a>
                    @elseif(auth()->user()->isTeacher())
                        <a href="{{ route('teacher.dashboard') }}" class="px-4 py-2 text-xs font-semibold rounded-xl bg-primary-700 text-white hover:bg-primary-800 transition-colors shadow">
                            Teacher Portal
                        </a>
                    @else
                        <a href="{{ route('student.dashboard') }}" class="px-4 py-2 text-xs font-semibold rounded-xl bg-primary-700 text-white hover:bg-primary-800 transition-colors shadow">
                            Dashboard Student
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-semibold text-slate-700 hover:text-primary-700 transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-xs font-semibold rounded-xl bg-primary-700 text-white hover:bg-primary-800 transition-all shadow-md shadow-primary-700/20 hover:shadow-lg hover:-translate-y-0.5">
                        Daftar Belajar
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle (Alpine) -->
            <div class="md:hidden flex items-center" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 text-slate-600 hover:text-slate-900 focus:outline-none">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <div x-show="open" @click.outside="open = false" x-transition class="absolute top-20 left-0 right-0 bg-white border-b border-slate-100 p-6 shadow-xl space-y-4 flex flex-col">
                    <a href="{{ route('home') }}" class="text-slate-700 font-medium">Beranda</a>
                    <a href="{{ route('programs') }}" class="text-slate-700 font-medium">Program</a>
                    <a href="{{ route('learning.method') }}" class="text-slate-700 font-medium">Metode Belajar</a>
                    <a href="{{ route('teachers') }}" class="text-slate-700 font-medium">Pengajar</a>
                    <a href="{{ route('about') }}" class="text-slate-700 font-medium">Tentang Kami</a>
                    <a href="{{ route('assessment') }}" class="text-primary-700 font-semibold">Placement Assessment</a>
                    <div class="pt-4 border-t border-slate-100 flex flex-col gap-2">
                        @auth
                            <a href="{{ route('login') }}" class="w-full text-center py-2.5 bg-primary-700 text-white rounded-xl font-semibold text-sm">Masuk Portal</a>
                        @else
                            <a href="{{ route('login') }}" class="w-full text-center py-2 text-slate-700 font-medium text-sm">Masuk</a>
                            <a href="{{ route('register') }}" class="w-full text-center py-2.5 bg-primary-700 text-white rounded-xl font-semibold text-sm">Daftar Sekarang</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Body Content -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 mt-6">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl flex items-center gap-3">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 mt-6">
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-2xl flex items-center gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-12 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <!-- Brand Info -->
                <div class="md:col-span-1 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-primary-600 to-primary-400 flex items-center justify-center text-white font-bold text-lg">
                            أ
                        </div>
                        <span class="font-bold text-white text-lg tracking-tight">ATFALAH PRIVATE</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Layanan pembelajaran Al-Qur'an dan Islamic Studies secara privat, personal, dan progress-based. Membimbing perjalanan belajar Anda dari nol hingga mentadabburi ayat.
                    </p>
                    <div class="pt-2 text-xs text-gold-400 font-medium">
                        "Read. Improve. Understand. Live."
                    </div>
                </div>

                <!-- Programs Navigation -->
                <div>
                    <h4 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">Program Pembelajaran</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li><a href="{{ route('programs.detail', 'reading-class') }}" class="hover:text-white transition-colors">Reading Class (From Zero)</a></li>
                        <li><a href="{{ route('programs.detail', 'tahsin-tajwid') }}" class="hover:text-white transition-colors">Tahsin & Tajwid</a></li>
                        <li><a href="{{ route('programs.detail', 'tahsin-tadabbur') }}" class="hover:text-white transition-colors">Tahsin & Tadabbur</a></li>
                        <li><a href="{{ route('programs.detail', 'islamic-studies') }}" class="hover:text-white transition-colors">Islamic Studies (Fardhu 'Ain)</a></li>
                        <li><a href="{{ route('assessment') }}" class="hover:text-white text-gold-400 font-semibold transition-colors">Placement Assessment &rarr;</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">Akses & Layanan</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li><a href="{{ route('learning.method') }}" class="hover:text-white transition-colors">Metode & Filosofi</a></li>
                        <li><a href="{{ route('teachers') }}" class="hover:text-white transition-colors">Profil Dewan Guru</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Visi & Misi</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-white transition-colors">Tanya Jawab (FAQ)</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Hubungi Admin Konsultasi</a></li>
                    </ul>
                </div>

                <!-- Contact & Office -->
                <div>
                    <h4 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">Konsultasi & Pendaftaran</h4>
                    <p class="text-xs text-slate-400 mb-3 leading-relaxed">
                        Ingin konsultasi pemilihan jadwal atau rekomendasi guru sebelum mendaftar?
                    </p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-semibold transition-colors shadow">
                        <i data-lucide="message-circle" class="w-4 h-4"></i> WhatsApp Konsultan
                    </a>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-800 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} ATFALAH PRIVATE — All Rights Reserved.</p>
                <div class="flex items-center gap-6 mt-4 md:mt-0">
                    <a href="{{ route('login') }}" class="hover:text-slate-300">Staff & Student Login</a>
                    <span>•</span>
                    <span>Versi MVP 1.0</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
    @yield('scripts')
</body>
</html>