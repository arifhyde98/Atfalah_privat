@extends('layouts.dashboard')

@section('page_title', 'Dashboard Pengajar — ' . auth()->user()->name)
@section('page_subtitle', 'Ringkasan jadwal mengajar, kelas bimbingan, dan evaluasi santri.')

@section('content')
<div class="space-y-8">
    <!-- Top Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                <i data-lucide="calendar" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs text-slate-500 font-medium">Sesi Hari Ini</div>
                <div class="text-2xl font-bold text-slate-900">{{ $todaySchedules->count() }} Sesi</div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center">
                <i data-lucide="school" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs text-slate-500 font-medium">Kelas Aktif Diampu</div>
                <div class="text-2xl font-bold text-slate-900">{{ $assignedClasses->count() }} Kelas</div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center">
                <i data-lucide="message-square" class="w-6 h-6"></i>
            </div>
            <div>
                <div class="text-xs text-slate-500 font-medium">Feedback Terkirim</div>
                <div class="text-2xl font-bold text-slate-900">{{ $recentFeedbacks->count() }} Feedback</div>
            </div>
        </div>
    </div>

    <!-- Today Schedules & Classes -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Today / Upcoming Schedules -->
        <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Agenda Sesi Mengajar Mendatang</h3>
                    <p class="text-xs text-slate-500">Jadwal bimbingan privat 1-on-1 bersama santri.</p>
                </div>
                <a href="{{ route('teacher.schedules') }}" class="text-xs font-bold text-primary-700 hover:underline">Semua Jadwal &rarr;</a>
            </div>

            <div class="space-y-4">
                @forelse($upcomingSchedules as $sch)
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xs text-slate-900">{{ \Carbon\Carbon::parse($sch->date)->isoFormat('dddd, D MMM') }}</span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800">{{ substr($sch->start_time, 0, 5) }} - {{ substr($sch->end_time, 0, 5) }} WIB</span>
                            </div>
                            <div class="text-xs font-semibold text-slate-800">{{ $sch->classModel->name }}</div>
                            <div class="text-[11px] text-slate-500">Santri: <strong>{{ $sch->classModel->students->pluck('name')->join(', ') }}</strong></div>
                        </div>

                        <div class="flex items-center gap-2">
                            @if($sch->meeting_url)
                                <a href="{{ $sch->meeting_url }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition-colors flex items-center gap-1">
                                    <i data-lucide="video" class="w-3.5 h-3.5"></i> Google Meet
                                </a>
                            @endif
                            <a href="{{ route('teacher.attendance', $sch->id) }}" class="px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs transition-colors">
                                Input Presensi
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 text-center py-6">Tidak ada agenda mengajar terdekat.</p>
                @endforelse
            </div>
        </div>

        <!-- Assigned Classes List -->
        <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Daftar Kelas Bimbingan</h3>
                    <p class="text-xs text-slate-500">Kelas yang Anda ampu saat ini.</p>
                </div>
            </div>

            <div class="space-y-3">
                @forelse($assignedClasses as $cls)
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-900">{{ $cls->name }}</span>
                            <span class="text-[10px] font-bold text-primary-700 bg-primary-100 px-2 py-0.5 rounded-full">{{ $cls->students_count }} Santri</span>
                        </div>
                        <div class="text-[11px] text-slate-500">Program: <strong>{{ $cls->program->name }}</strong> (Level: {{ $cls->level ?? 'Standard' }})</div>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 text-center py-6">Belum ada kelas yang ditugaskan.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection