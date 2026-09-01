@extends('layouts.dashboard')

@section('page_title', 'Rekap Presensi Kehadiran')
@section('page_subtitle', 'Catatan kehadiran pada setiap sesi kelas privat Anda.')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-600">
            <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] border-b border-slate-200">
                <tr>
                    <th class="py-3.5 px-4">Tanggal Sesi</th>
                    <th class="py-3.5 px-4">Kelas & Program</th>
                    <th class="py-3.5 px-4">Ustadz Pengajar</th>
                    <th class="py-3.5 px-4">Status Kehadiran</th>
                    <th class="py-3.5 px-4">Catatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($attendances as $att)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-4 font-bold text-slate-900">
                            {{ \Carbon\Carbon::parse($att->schedule->date)->isoFormat('dddd, D MMMM Y') }}
                        </td>
                        <td class="py-4 px-4">
                            <div class="font-semibold text-slate-800">{{ $att->schedule->classModel->name }}</div>
                            <div class="text-[11px] text-primary-700">{{ $att->schedule->classModel->program->name }}</div>
                        </td>
                        <td class="py-4 px-4">{{ $att->schedule->teacher->name }}</td>
                        <td class="py-4 px-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $att->status == 'present' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ ucfirst($att->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-slate-500">{{ $att->notes ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400">Belum ada riwayat kehadiran tercatat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $attendances->links() }}
    </div>
</div>
@endsection