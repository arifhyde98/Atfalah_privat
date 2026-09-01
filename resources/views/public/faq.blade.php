@extends('layouts.app')

@section('title', 'Tanya Jawab (FAQ) — ATFALAH PRIVATE')

@section('content')
<div class="bg-islamic-pattern text-white py-20 border-b-4 border-gold-500/80 relative">
    <div class="max-w-4xl mx-auto px-4 text-center space-y-3 relative z-10">
        <div class="text-gold-400 font-quran text-2xl mb-1">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-950/80 border border-gold-500/30 text-xs font-bold tracking-widest text-gold-400 uppercase">
            <span>۞</span> Tanya Jawab <span>۞</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight font-serif">Pertanyaan yang Sering Diajukan</h1>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-2xl mx-auto leading-relaxed">
            Temukan jawaban lengkap seputar sistem belajar privat, jadwal kelas, dan metode bimbingan di ATFALAH.
        </p>
    </div>
</div>

<div class="py-16 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 space-y-6" x-data="{ active: null }">
        @php
            $faqs = [
                ['q' => 'Apakah orang dewasa yang belum bisa membaca sama sekali bisa mendaftar?', 'a' => 'Sangat bisa. Program Reading Class kami didesain khusus untuk pemula mutlak (zero), termasuk orang dewasa yang belum mengenal huruf hijaiyah sama sekali dengan pendekatan yang privat, nyaman, dan tanpa rasa malu.'],
                ['q' => 'Bagaimana sistem jadwal belajar privat ditentukan?', 'a' => 'Jadwal ditentukan fleksibel berdasarkan kesepakatan antara student dan guru pengajar (pagi, sore, atau malam) melalui Google Meet / Zoom.'],
                ['q' => 'Berapa durasi setiap sesi pembelajaran?', 'a' => 'Setiap sesi belajar privat berlangsung selama 60 menit secara intensif 1-on-1 antara student dan ustadz/ustadzah.'],
                ['q' => 'Bagaimana saya bisa memantau perkembangan belajar saya?', 'a' => 'Setiap student memiliki akses ke dashboard khusus di mana Anda dapat melihat grafik progres, evaluasi makhraj huruf mingguan, catatan feedback ustadz, dan materi e-book.'],
                ['q' => 'Apakah santri perempuan diajar oleh ustadzah?', 'a' => 'Ya, kami menjaga adab syar\'i. Santri akhwat (perempuan) dibimbing oleh ustadzah, dan santri ikhwan dibimbing oleh ustadz.'],
            ];
        @endphp

        @foreach($faqs as $idx => $faq)
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                <button @click="active = (active === {{ $idx }} ? null : {{ $idx }})" class="w-full p-6 text-left flex items-center justify-between font-bold text-slate-900 text-sm hover:bg-slate-50 transition-colors">
                    <span>{{ $faq['q'] }}</span>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform" :class="active === {{ $idx }} ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="active === {{ $idx }}" x-collapse class="px-6 pb-6 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-4 bg-slate-50/50">
                    {{ $faq['a'] }}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection