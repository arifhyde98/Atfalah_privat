@extends('layouts.app')

@section('title', 'Tentang Kami — ATFALAH PRIVATE')

@section('content')
<div class="bg-primary-900 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 text-center space-y-3">
        <span class="text-xs font-bold tracking-widest text-gold-400 uppercase">Visi & Misi</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Tentang ATFALAH PRIVATE</h1>
        <p class="text-xs sm:text-sm text-primary-100 max-w-2xl mx-auto leading-relaxed">
            Membangun generasi pembelajar Al-Qur'an yang mencintai firman Allah melalui pendekatan personal dan berkesinambungan.
        </p>
    </div>
</div>

<div class="py-16 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 space-y-12">
        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-sm space-y-6">
            <h2 class="text-2xl font-bold text-slate-900">Visi Kami</h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Menjadi platform pembelajaran Qur'an dan Islamic Studies terdepan yang membantu setiap student belajar sesuai kemampuan, memperbaiki bacaan secara mutawatir, memahami pesan Al-Qur'an, dan menerapkan nilai-nilainya dalam kehidupan nyata.
            </p>
        </div>

        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-sm space-y-6">
            <h2 class="text-2xl font-bold text-slate-900">Misi ATFALAH</h2>
            <ul class="space-y-3 text-xs sm:text-sm text-slate-600">
                <li class="flex items-start gap-3"><i data-lucide="check" class="w-5 h-5 text-primary-600 flex-shrink-0"></i> Menyediakan pembelajaran Al-Qur'an yang personal, adaptif, dan bertahap.</li>
                <li class="flex items-start gap-3"><i data-lucide="check" class="w-5 h-5 text-primary-600 flex-shrink-0"></i> Membantu pemula memulai dari nol tanpa merasa tertinggal atau canggung.</li>
                <li class="flex items-start gap-3"><i data-lucide="check" class="w-5 h-5 text-primary-600 flex-shrink-0"></i> Meningkatkan kualitas bacaan melalui kaidah tahsin dan tajwid bersanad.</li>
                <li class="flex items-start gap-3"><i data-lucide="check" class="w-5 h-5 text-primary-600 flex-shrink-0"></i> Menghubungkan kemampuan membaca dengan pemahaman dan tadabbur ayat.</li>
                <li class="flex items-start gap-3"><i data-lucide="check" class="w-5 h-5 text-primary-600 flex-shrink-0"></i> Membekali dasar-dasar Islamic Studies fardhu 'ain yang dibutuhkan sehari-hari.</li>
                <li class="flex items-start gap-3"><i data-lucide="check" class="w-5 h-5 text-primary-600 flex-shrink-0"></i> Membangun sistem monitoring perkembangan santri yang terukur dan terdokumentasi.</li>
            </ul>
        </div>
    </div>
</div>
@endsection