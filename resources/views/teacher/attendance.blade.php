@extends('layouts.dashboard')

@section('page_title', 'Input Presensi Kehadiran Santri')
@section('page_subtitle', 'Sesi: ' . $schedule->classModel->name . ' (' . \Carbon\Carbon::parse($schedule->date)->isoFormat('dddd, D MMM Y') . ')')

@section('content')
<div class="max-w-3xl bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
    <form action="{{ route('teacher.attendance.save', $schedule->id) }}" method="POST" class="space-y-6">
        @csrf

        <div class="space-y-4">
            @foreach($schedule->classModel->students as $std)
                @php
                    $existing = $schedule->attendances->firstWhere('student_id', $std->id);
                @endphp
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="font-bold text-sm text-slate-900">{{ $std->name }}</div>
                        <div class="flex items-center gap-3 text-xs">
                            <label class="flex items-center gap-1.5 cursor-pointer">
                                <input type="radio" name="attendances[{{ $std->id }}][status]" value="present" {{ (!$existing || $existing->status == 'present') ? 'checked' : '' }} class="text-primary-600 focus:ring-primary-500">
                                <span>Hadir</span>
                            </label>
                            <label class="flex items-center gap-1.5 cursor-pointer">
                                <input type="radio" name="attendances[{{ $std->id }}][status]" value="late" {{ ($existing && $existing->status == 'late') ? 'checked' : '' }} class="text-amber-600 focus:ring-amber-500">
                                <span>Terlambat</span>
                            </label>
                            <label class="flex items-center gap-1.5 cursor-pointer">
                                <input type="radio" name="attendances[{{ $std->id }}][status]" value="excused" {{ ($existing && $existing->status == 'excused') ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500">
                                <span>Izin</span>
                            </label>
                            <label class="flex items-center gap-1.5 cursor-pointer">
                                <input type="radio" name="attendances[{{ $std->id }}][status]" value="absent" {{ ($existing && $existing->status == 'absent') ? 'checked' : '' }} class="text-rose-600 focus:ring-rose-500">
                                <span>Alpa</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <input type="text" name="attendances[{{ $std->id }}][notes]" value="{{ $existing->notes ?? '' }}" placeholder="Catatan keaktifan santri pada sesi ini..." class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:border-primary-600 outline-none">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-rose-700 hover:bg-rose-800 text-white font-bold text-xs shadow transition-colors">
                Simpan Presensi Sesi Ini
            </button>
            <a href="{{ route('teacher.schedules') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition-colors">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection