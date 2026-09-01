@extends('layouts.app')

@section('title', 'Metode Pembelajaran — ATFALAH PRIVATE')

@section('content')
<div class="bg-primary-900 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 text-center space-y-3">
        <span class="text-xs font-bold tracking-widest text-gold-400 uppercase">Metodologi & Pedagogi</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Filosofi & Alur Belajar ATFALAH</h1>
        <p class="text-xs sm:text-sm text-primary-100 max-w-2xl mx-auto leading-relaxed">
            Menghadirkan pengalaman belajar yang personal, bertahap, dan berorientasi pada kemajuan nyata.
        </p>
    </div>
</div>

<div class="py-16 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 space-y-16">
        <!-- 4 Step Philosophy Detail -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-3 text-center">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center mx-auto font-bold text-lg">1</div>
                <h3 class="text-base font-bold text-slate-900">READ</h3>
                <p class="text-xs text-slate-600 leading-relaxed">Belajar membaca huruf hijaiyah dari dasar, harakat, dan menyambung kata.</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-3 text-center">
                <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-700 flex items-center justify-center mx-auto font-bold text-lg">2</div>
                <h3 class="text-base font-bold text-slate-900">IMPROVE</h3>
                <p class="text-xs text-slate-600 leading-relaxed">Memperbaiki makhraj huruf, kaidah tajwid praktis, dan kelancaran tartil.</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-3 text-center">
                <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center mx-auto font-bold text-lg">3</div>
                <h3 class="text-base font-bold text-slate-900">UNDERSTAND</h3>
                <p class="text-xs text-slate-600 leading-relaxed">Memahami kosakata Al-Qur'an, asbabun nuzul singkat, dan hikmah ayat.</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-3 text-center">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center mx-auto font-bold text-lg">4</div>
                <h3 class="text-base font-bold text-slate-900">LIVE</h3>
                <p class="text-xs text-slate-600 leading-relaxed">Mengamalkan nilai ayat dalam akhlaq, ibadah fardhu 'ain, dan kehidupan.</p>
            </div>
        </div>

        <!-- Learning Flow Diagram -->
        <div class="bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-sm space-y-6">
            <h2 class="text-xl font-bold text-slate-900 text-center">Siklus Pembelajaran Berkelanjutan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 text-center">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <div class="text-xs font-bold text-primary-700">1. Sesi Privat</div>
                    <div class="text-[11px] text-slate-500 mt-1">Talaqqi 1-on-1 bersama ustadz/ustadzah</div>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <div class="text-xs font-bold text-primary-700">2. Koreksi Langsung</div>
                    <div class="text-[11px] text-slate-500 mt-1">Perbaikan makhraj & ketukan secara presisi</div>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <div class="text-xs font-bold text-primary-700">3. Feedback Tertulis</div>
                    <div class="text-[11px] text-slate-500 mt-1">Catatan kelebihan & fokus evaluasi berikutnya</div>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <div class="text-xs font-bold text-primary-700">4. Progress Tracking</div>
                    <div class="text-[11px] text-slate-500 mt-1">Perekaman grafik skor radar di dashboard</div>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                    <div class="text-xs font-bold text-primary-700">5. Target Baru</div>
                    <div class="text-[11px] text-slate-500 mt-1">Kenaikan jenjang modul & materi lanjutan</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection