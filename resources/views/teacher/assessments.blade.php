@extends('layouts.dashboard')

@section('page_title', 'Formulir Assessment & Evaluasi Santri')
@section('page_subtitle', 'Input nilai assessment placement, progress, dan final berkala.')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Form Input Assessment -->
    <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Input Assessment Baru</h3>
        <form action="{{ route('teacher.assessments.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Pilih Santri</label>
                <select name="student_id" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="">-- Pilih Santri --</option>
                    @foreach($students as $std)
                        <option value="{{ $std->id }}">{{ $std->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tipe Assessment</label>
                    <select name="type" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                        <option value="progress">Progress Evaluasi</option>
                        <option value="placement">Placement Awal</option>
                        <option value="final">Ujian Akhir (Final)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal</label>
                    <input type="date" name="assessment_date" value="{{ date('Y-m-d') }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Skor Rata-rata (0-100)</label>
                    <input type="number" step="0.1" name="score" placeholder="85.5" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Level Capaian</label>
                    <input type="text" name="level" placeholder="Developing / Intermediate" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                </div>
            </div>

            <div class="space-y-2 pt-2 border-t border-slate-100">
                <label class="block text-xs font-bold text-slate-800">Skor Rincian Kriteria:</label>
                <div class="grid grid-cols-3 gap-2">
                    <input type="text" name="criteria[]" value="Makharijul Huruf" class="px-2.5 py-2 rounded-xl border border-slate-200 text-[11px]">
                    <input type="number" step="0.1" name="criteria_scores[]" placeholder="Skor" class="col-span-2 px-2.5 py-2 rounded-xl border border-slate-200 text-[11px]">
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <input type="text" name="criteria[]" value="Hukum Tajwid" class="px-2.5 py-2 rounded-xl border border-slate-200 text-[11px]">
                    <input type="number" step="0.1" name="criteria_scores[]" placeholder="Skor" class="col-span-2 px-2.5 py-2 rounded-xl border border-slate-200 text-[11px]">
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <input type="text" name="criteria[]" value="Kelancaran / Fluency" class="px-2.5 py-2 rounded-xl border border-slate-200 text-[11px]">
                    <input type="number" step="0.1" name="criteria_scores[]" placeholder="Skor" class="col-span-2 px-2.5 py-2 rounded-xl border border-slate-200 text-[11px]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan & Rekomendasi Pengajar</label>
                <textarea name="recommendation" rows="2" placeholder="Tingkatkan latihan mad 2 harakat..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none"></textarea>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow transition-colors">
                Simpan Penilaian Assessment
            </button>
        </form>
    </div>

    <!-- Assessment List -->
    <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Riwayat Assessment yang Diberikan</h3>
        <div class="space-y-4">
            @forelse($assessments as $ass)
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-xs text-slate-900">{{ $ass->student->name }}</span>
                        <span class="text-xs font-bold text-primary-700 bg-primary-100 px-2.5 py-0.5 rounded-full">Skor: {{ $ass->score }}</span>
                    </div>
                    <div class="text-[11px] text-slate-500">Tipe: {{ ucfirst($ass->type) }} | {{ \Carbon\Carbon::parse($ass->assessment_date)->format('d M Y') }}</div>
                    <p class="text-xs text-slate-600 italic">{{ $ass->recommendation }}</p>
                </div>
            @empty
                <p class="text-xs text-slate-400 text-center py-6">Belum ada data assessment yang diinput.</p>
            @endforelse
        </div>
        <div>
            {{ $assessments->links() }}
        </div>
    </div>
</div>
@endsection