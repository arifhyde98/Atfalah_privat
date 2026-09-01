@extends('layouts.app')

@section('title', 'Dewan Guru — ATFALAH PRIVATE')

@section('content')
<div class="bg-islamic-pattern text-white py-20 border-b-4 border-gold-500/80 relative">
    <div class="max-w-4xl mx-auto px-4 text-center space-y-3 relative z-10">
        <div class="text-gold-400 font-quran text-2xl mb-1">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-rose-950/80 border border-gold-500/30 text-xs font-bold tracking-widest text-gold-400 uppercase">
            <span>۞</span> Sanad & Asatidz <span>۞</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight font-serif">Dewan Guru ATFALAH PRIVATE</h1>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-2xl mx-auto leading-relaxed">
            Para asatidz dan asatidzah berkompeten, bersanad mutawatir riwayat Hafsh 'an 'Ashim, serta berpengalaman membimbing santri secara personal.
        </p>
    </div>
</div>

<div class="py-16 bg-slate-50">
    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($teachers as $teacher)
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm flex flex-col sm:flex-row gap-6 items-start">
                <div class="w-24 h-24 rounded-2xl bg-gradient-to-tr from-rose-800 to-rose-600 text-white flex items-center justify-center font-bold text-3xl flex-shrink-0 shadow-md">
                    {{ strtoupper(substr($teacher->name, 0, 1)) }}
                </div>
                <div class="space-y-3 flex-1">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">{{ $teacher->name }}</h3>
                        <span class="text-xs font-semibold text-primary-700 bg-rose-50 px-2.5 py-1 rounded-md inline-block mt-1">
                            {{ $teacher->teacherProfile->specialization ?? 'Pengajar Qur\'an' }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        {{ $teacher->teacherProfile->bio ?? 'Pengajar bersanad mutawatir dengan dedikasi tinggi mendidik santri privat ATFALAH.' }}
                    </p>
                    <div class="pt-2 border-t border-slate-100 text-xs text-slate-500 flex items-center gap-4">
                        <span><i data-lucide="check-circle" class="w-3.5 h-3.5 inline text-primary-600"></i> Terverifikasi</span>
                        <span><i data-lucide="calendar" class="w-3.5 h-3.5 inline text-primary-600"></i> Aktif Mengajar</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection