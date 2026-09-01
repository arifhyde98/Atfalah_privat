@extends('layouts.dashboard')

@section('page_title', 'Jadwal Sesi Belajar & Virtual Room')
@section('page_subtitle', 'Jadwalkan sesi bimbingan dan masukkan link Google Meet / Zoom.')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Schedule Planner Form -->
    <div class="lg:col-span-4 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-4">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Jadwalkan Sesi Baru</h3>
        <form action="{{ route('admin.schedules.store') }}" method="POST" class="space-y-3 text-xs">
            @csrf
            <div>
                <label class="font-semibold text-slate-700 block mb-1">Pilih Kelas *</label>
                <select name="class_id" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($classes as $cls)
                        <option value="{{ $cls->id }}">{{ $cls->name }} (Guru: {{ $cls->teacher->name }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Tanggal Sesi *</label>
                <input type="date" name="date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="font-semibold text-slate-700 block mb-1">Jam Mulai *</label>
                    <input type="time" name="start_time" value="19:30" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                </div>
                <div>
                    <label class="font-semibold text-slate-700 block mb-1">Jam Selesai *</label>
                    <input type="time" name="end_time" value="20:30" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                </div>
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Link Meeting (Google Meet / Zoom)</label>
                <input type="url" name="meeting_url" placeholder="https://meet.google.com/xyz" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Status Sesi</label>
                <select name="status" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="scheduled">Scheduled</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <button type="submit" class="w-full py-2.5 bg-rose-700 hover:bg-rose-800 text-white font-bold rounded-xl shadow transition-colors">
                Simpan Jadwal Sesi
            </button>
        </form>
    </div>

    <!-- Schedules Table -->
    <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Daftar Seluruh Jadwal Sesi</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-slate-700 font-bold uppercase text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4">Tanggal & Jam</th>
                        <th class="py-3.5 px-4">Kelas & Program</th>
                        <th class="py-3.5 px-4">Pengajar</th>
                        <th class="py-3.5 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($schedules as $sch)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 font-bold text-slate-900">
                                <div>{{ \Carbon\Carbon::parse($sch->date)->isoFormat('dddd, D MMM Y') }}</div>
                                <div class="text-[11px] text-slate-500">{{ substr($sch->start_time, 0, 5) }} - {{ substr($sch->end_time, 0, 5) }} WIB</div>
                            </td>
                            <td class="py-4 px-4 font-semibold text-slate-800">{{ $sch->classModel->name }}</td>
                            <td class="py-4 px-4">{{ $sch->teacher->name }}</td>
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $sch->status == 'completed' ? 'bg-rose-100 text-emerald-800' : 'bg-sky-100 text-sky-800' }}">
                                    {{ ucfirst($sch->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-400">Belum ada data jadwal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>
            {{ $schedules->links() }}
        </div>
    </div>
</div>
@endsection