@extends('layouts.app')

@section('title', 'ATFALAH PRIVATE — Qur\'an & Islamic Studies Programs')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-b from-primary-900 via-primary-800 to-slate-900 text-white py-24 lg:py-32">
    <!-- Decorative Islamic Geometry Background Elements -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Headline -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/15 text-xs text-gold-400 font-semibold uppercase tracking-wider backdrop-blur">
                    <i data-lucide="sparkles" class="w-4 h-4 text-gold-400"></i> {{ $settings['hero_badge'] }}
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.15] text-white">
                    {{ $settings['hero_title_1'] }}<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 via-teal-200 to-gold-400">{{ $settings['hero_title_2'] }}</span>
                </h1>
                <p class="text-base sm:text-lg text-primary-100/90 max-w-2xl leading-relaxed">
                    {{ $settings['hero_description'] }}
                </p>
                <div class="flex flex-col sm:flex-row items-center gap-4 pt-4 justify-center lg:justify-start">
                    <a href="{{ route('assessment') }}" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-gradient-to-r from-gold-500 to-amber-600 hover:from-gold-400 hover:to-amber-500 text-slate-950 font-bold text-sm shadow-xl shadow-amber-600/30 hover:shadow-2xl hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4"></i> Mulai Placement Test Gratis
                    </a>
                    <a href="{{ route('programs') }}" class="w-full sm:w-auto px-7 py-4 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold text-sm backdrop-blur transition-all flex items-center justify-center gap-2">
                        <i data-lucide="book-open" class="w-4 h-4"></i> Jelajahi Program
                    </a>
                </div>

                <!-- 3 Pillars Mini Info -->
                <div class="pt-8 grid grid-cols-3 gap-4 border-t border-white/10 text-left">
                    <div>
                        <div class="text-xl font-bold text-white">1-on-1</div>
                        <div class="text-xs text-primary-200/80">Bimbingan Privat</div>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-white">100%</div>
                        <div class="text-xs text-primary-200/80">Guru Bersanad</div>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-white">Terukur</div>
                        <div class="text-xs text-primary-200/80">Progress Based</div>
                    </div>
                </div>
            </div>

            <!-- Right Visual Card -->
            <div class="lg:col-span-5 relative">
                <div class="bg-white/10 border border-white/20 backdrop-blur-xl rounded-3xl p-6 sm:p-8 shadow-2xl text-white space-y-6">
                    <div class="flex items-center justify-between border-b border-white/10 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-primary-600 flex items-center justify-center font-bold">
                                <i data-lucide="compass" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-wider text-primary-200 font-semibold">Alur Pembelajaran</div>
                                <div class="text-sm font-bold text-white">4 Pilar ATFALAH</div>
                            </div>
                        </div>
                        <span class="text-xs px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-300 font-medium border border-emerald-500/30">Step-by-step</span>
                    </div>

                    <div class="space-y-3.5">
                        <div class="flex items-start gap-3 p-3 rounded-2xl bg-white/5 border border-white/10">
                            <span class="w-7 h-7 rounded-lg bg-emerald-600 text-xs font-bold flex items-center justify-center flex-shrink-0">1</span>
                            <div>
                                <h4 class="text-xs font-bold text-white">READ (Membaca)</h4>
                                <p class="text-[11px] text-primary-100/80">Mengenal huruf hijaiyah dari dasar hingga mandiri membaca kata.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-2xl bg-white/5 border border-white/10">
                            <span class="w-7 h-7 rounded-lg bg-teal-600 text-xs font-bold flex items-center justify-center flex-shrink-0">2</span>
                            <div>
                                <h4 class="text-xs font-bold text-white">IMPROVE (Memperbaiki)</h4>
                                <p class="text-[11px] text-primary-100/80">Menyempurnakan makhraj huruf, sifatul huruf, dan hukum tajwid tartil.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-2xl bg-white/5 border border-white/10">
                            <span class="w-7 h-7 rounded-lg bg-indigo-600 text-xs font-bold flex items-center justify-center flex-shrink-0">3</span>
                            <div>
                                <h4 class="text-xs font-bold text-white">UNDERSTAND (Memahami)</h4>
                                <p class="text-[11px] text-primary-100/80">Mentadabburi kosakata kunci, pesan surah, dan hikmah firman Allah.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-2xl bg-white/5 border border-white/10">
                            <span class="w-7 h-7 rounded-lg bg-amber-600 text-xs font-bold flex items-center justify-center flex-shrink-0">4</span>
                            <div>
                                <h4 class="text-xs font-bold text-white">LIVE (Mengamalkan)</h4>
                                <p class="text-[11px] text-primary-100/80">Menerapkan adab, akhlaq, dan fiqh ibadah fardhu 'ain dalam keseharian.</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2 text-center">
                        <a href="{{ route('register') }}" class="block w-full py-3 rounded-xl bg-white text-slate-900 font-bold text-xs hover:bg-slate-100 transition-colors shadow">
                            Daftar Kelas Privat Sekarang &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4 Core Programs Section -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <span class="text-xs font-bold tracking-widest text-primary-700 uppercase bg-primary-100 px-3 py-1 rounded-full">Program Unggulan</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Pilih Program Sesuai Tingkat Kemampuan Anda
            </h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Setiap program dirancang bertahap dengan silabus komprehensif, dibimbing guru bersanad, dan dipantau melalui evaluasi mingguan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($programs as $program)
                <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-lg shadow-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-primary-50 border border-primary-200 text-primary-700 flex items-center justify-center group-hover:bg-primary-700 group-hover:text-white transition-colors shadow-sm">
                            <i data-lucide="{{ $program->slug == 'reading-class' ? 'book-open' : ($program->slug == 'tahsin-tajwid' ? 'award' : ($program->slug == 'tahsin-tadabbur' ? 'heart-handshake' : 'graduation-cap')) }}" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold text-gold-600 uppercase tracking-wider">{{ $program->tagline }}</span>
                            <h3 class="text-xl font-bold text-slate-900 mt-1">{{ $program->name }}</h3>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed line-clamp-3">
                            {{ $program->description }}
                        </p>
                        
                        <!-- Curriculum Preview -->
                        <div class="pt-2 border-t border-slate-100">
                            <div class="text-[11px] font-bold text-slate-700 mb-2">Cakupan Topik ({{ $program->curriculumItems->count() }} Modul):</div>
                            <ul class="space-y-1 text-xs text-slate-500">
                                @foreach($program->curriculumItems->take(3) as $curr)
                                    <li class="flex items-center gap-1.5 truncate">
                                        <i data-lucide="check" class="w-3.5 h-3.5 text-primary-600 flex-shrink-0"></i>
                                        <span class="truncate">{{ $curr->title }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="{{ route('programs.detail', $program->slug) }}" class="block w-full py-2.5 text-center text-xs font-semibold rounded-xl bg-slate-100 text-slate-800 hover:bg-primary-700 hover:text-white transition-all">
                            Lihat Silabus Lengkap &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why ATFALAH Section -->
<section class="py-20 bg-white border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <span class="text-xs font-bold tracking-widest text-primary-700 uppercase bg-primary-100 px-3 py-1 rounded-full">Nilai Utama</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    Mengapa Memilih Pembelajaran Privat di ATFALAH?
                </h2>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Kami percaya setiap insan memiliki ritme dan kebutuhan yang berbeda dalam mempelajari firman Allah. Pendekatan privat memastikan setiap kekeliruan makhraj terkoreksi dengan presisi dan penuh kesabaran.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="user-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Personal Learning</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Kecepatan materi mengikuti kemampuan daya serap student.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Guided by Teachers</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Guru bersanad mutawatir dan teruji dalam pedagogi Al-Qur'an.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="line-chart" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Structured Progress</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Catatan perkembangan tajwid & feedback tercatat di dashboard.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Beyond Recitation</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Menghubungkan lisan, pemahaman makna, dan amalan nyata.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quote Showcase -->
            <div class="relative bg-slate-900 text-white rounded-3xl p-8 sm:p-10 shadow-xl overflow-hidden">
                <div class="absolute -right-10 -bottom-10 opacity-10 text-primary-500">
                    <i data-lucide="book-open" class="w-64 h-64"></i>
                </div>
                <div class="relative z-10 space-y-6">
                    <div class="text-2xl sm:text-3xl font-arabic text-primary-200 leading-loose text-right">
                        {{ $settings['quote_arabic'] }}
                    </div>
                    <p class="text-sm italic text-slate-300">
                        "{{ $settings['quote_translation'] }}"
                    </p>
                    <div class="text-xs font-semibold text-gold-400">
                        — {{ $settings['quote_source'] }}
                    </div>
                    <div class="pt-6 border-t border-slate-800 flex items-center justify-between">
                        <div>
                            <div class="text-xs text-slate-400">Bimbingan Terjadwal</div>
                            <div class="text-sm font-bold text-white">Fleksibel Pagi / Malam</div>
                        </div>
                        <a href="{{ route('assessment') }}" class="px-4 py-2 rounded-xl bg-primary-700 hover:bg-primary-600 text-white text-xs font-bold transition-colors">
                            Cek Level Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Teacher Highlights Section -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs font-bold tracking-widest text-primary-700 uppercase bg-primary-100 px-3 py-1 rounded-full">Dewan Pengajar</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-3 tracking-tight">
                    Dibimbing oleh Asatidz & Asatidzah Berpengalaman
                </h2>
            </div>
            <a href="{{ route('teachers') }}" class="mt-4 md:mt-0 text-xs font-bold text-primary-700 hover:underline flex items-center gap-1">
                Lihat Semua Pengajar <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($teachers as $teacher)
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 flex flex-col sm:flex-row items-center sm:items-start gap-6 shadow-sm">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-primary-800 to-primary-600 text-white flex items-center justify-center font-bold text-2xl flex-shrink-0 shadow-md">
                        {{ strtoupper(substr($teacher->name, 0, 1)) }}
                    </div>
                    <div class="space-y-2 text-center sm:text-left flex-1">
                        <h3 class="text-lg font-bold text-slate-900">{{ $teacher->name }}</h3>
                        <div class="text-xs font-semibold text-primary-700 bg-primary-50 px-2.5 py-1 rounded-md inline-block">
                            {{ $teacher->teacherProfile->specialization ?? 'Pengajar Qur\'an' }}
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            {{ $teacher->teacherProfile->bio ?? 'Pengajar bersanad dengan dedikasi tinggi membimbing perbaikan bacaan dan tadabbur santri.' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Placement Assessment CTA Banner -->
<section class="py-16 bg-gradient-to-r from-primary-800 to-teal-900 text-white">
    <div class="max-w-5xl mx-auto px-4 text-center space-y-6">
        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
            Belum Yakin Harus Mulai dari Program Mana?
        </h2>
        <p class="text-sm text-primary-100 max-w-2xl mx-auto leading-relaxed">
            Ikuti Placement Assessment interaktif gratis selama 2 menit. Sistem kami akan menganalisis riwayat kemampuan bacaan dan memberikan rekomendasi program yang paling tepat untuk Anda.
        </p>
        <div class="pt-2">
            <a href="{{ route('assessment') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-gold-500 hover:bg-gold-400 text-slate-950 font-extrabold text-sm shadow-xl shadow-amber-600/30 transition-all hover:scale-105">
                <i data-lucide="sparkles" class="w-4 h-4"></i> Mulai Placement Assessment Sekarang &rarr;
            </a>
        </div>
    </div>
</section>
@endsection