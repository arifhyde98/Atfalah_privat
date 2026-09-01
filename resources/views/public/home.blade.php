@extends('layouts.app')

@section('title', 'ATFALAH PRIVATE — Qur\'an & Islamic Studies Programs')

@section('content')
<!-- Hero Section with Deep Emerald & Gold Arabesque Styling -->
<section class="relative overflow-hidden bg-islamic-pattern text-white py-20 lg:py-28 border-b-4 border-gold-500/80">
    <!-- Subtle Golden Halo Glow -->
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[700px] h-[700px] bg-gradient-to-b from-gold-500/15 via-emerald-500/10 to-transparent rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Bismillah Header Calligraphy Accent -->
        <div class="text-center mb-6" data-aos="fade-down">
            <div class="inline-block text-2xl sm:text-3xl font-quran text-gold-400/90 tracking-wider hover:scale-105 transition-transform duration-300 cursor-default">
                بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Headline -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-950/80 border border-gold-500/30 text-xs text-gold-400 font-semibold uppercase tracking-widest backdrop-blur shadow-inner">
                    <span class="text-gold-400 text-sm animate-spin" style="animation-duration: 6s;">✦</span> {{ $settings['hero_badge'] }} <span class="text-gold-400 text-sm">✦</span>
                </div>
                
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.18] text-white">
                    {{ $settings['hero_title_1'] }}<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 via-gold-300 to-amber-400 font-serif">
                        {{ $settings['hero_title_2'] }}
                    </span>
                </h1>
                
                <p class="text-sm sm:text-base lg:text-lg text-emerald-100/90 max-w-2xl leading-relaxed">
                    {{ $settings['hero_description'] }}
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4 pt-4 justify-center lg:justify-start">
                    <a href="{{ route('assessment') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-gold-400 via-amber-500 to-gold-500 hover:from-gold-300 hover:to-amber-400 text-slate-950 font-extrabold text-sm shadow-xl shadow-amber-900/40 hover:shadow-2xl hover:-translate-y-1 transition-all flex items-center justify-center gap-2 border border-gold-300/40 pulse-gold">
                        <i data-lucide="compass" class="w-4 h-4 text-slate-950"></i> Mulai Placement Test Mandiri
                    </a>
                    <a href="{{ route('programs') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-emerald-950/60 hover:bg-emerald-900/80 border border-emerald-500/30 text-white font-semibold text-sm backdrop-blur hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                        <i data-lucide="book-open" class="w-4 h-4 text-gold-400"></i> Katalog & Silabus Lengkap
                    </a>
                </div>

                <!-- 3 Pillars Mini Info -->
                <div class="pt-8 grid grid-cols-3 gap-3 sm:gap-4 border-t border-emerald-800/60 text-left">
                    <div class="p-3 rounded-2xl bg-emerald-950/40 border border-emerald-800/40 hover:border-gold-500/40 transition-colors">
                        <div class="text-lg sm:text-xl font-bold text-gold-400 font-serif">1-on-1</div>
                        <div class="text-[11px] text-emerald-200">Talaqqi Privat</div>
                    </div>
                    <div class="p-3 rounded-2xl bg-emerald-950/40 border border-emerald-800/40 hover:border-gold-500/40 transition-colors">
                        <div class="text-lg sm:text-xl font-bold text-gold-400 font-serif">Bersanad</div>
                        <div class="text-[11px] text-emerald-200">Riwayat Hafsh</div>
                    </div>
                    <div class="p-3 rounded-2xl bg-emerald-950/40 border border-emerald-800/40 hover:border-gold-500/40 transition-colors">
                        <div class="text-lg sm:text-xl font-bold text-gold-400 font-serif">Terukur</div>
                        <div class="text-[11px] text-emerald-200">Progress Report</div>
                    </div>
                </div>
            </div>

            <!-- Right Interactive Tab Card (Interactive 4-Pillars Preview) -->
            <div class="lg:col-span-5 relative" data-aos="fade-left" x-data="{ 
                activePillar: 1,
                pillars: [
                    { id: 1, arabic: '١', name: 'READ', title: 'Qira\'ah Dasar', desc: 'Mengenal huruf hijaiyah, harakat, sukun, tasydid hingga membaca kata secara mandiri.', color: 'emerald', tag: 'From Zero' },
                    { id: 2, arabic: '٢', name: 'IMPROVE', title: 'Tahsin & Tajwid', desc: 'Menyempurnakan 5 tempat makhraj huruf, sifatul huruf, dan hukum tartil mutawatir.', color: 'teal', tag: 'Correct Recitation' },
                    { id: 3, arabic: '٣', name: 'UNDERSTAND', title: 'Tadabbur Ayat', desc: 'Menyelami mufradat (kosakata Al-Qur\'an), asbabun nuzul, dan hikmah pesan surah.', color: 'indigo', tag: 'Deep Connection' },
                    { id: 4, arabic: '٤', name: 'LIVE', title: '\'Amal & Fardhu \'Ain', desc: 'Mempraktikkan adab Qur\'ani, fiqh thaharah & shalat, serta akhlaqul karimah.', color: 'amber', tag: 'Practice Your Faith' }
                ]
            }">
                <div class="bg-gradient-to-b from-emerald-950/95 to-slate-950/95 border-2 border-gold-500/30 backdrop-blur-2xl rounded-3xl p-6 sm:p-8 shadow-2xl text-white space-y-5 relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 text-gold-500/5 font-arabic text-9xl pointer-events-none select-none">
                        ق
                    </div>

                    <div class="flex items-center justify-between border-b border-emerald-800/60 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-gold-500/20 border border-gold-500/40 text-gold-400 flex items-center justify-center font-bold">
                                <span>۞</span>
                            </div>
                            <div>
                                <div class="text-[10px] uppercase tracking-widest text-gold-400 font-bold">Alur Pembelajaran Interaktif</div>
                                <div class="text-sm font-bold text-white">4 Tahapan Belajar ATFALAH</div>
                            </div>
                        </div>
                        <span class="text-[10px] px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-300 font-semibold border border-emerald-500/30">Step-by-step</span>
                    </div>

                    <!-- Step Selector Badges -->
                    <div class="grid grid-cols-4 gap-2">
                        <template x-for="p in pillars" :key="p.id">
                            <button @click="activePillar = p.id" 
                                    :class="activePillar === p.id ? 'bg-gold-500 text-slate-950 font-bold border-gold-400 shadow-md scale-105' : 'bg-emerald-900/40 text-emerald-200 border-emerald-700/40 hover:bg-emerald-800/50'"
                                    class="py-2 px-1 rounded-xl text-center border text-xs transition-all flex flex-col items-center">
                                <span class="text-sm font-arabic font-bold" x-text="p.arabic"></span>
                                <span class="text-[9px] uppercase tracking-tighter" x-text="p.name"></span>
                            </button>
                        </template>
                    </div>

                    <!-- Active Pillar Dynamic Card Display -->
                    <div class="p-4 rounded-2xl bg-emerald-900/30 border border-gold-500/30 min-h-[140px] flex flex-col justify-between transition-all">
                        <template x-for="p in pillars" :key="p.id">
                            <div x-show="activePillar === p.id" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-bold text-gold-300 font-serif flex items-center gap-1.5">
                                        <span x-text="p.arabic + '.'"></span>
                                        <span x-text="p.name + ' — ' + p.title"></span>
                                    </h4>
                                    <span class="text-[10px] px-2 py-0.5 rounded-md bg-white/10 text-emerald-200" x-text="p.tag"></span>
                                </div>
                                <p class="text-xs text-emerald-100/90 leading-relaxed" x-text="p.desc"></p>
                            </div>
                        </template>
                        <div class="pt-3 flex items-center justify-between text-[11px] text-emerald-300 border-t border-emerald-800/40">
                            <span>Sesi Privat 1-on-1</span>
                            <span class="text-gold-400 font-semibold">Talaqqi Interaktif &rarr;</span>
                        </div>
                    </div>

                    <div class="pt-1">
                        <a href="{{ route('register') }}" class="block w-full py-3.5 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-500 hover:to-teal-600 text-white font-bold text-xs shadow-lg transition-all border border-emerald-400/30 text-center hover:scale-[1.02]">
                            Daftar Kelas Privat Sekarang &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4 Core Programs Section with Interactive Tabs & Filter -->
