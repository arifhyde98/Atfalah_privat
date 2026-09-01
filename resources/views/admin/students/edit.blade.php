@extends('layouts.dashboard')

@section('page_title', 'Edit Data Student')
@section('page_subtitle', 'Perbarui data identitas santri: ' . $student->name)

@section('content')
<div class="max-w-2xl bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
    <form action="{{ route('admin.students.update', $student->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap *</label>
            <input name="name" type="text" value="{{ old('name', $student->name) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Email Login *</label>
                <input name="email" type="email" value="{{ old('email', $student->email) }}" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Password Baru (Opsional)</label>
                <input name="password" type="password" placeholder="Kosongkan jika tidak diubah" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">No WhatsApp</label>
                <input name="phone" type="text" value="{{ old('phone', $student->studentProfile->phone ?? '') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Status Akun</label>
                <select name="status" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow transition-colors">
                Perbarui Data Student
            </button>
            <a href="{{ route('admin.students.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-semibold">Batal</a>
        </div>
    </form>
</div>
@endsection