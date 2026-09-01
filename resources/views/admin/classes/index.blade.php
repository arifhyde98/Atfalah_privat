@extends('layouts.dashboard')

@section('page_title', 'Manajemen Kelas & Pairing Santri-Guru')
@section('page_subtitle', 'Buat kelas bimbingan privat, tugaskan ustadz pengajar, dan masukkan santri.')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Create Class Form -->
    <div class="lg:col-span-4 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-4">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Buat Kelas Baru</h3>
        <form action="{{ route('admin.classes.store') }}" method="POST" class="space-y-3 text-xs">
            @csrf
            <div>
                <label class="font-semibold text-slate-700 block mb-1">Nama Kelas *</label>
                <input type="text" name="name" placeholder="Tahsin Eksekutif Malam A" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Program *</label>
                <select name="program_id" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="">-- Pilih Program --</option>
                    @foreach($programs as $prog)
                        <option value="{{ $prog->id }}">{{ $prog->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Ustadz / Pengajar *</label>
                <select name="teacher_id" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="">-- Pilih Pengajar --</option>
                    @foreach($teachers as $tch)
                        <option value="{{ $tch->id }}">{{ $tch->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Level Kelas</label>
                <input type="text" name="level" placeholder="Beginner / Intermediate" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>

            <div>
                <label class="font-semibold text-slate-700 block mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="w-full py-2.5 bg-rose-700 hover:bg-rose-800 text-white font-bold rounded-xl shadow transition-colors">
                Buat Kelas Baru
            </button>
        </form>
    </div>

    <!-- Classes List & Student Assignment -->
    <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Daftar Kelas & Pasangkan Santri</h3>
        
        <div class="space-y-6">
            @forelse($classes as $cls)
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-slate-200 pb-3">
                        <div>
                            <div class="font-bold text-base text-slate-900">{{ $cls->name }}</div>
                            <div class="text-xs text-primary-700 font-semibold">{{ $cls->program->name }} | Guru: {{ $cls->teacher->name }}</div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-100 text-emerald-800">
                            {{ ucfirst($cls->status) }}
                        </span>
                    </div>

                    <!-- Students inside this class -->
                    <div>
                        <div class="text-xs font-bold text-slate-700 mb-2">Santri Terdaftar:</div>
                        <div class="flex flex-wrap gap-2 mb-3">
                            @forelse($cls->students as $std)
                                <span class="px-3 py-1 bg-white border border-slate-200 rounded-xl text-xs text-slate-800 font-medium">
                                    {{ $std->name }}
                                </span>
                            @empty
                                <span class="text-xs text-slate-400 italic">Belum ada santri di kelas ini.</span>
                            @endforelse
                        </div>

                        <!-- Assign Student Form -->
                        <form action="{{ route('admin.classes.assignStudent', $cls->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <select name="student_id" required class="flex-1 px-3 py-1.5 rounded-xl border border-slate-200 text-xs bg-white focus:border-primary-600 outline-none">
                                <option value="">+ Masukkan Santri ke Kelas Ini</option>
                                @foreach($students as $std)
                                    <option value="{{ $std->id }}">{{ $std->name }} ({{ $std->email }})</option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-4 py-1.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-colors">
                                Tambahkan
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-xs text-slate-400 text-center py-6">Belum ada kelas yang dibuat.</p>
            @endforelse
        </div>

        <div>
            {{ $classes->links() }}
        </div>
    </div>
</div>
@endsection