<section class="py-24 bg-islamic-subtle relative" x-data="{ activeTab: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 space-y-3" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary-100/80 border border-primary-300/50 text-xs font-bold text-primary-900 uppercase tracking-widest">
                <span>۞</span> Program Pembelajaran <span>۞</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight font-serif">
                Kurikulum Terstruktur Sesuai Kebutuhan Anda
            </h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Setiap program dibimbing langsung secara privat (1-on-1) oleh para asatidz/asatidzah bersanad dengan silabus terukur.
            </p>
        </div>

        <!-- Programs Grid with Hover Elevation -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            @foreach($programs as $program)
                <div class="bg-white rounded-3xl p-7 border-2 border-emerald-900/10 shadow-lg shadow-emerald-900/5 hover:border-gold-500/50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group islamic-card" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-center p-3 group-hover:bg-emerald-800 group-hover:text-gold-300 group-hover:rotate-6 transition-all duration-300 shadow-sm">
                                <i data-lucide="{{ $program->slug == 'reading-class' ? 'book-open' : ($program->slug == 'tahsin-tajwid' ? 'award' : ($program->slug == 'tahsin-tadabbur' ? 'heart-handshake' : 'graduation-cap')) }}" class="w-6 h-6"></i>
                            </div>
                            <span class="text-xs font-arabic text-emerald-800 font-bold text-base">
                                {{ $loop->iteration == 1 ? 'المستوى ١' : ($loop->iteration == 2 ? 'المستوى ٢' : ($loop->iteration == 3 ? 'المستوى ٣' : 'المستوى ٤')) }}
                            </span>
                        </div>

                        <div>
                            <span class="text-[10px] font-bold text-gold-600 uppercase tracking-wider block">{{ $program->tagline }}</span>
                            <h3 class="text-xl font-extrabold text-slate-900 mt-1 font-serif group-hover:text-emerald-800 transition-colors">{{ $program->name }}</h3>
                        </div>

                        <p class="text-xs text-slate-600 leading-relaxed line-clamp-3">
                            {{ $program->description }}
                        </p>
                        
                        <!-- Interactive Curriculum Preview Toggle -->
                        <div class="pt-3 border-t border-slate-100" x-data="{ expanded: false }">
                            <div class="text-[11px] font-bold text-emerald-900 mb-2 flex items-center justify-between">
                                <span class="flex items-center gap-1"><span class="text-gold-500">✦</span> {{ $program->curriculumItems->count() }} Modul Silabus:</span>
                                <button @click="expanded = !expanded" class="text-[10px] text-emerald-700 hover:underline font-semibold" x-text="expanded ? 'Tutup' : 'Lihat Semua'"></button>
                            </div>
                            
                            <!-- 3 Top Preview -->
                            <ul class="space-y-1.5 text-xs text-slate-500">
                                @foreach($program->curriculumItems->take(3) as $curr)
                                    <li class="flex items-center gap-2 truncate">
                                        <i data-lucide="check-circle" class="w-3.5 h-3.5 text-emerald-600 flex-shrink-0"></i>
                                        <span class="truncate">{{ $curr->title }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <!-- Expanded List -->
                            <div x-show="expanded" x-transition class="mt-2 pt-2 border-t border-dashed border-slate-200 space-y-1.5 text-xs text-slate-500">
                                @foreach($program->curriculumItems->skip(3) as $curr)
                                    <li class="flex items-center gap-2 truncate">
                                        <i data-lucide="chevron-right" class="w-3 h-3 text-gold-500 flex-shrink-0"></i>
                                        <span class="truncate">{{ $curr->title }}</span>
                                    </li>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100 space-y-2">
                        <a href="{{ route('programs.detail', $program->slug) }}" class="block w-full py-2.5 text-center text-xs font-bold rounded-xl bg-emerald-50 text-emerald-900 group-hover:bg-emerald-800 group-hover:text-gold-300 transition-all border border-emerald-200 shadow-sm">
                            Lihat Silabus Lengkap &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Interactive Audio/Makhraj Tajwid Simulator Section -->
<section class="py-20 bg-emerald-950 text-white relative border-y-2 border-gold-500/40 overflow-hidden" x-data="{
    activeTab: 'nun',
    makhrajList: [
        { id: 'al-halq', name: 'Al-Halq (Tenggorokan)', arabic: 'الحَلْق', desc: 'Huruf yang keluar dari tenggorokan bawah, tengah, dan atas.', letters: ['ء', 'هـ', 'ع', 'ح', 'غ', 'خ'], example: 'مِنْ خَوْفٍ' },
        { id: 'al-lisan', name: 'Al-Lisan (Lidah)', arabic: 'اللِّسَان', desc: 'Pangkal, tengah, tepi, hingga ujung lidah bertemu langit-langit / gigi.', letters: ['ق', 'ك', 'ج', 'ش', 'ي', 'ض', 'ل', 'ن', 'ر', 'ط', 'د', 'ت', 'ص', 'ز', 'س', 'ظ', 'ذ', 'ث'], example: 'أَنْعَمْتَ' },
        { id: 'as-syafatan', name: 'Asy-Syafatain (Bibir)', arabic: 'الشَّفَتَان', desc: 'Kedua bibir tertutup, terbuka atau bibir bawah bertemu gigi seri atas.', letters: ['ف', 'و', 'ب', 'م'], example: 'كُتِبَ' },
        { id: 'al-khaisyum', name: 'Al-Khaisyum (Rongga Hidung)', arabic: 'الخَيْشُوم', desc: 'Pangkal rongga hidung tempat beresonansinya suara dengung (Ghunnah).', letters: ['نّ', 'مّ', 'Ghunnah'], example: 'إِنَّ اللَّهَ' }
    ],
    selectedMakhraj: 0
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-12 space-y-2" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-500/20 text-gold-300 text-xs font-bold uppercase tracking-wider border border-gold-500/30">
                <span>✦</span> Fitur Eksplorasi Tajwid <span>✦</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white font-serif">Peta Interaktif 5 Tempat Makharijul Huruf</h2>
            <p class="text-xs sm:text-sm text-emerald-200/80">Klik pada masing-masing tempat keluarnya huruf untuk melihat klasifikasi huruf hijaiyahnya.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center" data-aos="zoom-in">
            <!-- Left Tabs Selector -->
            <div class="lg:col-span-5 space-y-3">
                <template x-for="(m, idx) in makhrajList" :key="m.id">
                    <button @click="selectedMakhraj = idx" 
                            :class="selectedMakhraj === idx ? 'bg-gradient-to-r from-gold-500 to-amber-600 text-slate-950 font-extrabold shadow-lg scale-[1.02] border-gold-300' : 'bg-emerald-900/40 text-emerald-100 border-emerald-800 hover:bg-emerald-800/60'"
                            class="w-full text-left p-4 rounded-2xl border transition-all flex items-center justify-between cursor-pointer">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center font-bold text-xs" x-text="idx + 1"></span>
                            <span class="text-xs sm:text-sm font-semibold" x-text="m.name"></span>
                        </div>
                        <span class="text-lg font-arabic font-bold" x-text="m.arabic"></span>
                    </button>
                </template>
            </div>

            <!-- Right Interactive Display Box -->
            <div class="lg:col-span-7 bg-slate-900/90 border-2 border-gold-500/40 rounded-3xl p-6 sm:p-8 backdrop-blur-xl shadow-2xl relative">
                <div class="flex items-center justify-between border-b border-slate-800 pb-4 mb-6">
                    <div>
                        <span class="text-[10px] text-gold-400 uppercase font-bold tracking-wider">Makhraj Terpilih</span>
                        <h3 class="text-lg sm:text-xl font-bold text-white font-serif" x-text="makhrajList[selectedMakhraj].name"></h3>
                    </div>
                    <span class="text-3xl font-quran text-gold-400" x-text="makhrajList[selectedMakhraj].arabic"></span>
                </div>

                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-6" x-text="makhrajList[selectedMakhraj].desc"></p>

                <!-- Letters Grid Badges -->
                <div>
                    <div class="text-xs font-bold text-emerald-400 mb-3 flex items-center gap-1.5">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i> Huruf Hijaiyah yang Terkait:
                    </div>
                    <div class="flex flex-wrap gap-2.5">
                        <template x-for="l in makhrajList[selectedMakhraj].letters" :key="l">
                            <div class="w-11 h-11 rounded-xl bg-emerald-950 border border-gold-500/40 flex items-center justify-center text-xl font-quran text-gold-300 shadow-md hover:bg-gold-500 hover:text-slate-950 hover:scale-110 transition-all cursor-default select-none" x-text="l"></div>
                        </template>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400">
                    <div>Contoh Bacaan: <span class="text-gold-300 font-arabic text-base font-bold ml-1" x-text="makhrajList[selectedMakhraj].example"></span></div>
                    <a href="{{ route('programs.detail', 'tahsin-tajwid') }}" class="text-gold-400 hover:underline font-semibold flex items-center gap-1">Pelajari di Kelas Tahsin &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why ATFALAH Section with Islamic Hadith Calligraphy -->
<section class="py-24 bg-white border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 space-y-6" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-900 text-xs font-bold uppercase tracking-wider">
                    <span>۞</span> Keutamaan & Nilai <span>۞</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight font-serif">
                    Keunggulan Metode Bimbingan Privat ATFALAH
                </h2>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Mempelajari firman Allah memerlukan ketelitian talaqqi (menyimak dan menyetorkan bacaan). Melalui bimbingan privat, setiap harakat, dengung (ghunnah), dan makhraj diperbaiki secara telaten tanpa rasa canggung.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100 flex items-start gap-3.5 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 rounded-xl bg-emerald-700 text-gold-300 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i data-lucide="user-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">Personal & Adaptif</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Ritme belajar disesuaikan dengan daya serap santri.</p>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100 flex items-start gap-3.5 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 rounded-xl bg-emerald-700 text-gold-300 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i data-lucide="award" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">Asatidz Bersanad</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Memiliki sanad qira'ah mutawatir riwayat Hafsh.</p>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100 flex items-start gap-3.5 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 rounded-xl bg-emerald-700 text-gold-300 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i data-lucide="line-chart" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">Progress Report</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Evaluasi makhraj dan feedback tercatat rapi.</p>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100 flex items-start gap-3.5 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 rounded-xl bg-emerald-700 text-gold-300 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">Tadabbur & Akhlaq</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Menghubungkan bacaan dengan amalan fardhu 'ain.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quote Showcase Calligraphy Box -->
            <div class="lg:col-span-6 relative" data-aos="fade-left">
                <div class="bg-gradient-to-br from-emerald-950 via-emerald-900 to-slate-950 text-white rounded-3xl p-8 sm:p-10 shadow-2xl border-2 border-gold-500/40 relative overflow-hidden">
                    <div class="absolute right-4 top-4 text-gold-400/10 text-8xl font-arabic pointer-events-none select-none">
                        ﷽
                    </div>

                    <div class="relative z-10 space-y-6">
                        <div class="flex items-center gap-2 text-gold-400 text-xs font-semibold tracking-wider uppercase">
                            <span>✦</span> Dalil Keutamaan Belajar Al-Qur'an
                        </div>

                        <div class="text-2xl sm:text-3xl font-quran text-gold-300 leading-[2.2] text-right" dir="rtl">
                            {{ $settings['quote_arabic'] }}
                        </div>

                        <p class="text-sm italic text-emerald-100/90 border-l-2 border-gold-400 pl-4 py-1 leading-relaxed">
                            "{{ $settings['quote_translation'] }}"
                        </p>

                        <div class="text-xs font-bold text-gold-400">
                            — {{ $settings['quote_source'] }}
                        </div>

                        <div class="pt-6 border-t border-emerald-800/80 flex items-center justify-between">
                            <div>
                                <div class="text-[11px] text-emerald-300">Jadwal Kelas Privat</div>
                                <div class="text-sm font-bold text-white">Fleksibel (Pagi / Siang / Malam)</div>
                            </div>
                            <a href="{{ route('assessment') }}" class="px-5 py-2.5 rounded-xl bg-gold-400 hover:bg-gold-300 text-slate-950 text-xs font-bold transition-colors shadow">
                                Cek Level Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Teacher Highlights Section -->
<section class="py-24 bg-islamic-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12" data-aos="fade-up">
            <div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary-100 text-primary-900 text-xs font-bold uppercase tracking-wider">
                    <span>۞</span> Asatidz Bersanad <span>۞</span>
                </div>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-3 tracking-tight font-serif">
                    Dibimbing oleh Dewan Guru Berpengalaman
                </h2>
            </div>
            <a href="{{ route('teachers') }}" class="mt-4 md:mt-0 text-xs font-bold text-emerald-800 hover:text-emerald-900 flex items-center gap-1">
                Lihat Seluruh Dewan Pengajar <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($teachers as $teacher)
                <div class="bg-white rounded-3xl p-6 sm:p-8 border-2 border-emerald-900/10 flex flex-col sm:flex-row items-center sm:items-start gap-6 shadow-sm hover:border-gold-500/40 hover:-translate-y-1 transition-all duration-300 islamic-card" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-emerald-900 to-emerald-700 text-gold-300 flex items-center justify-center font-bold text-3xl flex-shrink-0 shadow-md border border-gold-400/30">
                        {{ strtoupper(substr($teacher->name, 0, 1)) }}
                    </div>
                    <div class="space-y-2 text-center sm:text-left flex-1">
                        <h3 class="text-lg font-bold text-slate-900 font-serif">{{ $teacher->name }}</h3>
                        <div class="text-xs font-semibold text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-lg inline-block border border-emerald-200">
                            {{ $teacher->teacherProfile->specialization ?? 'Pengajar Qur\'an Bersanad' }}
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            {{ $teacher->teacherProfile->bio ?? 'Pengajar bersanad mutawatir dengan dedikasi tinggi membimbing perbaikan bacaan dan tadabbur santri.' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Placement Assessment CTA Banner -->
<section class="py-20 bg-gradient-to-r from-emerald-950 via-primary-900 to-slate-950 text-white relative overflow-hidden border-t-4 border-gold-500/80">
    <div class="max-w-5xl mx-auto px-4 text-center space-y-6 relative z-10" data-aos="zoom-in">
        <div class="text-gold-400 text-xl font-quran">
            اقْرَأْ بِاسْمِ رَبِّكَ الَّذِي خَلَقَ
        </div>
        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-serif">
            Mulai Perjalanan Belajar Al-Qur'an Anda Hari Ini
        </h2>
        <p class="text-sm text-emerald-100 max-w-2xl mx-auto leading-relaxed">
            Tidak ada kata terlambat untuk belajar membaca dan mencintai Al-Qur'an. Ikuti Placement Assessment interaktif singkat untuk mengetahui rekomendasi kelas yang paling pas bagi Anda.
        </p>
        <div class="pt-2">
            <a href="{{ route('assessment') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-gold-400 to-amber-500 hover:from-gold-300 hover:to-amber-400 text-slate-950 font-extrabold text-sm shadow-xl shadow-amber-950/50 transition-all hover:scale-105 border border-gold-300/50 pulse-gold">
                <i data-lucide="compass" class="w-4 h-4"></i> Cek Rekomendasi Level Sekarang &rarr;
            </a>
        </div>
    </div>
</section>
@endsection
