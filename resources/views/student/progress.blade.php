@extends('layouts.dashboard')

@section('page_title', 'Perkembangan & Rekap Evaluasi Belajar')
@section('page_subtitle', 'Laporan hasil assessment berkala dan catatan evaluasi dewan guru.')

@section('content')
<div class="space-y-8">
    <!-- Progress Records Grid -->
    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Ringkasan Penguasaan Aspek Pembelajaran</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($progressRecords as $rec)
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-900">{{ $rec->learning_area }}</span>
                        <span class="text-xs font-bold text-primary-700">{{ $rec->score }}%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                        <div class="h-full bg-primary-600 rounded-full" style="width: {{ $rec->score }}%"></div>
                    </div>
                    <div class="flex items-center justify-between text-[11px] text-slate-500">
                        <span>Tingkat Level:</span>
                        <strong class="text-slate-700 capitalize">{{ str_replace('_', ' ', $rec->level) }}</strong>
                    </div>
                    <p class="text-[11px] text-slate-500 italic border-t border-slate-200 pt-2">{{ $rec->notes }}</p>
                </div>
            @empty
                <p class="col-span-3 text-xs text-slate-400 text-center py-6">Belum ada data progress records.</p>
            @endforelse
        </div>
    </div>

    <!-- Formal Assessments History -->
    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Riwayat Penilaian & Assessment Formal</h3>
        <div class="space-y-6">
            @forelse($assessments as $ass)
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-200/80 pb-3">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-0.5 rounded-md">
                                Assessment {{ ucfirst($ass->type) }}
                            </span>
                            <div class="text-base font-bold text-slate-900 mt-1">Penguji: {{ $ass->teacher->name }}</div>
                        </div>
                        <div class="text-xs text-slate-500">
                            <div>Tanggal: <strong>{{ \Carbon\Carbon::parse($ass->assessment_date)->format('d M Y') }}</strong></div>
                            <div>Skor Akhir: <strong class="text-emerald-700 text-sm">{{ $ass->score }}</strong></div>
                        </div>
                    </div>

                    <!-- Breakdown Criteria -->
                    @if($ass->items->count() > 0)
                        <div>
                            <div class="text-xs font-bold text-slate-700 mb-2">Breakdown Penilaian Kriteria:</div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach($ass->items as $item)
                                    <div class="p-3 rounded-xl bg-white border border-slate-200 text-xs">
                                        <div class="font-bold text-slate-800">{{ $item->criterion }}</div>
                                        <div class="text-primary-700 font-bold text-sm">{{ $item->score }}</div>
                                        <div class="text-[10px] text-slate-400 mt-0.5">{{ $item->note }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="p-4 rounded-xl bg-white border border-slate-200 text-xs space-y-1.5">
                        <div class="font-bold text-slate-800">Rekomendasi Dewan Pengajar:</div>
                        <p class="text-slate-600 leading-relaxed">{{ $ass->recommendation }}</p>
                    </div>
                </div>
            @empty
                <p class="text-xs text-slate-400 text-center py-6">Belum ada riwayat assessment formal.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection