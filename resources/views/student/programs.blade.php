@extends('layouts.dashboard')

@section('page_title', 'Program Pembelajaran Saya')
@section('page_subtitle', 'Daftar riwayat dan program yang sedang Anda ikuti.')

@section('content')
<div class="space-y-6">
    @forelse($enrollments as $enr)
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                <div>
                    <span class="text-[11px] font-bold text-primary-700 uppercase bg-rose-50 px-2.5 py-1 rounded-full border border-primary-200">
                        {{ $enr->status }}
                    </span>
                    <h2 class="text-2xl font-bold text-slate-900 mt-2">{{ $enr->program->name }}</h2>
                    <p class="text-xs text-slate-500">{{ $enr->program->tagline }}</p>
                </div>
                <div class="text-xs text-slate-500 text-left sm:text-right">
                    <div>Mulai: <strong>{{ \Carbon\Carbon::parse($enr->start_date)->format('d M Y') }}</strong></div>
                    <div>Target: <strong>{{ $enr->end_date ? \Carbon\Carbon::parse($enr->end_date)->format('d M Y') : 'Berkelanjutan' }}</strong></div>
                </div>
            </div>

            <!-- Silabus Progress in Program -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 mb-3">Daftar Modul & Silabus Program:</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($enr->program->curriculumItems as $item)
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 flex items-center gap-3">
                            <span class="w-6 h-6 rounded-lg bg-rose-700 text-white font-bold text-[11px] flex items-center justify-center flex-shrink-0">
                                {{ $item->sequence }}
                            </span>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-semibold text-slate-800 truncate">{{ $item->title }}</div>
                                <div class="text-[10px] text-slate-400 truncate">{{ $item->description }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-200">
            <i data-lucide="book-open" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
            <h3 class="text-base font-bold text-slate-900">Belum Ada Program Terdaftar</h3>
            <p class="text-xs text-slate-500 max-w-md mx-auto mt-1">Anda belum terdaftar di program pembelajaran. Silakan hubungi admin atau daftar melalui katalog program.</p>
        </div>
    @endforelse
</div>
@endsection