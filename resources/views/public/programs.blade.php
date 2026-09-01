@extends('layouts.app')

@section('title', 'Katalog Program — ATFALAH PRIVATE')

@section('content')
<div class="bg-islamic-pattern text-white py-20 border-b-4 border-gold-500/80 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <div class="text-gold-400 font-quran text-2xl mb-2">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-rose-950/80 border border-gold-500/30 text-xs font-bold tracking-widest text-gold-400 uppercase">
            <span>۞</span> Manhaj Pembelajaran <span>۞</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight font-serif">Program Pembelajaran ATFALAH</h1>
        <p class="text-sm sm:text-base text-emerald-100 max-w-2xl mx-auto leading-relaxed">
            Empat jenjang pembelajaran komprehensif yang dirancang untuk membimbing santri mulai dari nol hingga memahami dan mengamalkan nilai Al-Qur'an.
        </p>
    </div>
</div>

<div class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        @foreach($programs as $prog)
            <div id="{{ $prog->slug }}" class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-10 shadow-sm grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-7 space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 text-primary-800 text-xs font-bold uppercase tracking-wider">
                        {{ $prog->tagline }}
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $prog->name }}</h2>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        {{ $prog->description }}
                    </p>

                    <div class="space-y-3 pt-2">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="text-xs font-bold text-slate-800 flex items-center gap-2">
                                <i data-lucide="target" class="w-4 h-4 text-emerald-600"></i> Tujuan Pembelajaran (Learning Goal):
                            </div>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $prog->learning_goal }}</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="text-xs font-bold text-slate-800 flex items-center gap-2">
                                <i data-lucide="users" class="w-4 h-4 text-indigo-600"></i> Cocok Untuk (Suitable For):
                            </div>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $prog->target_audience }}</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-slate-50 rounded-2xl p-6 border border-slate-200/80 flex flex-col justify-between h-full space-y-6">
                    <div>
                        <div class="flex items-center justify-between border-b border-slate-200 pb-3 mb-4">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700">Silabus & Modul Belajar</h3>
                            <span class="text-xs font-semibold text-primary-700 bg-rose-100 px-2 py-0.5 rounded-full">{{ $prog->curriculumItems->count() }} Topik</span>
                        </div>
                        <ul class="space-y-2 text-xs text-slate-600">
                            @foreach($prog->curriculumItems->take(6) as $item)
                                <li class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-white border border-slate-200 text-slate-700 font-bold text-[10px] flex items-center justify-center flex-shrink-0">{{ $loop->iteration }}</span>
                                    <span class="truncate">{{ $item->title }}</span>
                                </li>
                            @endforeach
                            @if($prog->curriculumItems->count() > 6)
                                <li class="text-[11px] text-slate-400 italic pl-7">+ {{ $prog->curriculumItems->count() - 6 }} topik lanjutan lainnya</li>
                            @endif
                        </ul>
                    </div>

                    <div class="space-y-2 pt-4 border-t border-slate-200">
                        <a href="{{ route('register', ['program' => $prog->slug]) }}" class="block w-full py-3 rounded-xl bg-rose-700 hover:bg-rose-800 text-white font-bold text-xs text-center shadow transition-all">
                            Daftar di Program Ini &rarr;
                        </a>
                        <a href="{{ route('programs.detail', $prog->slug) }}" class="block w-full py-2.5 rounded-xl bg-white hover:bg-slate-100 text-slate-700 font-semibold text-xs text-center border border-slate-200 transition-colors">
                            Lihat Detail Lengkap
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection