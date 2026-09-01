@extends('layouts.dashboard')

@section('page_title', 'Buat Program Baru')
@section('page_subtitle', 'Tambahkan program pembelajaran baru ke dalam sistem.')

@section('content')
<div class="max-w-2xl bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
    <form action="{{ route('admin.programs.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Program *</label>
            <input name="name" type="text" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Tagline</label>
            <input name="tagline" type="text" placeholder="From Zero to Qur'an Reading" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Lengkap</label>
            <textarea name="description" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none"></textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Status</label>
            <select name="status" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                <option value="active">Active</option>
                <option value="draft">Draft</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow transition-colors">
                Simpan Program
            </button>
            <a href="{{ route('admin.programs.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-semibold">Batal</a>
        </div>
    </form>
</div>
@endsection