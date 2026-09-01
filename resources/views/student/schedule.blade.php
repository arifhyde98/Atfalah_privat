@extends('layouts.dashboard')

@section('page_title', 'Jadwal Sesi Pembelajaran')
@section('page_subtitle', 'Daftar jadwal sesi privat dan link virtual class.')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-600">
            <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] border-b border-slate-200">
                <tr>
                    <th class="py-3.5 px-4">Tanggal & Waktu</th>
                    <th class="py-3.5 px-4">Kelas & Program</th>
                    <th class="py-3.5 px-4">Ustadz/Ustadzah</th>
                    <th class="py-3.5 px-4">Status Sesi</th>
                    <th class="py-3.5 px-4">Kehadiran Saya</th>
                    <th class="py-3.5 px-4 text-right">Aksi Link</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($schedules as $sch)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-4">
                            <div class="font-bold text-slate-900">{{ \Carbon\Carbon::parse($sch->date)->isoFormat('dddd, D MMM Y') }}</div>
                            <div class="text-[11px] text-slate-500">{{ substr($sch->start_time, 0, 5) }} - {{ substr($sch->end_time, 0, 5) }} WIB</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-semibold text-slate-800">{{ $sch->classModel->name }}</div>
                            <div class="text-[11px] text-primary-700">{{ $sch->classModel->program->name }}</div>
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-medium text-slate-800">{{ $sch->teacher->name }}</div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $sch->status == 'completed' ? 'bg-emerald-100 text-emerald-800' : ($sch->status == 'scheduled' ? 'bg-sky-100 text-sky-800' : 'bg-rose-100 text-rose-800') }}">
                                {{ ucfirst($sch->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            @php
                                $att = $sch->attendances->first();
                            @endphp
                            @if($att)
                                <span class="font-bold text-xs {{ $att->status == 'present' ? 'text-emerald-600' : 'text-amber-600' }}">
                                    {{ ucfirst($att->status) }}
                                </span>
                            @else
                                <span class="text-slate-400 italic text-[11px]">Belum berlangsung</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-right">
                            @if($sch->meeting_url && $sch->status == 'scheduled')
                                <a href="{{ $sch->meeting_url }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[11px] shadow transition-colors">
                                    <i data-lucide="video" class="w-3.5 h-3.5"></i> Buka Link Meet
                                </a>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400">Belum ada riwayat jadwal pembelajaran.</td>
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