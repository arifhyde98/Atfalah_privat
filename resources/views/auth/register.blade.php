@extends('layouts.app')

@section('title', 'Pendaftaran Belajar — ATFALAH PRIVATE')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <div class="max-w-xl w-full space-y-8 bg-white p-8 sm:p-10 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <div class="text-center">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-gradient-to-tr from-primary-800 to-primary-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg shadow-primary-700/20">
                أ
            </div>
            <h2 class="mt-6 text-2xl font-extrabold text-slate-900 tracking-tight">
                Mulai Perjalanan Qur'an Anda
            </h2>
            <p class="mt-2 text-xs text-slate-500">
                Lengkapi formulir pendaftaran untuk memulai pembelajaran privat terstruktur.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-2xl text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p class="flex items-center gap-2"><i data-lucide="alert-circle" class="w-4 h-4"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="mt-6 space-y-4" action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap *</label>
                <input name="name" type="text" required value="{{ old('name') }}" class="block w-full px-4 py-3 text-sm rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition-all outline-none" placeholder="Contoh: Ahmad Fauzi">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email Aktif *</label>
                    <input name="email" type="email" required value="{{ old('email') }}" class="block w-full px-4 py-3 text-sm rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition-all outline-none" placeholder="nama@email.com">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor WhatsApp *</label>
                    <input name="phone" type="text" required value="{{ old('phone') }}" class="block w-full px-4 py-3 text-sm rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition-all outline-none" placeholder="08123456789">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jenis Kelamin</label>
                    <select name="gender" class="block w-full px-4 py-3 text-sm rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition-all outline-none">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki (Ikhwan)</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan (Akhwat)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Pilihan Program Pembelajaran</label>
                    <select name="program_id" class="block w-full px-4 py-3 text-sm rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition-all outline-none">
                        <option value="">Belum Memilih / Butuh Konsultasi</option>
                        @foreach($programs as $prog)
                            <option value="{{ $prog->id }}" {{ (old('program_id') == $prog->id || $selectedProgram == $prog->slug) ? 'selected' : '' }}>
                                {{ $prog->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi Akun *</label>
                    <input name="password" type="password" required class="block w-full px-4 py-3 text-sm rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition-all outline-none" placeholder="Minimal 6 karakter">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Ulangi Kata Sandi *</label>
                    <input name="password_confirmation" type="password" required class="block w-full px-4 py-3 text-sm rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition-all outline-none" placeholder="Ulangi kata sandi">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Catatan / Target Belajar Anda (Opsional)</label>
                <textarea name="notes" rows="2" class="block w-full px-4 py-3 text-sm rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition-all outline-none" placeholder="Contoh: Ingin bisa lancar membaca Al-Qur'an dari nol atau memperbaiki hukum tajwid...">{{ old('notes') }}</textarea>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-semibold text-sm shadow-lg shadow-primary-700/25 hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                    <span>Selesaikan Pendaftaran</span>
                    <i data-lucide="check" class="w-4 h-4"></i>
                </button>
            </div>
        </form>

        <p class="text-center text-xs text-slate-500">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="font-semibold text-primary-700 hover:underline ml-1">Masuk ke portal</a>
        </p>
    </div>
</div>
@endsection