@extends('layouts.dashboard')

@section('page_title', 'Tambah Pengajar Baru')
@section('page_subtitle', 'Masukkan data dewan guru dan spesialisasi keilmuan.')

@section('content')
<div class="max-w-2xl bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
    <form action="{{ route('admin.teachers.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap & Gelar *</label>
            <input name="name" type="text" placeholder="Ustadz Ahmad Al-Hafizh" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Email Login *</label>
                <input name="email" type="email" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Password *</label>
                <input name="password" type="password" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">No WhatsApp</label>
                <input name="phone" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Status Akun</label>
                <select name="status" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Spesialisasi Program</label>
            <input name="specialization" type="text" placeholder="Tahsin & Tajwid, Qur'an Reading" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Biografi Singkat / Sanad</label>
            <textarea name="bio" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none"></textarea>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow transition-colors">
                Simpan Data Pengajar
            </button>
            <a href="{{ route('admin.teachers.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-semibold">Batal</a>
        </div>
    </form>
</div>
@endsection