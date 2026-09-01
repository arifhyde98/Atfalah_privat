@extends('layouts.dashboard')

@section('page_title', 'Assalamu\'alaikum, ' . $user->name)
@section('page_subtitle', 'Selamat datang di dashboard personal Al-Qur\'an Anda.')

@section('content')
<div class="space-y-8">
    <!-- Top Summary Banner -->
    <div class="bg-gradient-to-r from-primary-900 via-primary-800 to-teal-900 rounded-3xl p-6 sm:p-8 text-white shadow-lg relative overflow-hidden">
        <div class="absolute -right-8 -bottom-8 opacity-10">
            <i data-lucide="book-open" class="w-48 h-48"></i>
        </div>
        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
            <div class="lg:col-span-8 space-y-3">
                <span class="text-xs font-bold tracking-wider text-gold-400 uppercase bg-white/10 px-3 py-1 rounded-full backdrop-blur">
                    Program Aktif
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white">
                    {{ $activeEnrollment ? $activeEnrollment->program->name : 'Belum Memiliki Program Aktif' }}
                </h2>
                <p class="text-xs text-primary-100 max-w-xl leading-relaxed">
                    {{ $activeEnrollment ? $activeEnrollment->program->tagline : 'Silakan pilih program pembelajaran atau ikuti placement test untuk rekomendasi.' }}
                </p>
                <div class="pt-2 flex flex-wrap gap-4 text-xs">
                    <div class="bg-white/10 px-3 py-1.5 rounded-xl border border-white/10">
                        <span class="text-primary-200">Level:</span> <strong class="text-white ml-1">{{ $latestAssessment->level ?? 'Intermediate' }}</strong>
                    </div>
                    <div class="bg-white/10 px-3 py-1.5 rounded-xl border border-white/10">
                        <span class="text-primary-200">Kehadiran:</span> <strong class="text-emerald-300 ml-1">{{ $attendanceRate }}%</strong>
                    </div>
                    <div class="bg-white/10 px-3 py-1.5 rounded-xl border border-white/10">
                        <span class="text-primary-200">Guru Pembimbing:</span> <strong class="text-white ml-1">{{ $studentClasses->first()->teacher->name ?? 'Asatidz ATFALAH' }}</strong>
                    </div>
                </div>
            </div>

            <!-- Quick Next Session Card -->
            <div class="lg:col-span-4 bg-white/10 border border-white/20 backdrop-blur-md rounded-2xl p-5 space-y-3">
                <div class="text-xs font-semibold text-primary-200 flex items-center justify-between">
                    <span>Sesi Belajar Berikutnya</span>
                    <i data-lucide="clock" class="w-4 h-4 text-gold-400"></i>
                </div>
                @if($nextSchedule)
                    <div class="text-lg font-bold text-white">{{ \Carbon\Carbon::parse($nextSchedule->date)->isoFormat('dddd, D MMM Y') }}</div>
                    <div class="text-xs text-emerald-300 font-semibold flex items-center gap-1.5">
                        <i data-lucide="video" class="w-3.5 h-3.5"></i> {{ substr($nextSchedule->start_time, 0, 5) }} - {{ substr($nextSchedule->end_time, 0, 5) }} WIB
                    </div>
                    @if($nextSchedule->meeting_url)
                        <a href="{{ $nextSchedule->meeting_url }}" target="_blank" class="block w-full py-2 bg-emerald-500 hover:bg-emerald-400 text-slate-950 text-center font-bold text-xs rounded-xl shadow transition-colors mt-2">
                            Masuk Google Meet &rarr;
                        </a>
                    @endif
                @else
                    <p class="text-xs text-primary-100">Belum ada jadwal sesi mendatang yang dijadwalkan.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- 2 Columns: Progress Chart & Teacher Feedback -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Progress Radar / Bar -->
        <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Perkembangan Aspek Belajar (Progress)</h3>
                    <p class="text-xs text-slate-500">Evaluasi terukur berdasarkan catatan dewan pengajar.</p>
                </div>
                <a href="{{ route('student.progress') }}" class="text-xs font-bold text-primary-700 hover:underline">Lihat Detail &rarr;</a>
            </div>

            <div class="space-y-4">
                @forelse($progressRecords as $rec)
                    <div>
                        <div class="flex justify-between text-xs font-semibold text-slate-700 mb-1.5">
                            <span>{{ $rec->learning_area }}</span>
                            <span class="text-primary-700 font-bold">{{ $rec->score ?? 80 }}% ({{ ucfirst($rec->level) }})</span>
                        </div>
                        <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-primary-600 to-emerald-400 rounded-full" style="width: {{ $rec->score ?? 80 }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 text-center py-6">Belum ada data progress assessment.</p>
                @endforelse
            </div>
        </div>

        <!-- Latest Teacher Feedback -->
        <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Catatan Feedback Ustadz</h3>
                    <p class="text-xs text-slate-500">Evaluasi dari sesi bimbingan terakhir.</p>
                </div>
                <i data-lucide="message-square" class="w-5 h-5 text-indigo-600"></i>
            </div>

            @if($latestFeedback)
                <div class="space-y-3.5 text-xs">
                    <div class="p-3.5 rounded-2xl bg-emerald-50/70 border border-emerald-100">
                        <span class="font-bold text-emerald-800 flex items-center gap-1.5"><i data-lucide="thumbs-up" class="w-3.5 h-3.5 text-emerald-600"></i> Kelebihan & Kemajuan:</span>
                        <p class="text-slate-700 mt-1 leading-relaxed">{{ $latestFeedback->strengths ?? 'Bacaan semakin percaya diri dan artikulatif.' }}</p>
                    </div>

                    <div class="p-3.5 rounded-2xl bg-amber-50/70 border border-amber-100">
                        <span class="font-bold text-amber-800 flex items-center gap-1.5"><i data-lucide="alert-triangle" class="w-3.5 h-3.5 text-amber-600"></i> Hal yang Perlu Diperbaiki:</span>
                        <p class="text-slate-700 mt-1 leading-relaxed">{{ $latestFeedback->improvements ?? 'Perhatikan kesempurnaan harakat dan mad 2 harakat.' }}</p>
                    </div>

                    <div class="p-3.5 rounded-2xl bg-indigo-50/70 border border-indigo-100">
                        <span class="font-bold text-indigo-800 flex items-center gap-1.5"><i data-lucide="target" class="w-3.5 h-3.5 text-indigo-600"></i> Fokus Sesi Berikutnya:</span>
                        <p class="text-slate-700 mt-1 leading-relaxed">{{ $latestFeedback->next_focus ?? 'Latihan makhraj dan pengulangan ayat.' }}</p>
                    </div>
                </div>
            @else
                <p class="text-xs text-slate-400 text-center py-6">Belum ada catatan feedback dari pengajar.</p>
            @endif
        </div>
    </div>
</div>
@endsection