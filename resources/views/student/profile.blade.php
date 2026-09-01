@extends('layouts.dashboard')

@section('page_title', 'Profil Akun Saya')
@section('page_subtitle', 'Kelola informasi identitas pribadi dan kontak komunikasi.')

@section('content')
<div class="max-w-2xl bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
    <form action="{{ route('student.profile.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
            <input name="name" type="text" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email (Login)</label>
            <input type="email" value="{{ $user->email }}" disabled class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-xs text-slate-500 cursor-not-allowed">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor WhatsApp</label>
                <input name="phone" type="text" value="{{ old('phone', $profile->phone ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jenis Kelamin</label>
                <select name="gender" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                    <option value="">Pilih</option>
                    <option value="male" {{ (old('gender', $profile->gender ?? '') == 'male') ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ (old('gender', $profile->gender ?? '') == 'female') ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Lahir</label>
            <input name="date_of_birth" type="date" value="{{ old('date_of_birth', $profile && $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Domisili</label>
            <textarea name="address" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">{{ old('address', $profile->address ?? '') }}</textarea>
        </div>

        <div class="pt-4 border-t border-slate-100">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-rose-700 hover:bg-rose-800 text-white font-bold text-xs shadow transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection