@extends('layouts.dashboard')

@section('page_title', 'Kelas Bimbingan & Daftar Santri')
@section('page_subtitle', 'Kelola data santri yang terdaftar pada masing-masing kelas Anda.')

@section('content')
<div class="space-y-6">
    @forelse($classes as $cls)
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-rose-100 px-2.5 py-0.5 rounded-md">
                        {{ $cls->status }}
                    </span>
                    <h2 class="text-xl font-bold text-slate-900 mt-2">{{ $cls->name }}</h2>
                    <p class="text-xs text-slate-500">Program: {{ $cls->program->name }} | Level: {{ $cls->level ?? 'Standard' }}</p>
                </div>
                <div class="text-xs text-slate-500">
                    Total Sesi: <strong>{{ $cls->schedules->count() }} Sesi</strong>
                </div>
            </div>

            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-3">Daftar Santri di Kelas Ini:</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse($cls->students as $std)
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-rose-800 text-white font-bold text-xs flex items-center justify-center">
                                    {{ strtoupper(substr($std->name, 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-bold text-slate-900 truncate">{{ $std->name }}</div>
                                    <div class="text-[10px] text-slate-400 truncate">{{ $std->email }}</div>
                                </div>
                            </div>
                            <div class="text-[11px] text-slate-500 border-t border-slate-200/80 pt-2 flex justify-between">
                                <span>Kontak:</span>
                                <strong>{{ $std->studentProfile->phone ?? '-' }}</strong>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-3 text-xs text-slate-400 py-3">Belum ada santri yang dimasukkan ke kelas ini.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-200">
            <p class="text-xs text-slate-400">Belum ada kelas yang terdaftar.</p>
        </div>
    @endforelse

    <div>
        {{ $classes->links() }}
    </div>
</div>
@endsection