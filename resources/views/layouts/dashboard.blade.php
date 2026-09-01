<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — ATFALAH PRIVATE</title>
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
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @yield('styles')
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition class="fixed inset-0 bg-slate-900/50 z-40 lg:hidden"></div>

    <!-- Sidebar Navigation -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 flex flex-col transition-transform duration-200 ease-in-out border-r border-slate-800">
        <!-- Brand Header -->
        <div class="h-20 flex items-center px-6 border-b border-slate-800 justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-primary-600 to-primary-400 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                    أ
                </div>
                <div>
                    <div class="font-extrabold text-white text-base tracking-tight leading-none">ATFALAH</div>
                    <div class="text-[9px] uppercase tracking-widest text-primary-400 font-semibold mt-1">
                        @if(auth()->user()->isAdmin()) ADMIN PORTAL @elseif(auth()->user()->isTeacher()) TEACHER PORTAL @else STUDENT PORTAL @endif
                    </div>
                </div>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Role-based Navigation Links -->
        <div class="flex-1 overflow-y-auto px-4 py-6 space-y-1">
            @if(auth()->user()->isAdmin())
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mb-2">Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary-800 text-white font-semibold shadow' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 text-primary-400"></i> Dashboard
                </a>
                
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mt-6 mb-2">Master Data</div>
                <a href="{{ route('admin.students.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.students*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="users" class="w-4 h-4 text-emerald-400"></i> Students
                </a>
                <a href="{{ route('admin.teachers.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.teachers*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="graduation-cap" class="w-4 h-4 text-indigo-400"></i> Teachers
                </a>
                <a href="{{ route('admin.programs.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.programs*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="book-open" class="w-4 h-4 text-amber-400"></i> Programs & Silabus
                </a>

                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mt-6 mb-2">Operasional</div>
                <a href="{{ route('admin.enrollments.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.enrollments*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="clipboard-list" class="w-4 h-4 text-sky-400"></i> Enrollments
                </a>
                <a href="{{ route('admin.classes.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.classes*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="school" class="w-4 h-4 text-purple-400"></i> Classes & Pairing
                </a>
                <a href="{{ route('admin.schedules.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.schedules*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="calendar" class="w-4 h-4 text-rose-400"></i> Sesi & Jadwal
                </a>
                <a href="{{ route('admin.payments.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.payments*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="credit-card" class="w-4 h-4 text-teal-400"></i> Invoices & Payments
                </a>

                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mt-6 mb-2">CMS & Web</div>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.settings*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="sliders" class="w-4 h-4 text-pink-400"></i> CMS Landing Page
                </a>

            @elseif(auth()->user()->isTeacher())
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mb-2">Aktivitas Mengajar</div>
                <a href="{{ route('teacher.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('teacher.dashboard') ? 'bg-primary-800 text-white font-semibold shadow' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 text-primary-400"></i> Dashboard Guru
                </a>
                <a href="{{ route('teacher.classes') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('teacher.classes*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="users" class="w-4 h-4 text-emerald-400"></i> Kelas & Siswa
                </a>
                <a href="{{ route('teacher.schedules') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('teacher.schedules*') || request()->routeIs('teacher.attendance*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="calendar" class="w-4 h-4 text-amber-400"></i> Jadwal & Presensi
                </a>

                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mt-6 mb-2">Evaluasi & Feedback</div>
                <a href="{{ route('teacher.assessments') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('teacher.assessments*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="award" class="w-4 h-4 text-purple-400"></i> Input Assessment
                </a>
                <a href="{{ route('teacher.feedback') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('teacher.feedback*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="message-square" class="w-4 h-4 text-sky-400"></i> Teacher Feedback
                </a>

            @else
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mb-2">Pembelajaran Saya</div>
                <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('student.dashboard') ? 'bg-primary-800 text-white font-semibold shadow' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4 text-primary-400"></i> Ringkasan Belajar
                </a>
                <a href="{{ route('student.programs') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('student.programs*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="book-open" class="w-4 h-4 text-emerald-400"></i> Program Saya
                </a>
                <a href="{{ route('student.schedule') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('student.schedule*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="calendar" class="w-4 h-4 text-amber-400"></i> Jadwal & Link Sesi
                </a>
                <a href="{{ route('student.materials') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('student.materials*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="file-text" class="w-4 h-4 text-indigo-400"></i> Materi & E-Book
                </a>

                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mt-6 mb-2">Evaluasi & Rekap</div>
                <a href="{{ route('student.progress') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('student.progress*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="trending-up" class="w-4 h-4 text-teal-400"></i> Progress & Feedback
                </a>
                <a href="{{ route('student.attendances') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('student.attendances*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="check-square" class="w-4 h-4 text-sky-400"></i> Rekap Kehadiran
                </a>
                <a href="{{ route('student.payments') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('student.payments*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="receipt" class="w-4 h-4 text-purple-400"></i> Tagihan / Invoice
                </a>
                <a href="{{ route('student.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('student.profile*') ? 'bg-primary-800 text-white font-semibold' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                    <i data-lucide="user" class="w-4 h-4 text-rose-400"></i> Profil Saya
                </a>
            @endif
        </div>

        <!-- User Profile Quick Card & Logout -->
        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-primary-900 text-primary-300 flex items-center justify-center font-bold text-sm border border-primary-700/50">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-xs font-semibold text-white truncate">{{ auth()->user()->name }}</div>
                    <div class="text-[11px] text-slate-400 truncate">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl text-xs font-medium text-rose-400 bg-rose-950/40 hover:bg-rose-900/60 border border-rose-900/50 transition-colors">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Container -->
    <div class="flex-1 flex flex-col min-w-0 lg:pl-64">
        <!-- Top Navbar -->
        <header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-30 px-4 sm:px-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-600 hover:text-slate-900">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <div>
                    <h1 class="text-xl font-bold text-slate-900">@yield('page_title', 'Dashboard')</h1>
                    <p class="text-xs text-slate-500">@yield('page_subtitle', 'Selamat datang kembali di ATFALAH PRIVATE Platform')</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i> Web Publik
                </a>
            </div>
        </header>

        <!-- Dynamic Content Body -->
        <main class="flex-1 p-4 sm:p-8">
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl flex items-center gap-3">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-2xl flex items-center gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 flex-shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
    @yield('scripts')
</body>
</html>