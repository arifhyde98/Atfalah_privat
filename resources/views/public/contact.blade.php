@extends('layouts.app')

@section('title', 'Hubungi Kami — ATFALAH PRIVATE')

@section('content')
<div class="bg-islamic-pattern text-white py-20 border-b-4 border-gold-500/80 relative">
    <div class="max-w-4xl mx-auto px-4 text-center space-y-3 relative z-10">
        <div class="text-gold-400 font-quran text-2xl mb-1">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-950/80 border border-gold-500/30 text-xs font-bold tracking-widest text-gold-400 uppercase">
            <span>۞</span> Layanan Konsultasi <span>۞</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight font-serif">Hubungi Konsultan ATFALAH</h1>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-2xl mx-auto leading-relaxed">
            Tim konsultan akademik kami siap membantu konsultasi penentuan program dan pemilihan jadwal belajar terbaik untuk Anda.
        </p>
    </div>
</div>

<div class="py-16 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
            <h3 class="text-xl font-bold text-slate-900">Saluran Komunikasi Resmi</h3>
            <div class="space-y-4 text-xs text-slate-600">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="font-bold text-slate-900">WhatsApp Konsultan</div>
                        <div>+62 812-3456-7890 (Setiap Hari 08.00 - 21.00 WIB)</div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="font-bold text-slate-900">Email Resmi</div>
                        <div>admin@atfalah.com</div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="font-bold text-slate-900">Kantor Layanan</div>
                        <div>Jakarta, Indonesia</div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <a href="https://wa.me/6281234567890" target="_blank" class="block w-full py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs text-center shadow transition-colors">
                    Chat WhatsApp Langsung &rarr;
                </a>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm space-y-4">
            <h3 class="text-xl font-bold text-slate-900">Kirim Pesan Konsultasi</h3>
            <form onsubmit="event.preventDefault(); alert('Terima kasih! Pesan Anda telah kami terima. Tim konsultan akan segera menghubungi Anda.');" class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama</label>
                    <input type="text" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs outline-none focus:border-primary-600">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">WhatsApp / Email</label>
                    <input type="text" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs outline-none focus:border-primary-600">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Pertanyaan / Kebutuhan</label>
                    <textarea rows="3" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs outline-none focus:border-primary-600"></textarea>
                </div>
                <button type="submit" class="w-full py-3 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow transition-colors">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection