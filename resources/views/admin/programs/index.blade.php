@extends('layouts.dashboard')

@section('page_title', 'Manajemen Program & Kurikulum')
@section('page_subtitle', 'Kelola 4 program utama, silabus, dan urutan topik pembelajaran.')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-bold text-slate-900">Daftar Program Pembelajaran</h3>
            <p class="text-xs text-slate-500">Kelola kurikulum dan modul materi belajar.</p>
        </div>
        <a href="{{ route('admin.programs.create') }}" class="px-4 py-2.5 rounded-xl bg-rose-700 hover:bg-rose-800 text-white font-bold text-xs shadow flex items-center gap-1.5 transition-colors">
            <i data-lucide="plus" class="w-4 h-4"></i> Buat Program Baru
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($programs as $prog)
            <div class="p-6 rounded-3xl border border-slate-200 bg-slate-50/50 flex flex-col justify-between space-y-4">
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-100 text-emerald-800">{{ ucfirst($prog->status) }}</span>
                        <span class="text-xs text-slate-400 font-medium">{{ $prog->curriculum_items_count }} Topik Kurikulum</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900">{{ $prog->name }}</h4>
                    <p class="text-xs text-slate-500 line-clamp-2">{{ $prog->description }}</p>
                </div>

                <div class="pt-4 border-t border-slate-200 flex items-center justify-between">
                    <span class="text-xs text-slate-500 font-medium">Santri: <strong>{{ $prog->enrollments_count }}</strong></span>
                    <a href="{{ route('admin.programs.edit', $prog->id) }}" class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs transition-colors">
                        Kelola Kurikulum & Silabus &rarr;
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection