@extends('layouts.dashboard')

@section('page_title', 'Materi & Repository Belajar')
@section('page_subtitle', 'Akses modul e-book, rekaman audio tartil, dan video tajwid.')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($materials as $mat)
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-rose-100 text-primary-700 flex items-center justify-center">
                            <i data-lucide="{{ $mat->type == 'video' ? 'video' : ($mat->type == 'link' ? 'link' : 'file-text') }}" class="w-5 h-5"></i>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 bg-slate-100 px-2 py-0.5 rounded-md">
                            {{ $mat->type }}
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 leading-snug">{{ $mat->title }}</h3>
                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-3">{{ $mat->description }}</p>
                    <div class="text-[11px] text-primary-700 font-medium">Program: {{ $mat->program->name }}</div>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <a href="{{ $mat->external_url ?? '#' }}" target="_blank" class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs flex items-center justify-center gap-2 transition-colors">
                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i> Buka Materi
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white rounded-3xl p-12 text-center border border-slate-200">
                <i data-lucide="file-text" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
                <p class="text-xs text-slate-400">Belum ada materi pembelajaran yang tersedia.</p>
            </div>
        @endforelse
    </div>

    <div>
        {{ $materials->links() }}
    </div>
</div>
@endsection