@extends('layouts.dashboard')

@section('page_title', 'Kelola Program & Silabus — ' . $program->name)
@section('page_subtitle', 'Edit deskripsi program dan susun daftar topik kurikulum.')

@section('content')
<div class="space-y-8">
    <!-- Edit Program Details -->
    <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Informasi Program</h3>
        <form action="{{ route('admin.programs.update', $program->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Program *</label>
                    <input name="name" type="text" value="{{ old('name', $program->name) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tagline</label>
                    <input name="tagline" type="text" value="{{ old('tagline', $program->tagline) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Lengkap</label>
                <textarea name="description" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">{{ old('description', $program->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tujuan Pembelajaran (Learning Goal)</label>
                    <textarea name="learning_goal" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">{{ old('learning_goal', $program->learning_goal) }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Target Peserta (Target Audience)</label>
                    <textarea name="target_audience" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">{{ old('target_audience', $program->target_audience) }}</textarea>
                </div>
            </div>

            <div class="flex justify-between items-center pt-3">
                <select name="status" class="px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="active" {{ $program->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="draft" {{ $program->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="inactive" {{ $program->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow transition-colors">
                    Simpan Perubahan Program
                </button>
            </div>
        </form>
    </div>

    <!-- Curriculum Items Management -->
    <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <h3 class="text-base font-bold text-slate-900">Daftar Modul & Topik Silabus</h3>
                <p class="text-xs text-slate-500">Urutan topik pembelajaran bertahap.</p>
            </div>
        </div>

        <!-- Add Curriculum Form -->
        <form action="{{ route('admin.programs.curriculum.store', $program->id) }}" method="POST" class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
            @csrf
            <div class="text-xs font-bold text-slate-800">+ Tambah Modul Topik Baru:</div>
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                <div class="sm:col-span-2">
                    <input type="number" name="sequence" value="{{ $program->curriculumItems->count() + 1 }}" placeholder="Urutan" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-white">
                </div>
                <div class="sm:col-span-6">
                    <input type="text" name="title" placeholder="Judul Topik / Kaidah Tajwid" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-white">
                </div>
                <div class="sm:col-span-2">
                    <select name="status" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs bg-white">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <button type="submit" class="w-full py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-xl shadow transition-colors">
                        Tambah
                    </button>
                </div>
            </div>
        </form>

        <!-- Curriculum Items List -->
        <div class="space-y-3">
            @forelse($program->curriculumItems as $item)
                <div class="p-4 rounded-2xl bg-white border border-slate-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 rounded-lg bg-primary-800 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">
                            {{ $item->sequence }}
                        </span>
                        <div>
                            <div class="text-xs font-bold text-slate-900">{{ $item->title }}</div>
                            <div class="text-[11px] text-slate-400">{{ $item->description }}</div>
                        </div>
                    </div>
                    <form action="{{ route('admin.curriculum.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus topik ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-rose-600 hover:text-rose-800 p-1">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-xs text-slate-400 text-center py-6">Belum ada topik kurikulum.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection