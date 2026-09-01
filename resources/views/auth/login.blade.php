@extends('layouts.app')

@section('title', 'Masuk Akun — ATFALAH PRIVATE')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <div class="text-center">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-gradient-to-tr from-primary-800 to-primary-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg shadow-primary-700/20">
                أ
            </div>
            <h2 class="mt-6 text-2xl font-extrabold text-slate-900 tracking-tight">
                Selamat Datang Kembali
            </h2>
            <p class="mt-2 text-xs text-slate-500">
                Masuk untuk mengakses jadwal, materi, dan catatan perkembangan belajar.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-2xl text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p class="flex items-center gap-2"><i data-lucide="alert-circle" class="w-4 h-4"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="mt-6 space-y-5" action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </div>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" class="block w-full pl-10 pr-4 py-3 text-sm rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition-all outline-none" placeholder="nama@email.com">
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </div>
                    <input id="password" name="password" type="password" required class="block w-full pl-10 pr-4 py-3 text-sm rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-primary-600 focus:ring-2 focus:ring-primary-100 transition-all outline-none" placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                    <span>Ingat saya di perangkat ini</span>
                </label>
                <a href="https://wa.me/6281234567890" target="_blank" class="text-primary-700 font-semibold hover:underline">Lupa kata sandi?</a>
            </div>

            <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-semibold text-sm shadow-lg shadow-primary-700/25 hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                <span>Masuk ke Akun</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

        <!-- Demo Accounts Quick Info -->
        <div class="mt-6 pt-6 border-t border-slate-100 text-[11px] text-slate-500">
            <p class="font-semibold text-slate-700 mb-2">Akun Demo (Klik untuk mengisi):</p>
            <div class="grid grid-cols-3 gap-2">
                <button type="button" onclick="fillCreds('admin@atfalah.com', 'password')" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-left border border-slate-200">
                    <div class="font-bold text-[10px] text-slate-900">Admin</div>
                    <div class="text-[9px] text-slate-500 truncate">admin@atfalah.com</div>
                </button>
                <button type="button" onclick="fillCreds('ustadz.ahmad@atfalah.com', 'password')" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-left border border-slate-200">
                    <div class="font-bold text-[10px] text-indigo-700">Teacher</div>
                    <div class="text-[9px] text-slate-500 truncate">ustadz.ahmad</div>
                </button>
                <button type="button" onclick="fillCreds('student@atfalah.com', 'password')" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-left border border-slate-200">
                    <div class="font-bold text-[10px] text-emerald-700">Student</div>
                    <div class="text-[9px] text-slate-500 truncate">student@atfalah</div>
                </button>
            </div>
            <p class="text-[10px] text-slate-400 mt-2 text-center">Password semua akun demo: <code>password</code></p>
        </div>

        <p class="text-center text-xs text-slate-500">
            Belum memiliki akun?
            <a href="{{ route('register') }}" class="font-semibold text-primary-700 hover:underline ml-1">Daftar sekarang</a>
        </p>
    </div>
</div>

<script>
function fillCreds(email, password) {
    document.getElementById('email').value = email;
    document.getElementById('password').value = password;
}
</script>
@endsection