@extends('layouts.dashboard')

@section('page_title', 'Jadwal & Agenda Mengajar')
@section('page_subtitle', 'Daftar seluruh sesi kelas dan akses cepat presensi.')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-600">
            <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] border-b border-slate-200">
                <tr>
                    <th class="py-3.5 px-4">Tanggal & Waktu</th>
                    <th class="py-3.5 px-4">Nama Kelas</th>
                    <th class="py-3.5 px-4">Santri</th>
                    <th class="py-3.5 px-4">Status Sesi</th>
                    <th class="py-3.5 px-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($schedules as $sch)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-4 font-bold text-slate-900">
                            <div>{{ \Carbon\Carbon::parse($sch->date)->isoFormat('dddd, D MMM Y') }}</div>
                            <div class="text-[11px] text-slate-500">{{ substr($sch->start_time, 0, 5) }} - {{ substr($sch->end_time, 0, 5) }} WIB</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-semibold text-slate-800">{{ $sch->classModel->name }}</div>
                            <div class="text-[11px] text-primary-700">{{ $sch->classModel->program->name }}</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="text-slate-800">{{ $sch->classModel->students->pluck('name')->join(', ') }}</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $sch->status == 'completed' ? 'bg-emerald-100 text-emerald-800' : 'bg-sky-100 text-sky-800' }}">
                                {{ ucfirst($sch->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-right space-x-2">
                            @if($sch->meeting_url)
                                <a href="{{ $sch->meeting_url }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[11px]">
                                    <i data-lucide="video" class="w-3.5 h-3.5"></i> Meet
                                </a>
                            @endif
                            <a href="{{ route('teacher.attendance', $sch->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold text-[11px]">
                                Presensi
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400">Belum ada data jadwal mengajar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $schedules->links() }}
    </div>
</div>
@endsection