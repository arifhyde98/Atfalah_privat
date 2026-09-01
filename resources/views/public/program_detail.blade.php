@extends('layouts.app')

@section('title', $program->name . ' — ATFALAH PRIVATE')

@section('content')
<div class="bg-islamic-pattern text-white py-20 border-b-4 border-gold-500/80 relative">
    <div class="max-w-5xl mx-auto px-4 text-center space-y-4 relative z-10">
        <div class="text-gold-400 font-quran text-2xl mb-1">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
        <span class="text-xs font-bold tracking-widest text-gold-400 uppercase bg-emerald-950/80 px-3.5 py-1 rounded-full border border-gold-500/30">
            <span>۞</span> {{ $program->tagline }} <span>۞</span>
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight font-serif">{{ $program->name }}</h1>
        <p class="text-sm sm:text-base text-emerald-100 max-w-3xl mx-auto leading-relaxed">
            {{ $program->description }}
        </p>
        <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('register', ['program' => $program->slug]) }}" class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-gold-400 to-amber-500 hover:from-gold-300 hover:to-amber-400 text-slate-950 font-bold text-xs shadow-lg transition-all border border-gold-300/40">
                Daftar Kelas {{ $program->name }} &rarr;
            </a>
            <a href="{{ route('assessment') }}" class="px-6 py-3.5 rounded-xl bg-emerald-950/60 hover:bg-emerald-900 text-white font-semibold text-xs border border-emerald-500/30 transition-all">
                Ikuti Placement Test
            </a>
        </div>
    </div>
</div>

<div class="py-16 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 space-y-12">
        <!-- Learning Goal & Audience -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                    <i data-lucide="target" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Tujuan Pembelajaran</h3>
                <p class="text-xs text-slate-600 leading-relaxed">{{ $program->learning_goal }}</p>
            </div>
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Target Peserta</h3>
                <p class="text-xs text-slate-600 leading-relaxed">{{ $program->target_audience }}</p>
            </div>
        </div>

        <!-- Full Curriculum Accordion / Timeline -->
        <div class="bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-sm space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Struktur Kurikulum & Topik Pembelajaran</h3>
                    <p class="text-xs text-slate-500 mt-1">Disusun sistematis dari materi pondasi hingga pendalaman aplikatif.</p>
                </div>
                <span class="text-xs font-bold text-primary-700 bg-primary-50 px-3 py-1 rounded-full border border-primary-200">
                    Total {{ $program->curriculumItems->count() }} Modul
                </span>
            </div>

            <div class="space-y-4">
                @foreach($program->curriculumItems as $item)
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start gap-4">
                        <span class="w-8 h-8 rounded-xl bg-primary-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0 shadow-sm">
                            {{ $item->sequence }}
                        </span>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-slate-900">{{ $item->title }}</h4>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $item->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CTA Bottom -->
        <div class="bg-slate-900 text-white rounded-3xl p-8 text-center space-y-4">
            <h3 class="text-2xl font-bold">Siap Mengikuti Program Ini?</h3>
            <p class="text-xs text-slate-300 max-w-xl mx-auto">
                Daftarkan diri Anda hari ini. Tim konsultan akademik ATFALAH akan mencocokkan jadwal belajar privat terbaik sesuai preferensi waktu Anda.
            </p>
            <div class="pt-2">
                <a href="{{ route('register', ['program' => $program->slug]) }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-primary-600 hover:bg-primary-500 text-white font-bold text-xs shadow-lg transition-colors">
                    Daftar {{ $program->name }} Sekarang
                </a>
            </div>
        </div>
    </div>
</div>
@endsection