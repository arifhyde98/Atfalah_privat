@extends('layouts.dashboard')

@section('page_title', 'Teacher Feedback Form')
@section('page_subtitle', 'Berikan masukan terstruktur untuk santri setelah sesi bimbingan.')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Form Input Feedback -->
    <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Kirim Feedback Baru</h3>
        <form action="{{ route('teacher.feedback.store') }}" method="POST" class="space-y-4">
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

            <div>
                <label class="block text-xs font-semibold text-emerald-800 mb-1">Kelebihan / Kemajuan (Strengths)</label>
                <textarea name="strengths" rows="2" placeholder="Makhraj huruf halq sudah sangat bersih..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-amber-800 mb-1">Hal yang Perlu Diperbaiki (Improvements)</label>
                <textarea name="improvements" rows="2" placeholder="Perhatikan durasi ghunnah 2 harakat..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-indigo-800 mb-1">Fokus Sesi Berikutnya (Next Focus)</label>
                <textarea name="next_focus" rows="2" placeholder="Persiapan latihan ayat 1-20 surah An-Naba'..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none"></textarea>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-rose-700 hover:bg-rose-800 text-white font-bold text-xs shadow transition-colors">
                Kirim Feedback ke Santri
            </button>
        </form>
    </div>

    <!-- Feedback List -->
    <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Riwayat Feedback yang Dikirim</h3>
        <div class="space-y-4">
            @forelse($feedbacks as $fb)
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2 text-xs">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                        <span class="font-bold text-slate-900">Santri: {{ $fb->student->name }}</span>
                        <span class="text-[10px] text-slate-400">{{ $fb->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text-slate-700"><strong>Kelebihan:</strong> {{ $fb->strengths ?? '-' }}</div>
                    <div class="text-slate-700"><strong>Perbaikan:</strong> {{ $fb->improvements ?? '-' }}</div>
                    <div class="text-slate-700"><strong>Next Focus:</strong> {{ $fb->next_focus ?? '-' }}</div>
                </div>
            @empty
                <p class="text-xs text-slate-400 text-center py-6">Belum ada feedback yang dikirim.</p>
            @endforelse
        </div>
        <div>
            {{ $feedbacks->links() }}
        </div>
    </div>
</div>
@endsection