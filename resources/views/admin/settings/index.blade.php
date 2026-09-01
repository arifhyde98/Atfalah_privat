@extends('layouts.dashboard')

@section('page_title', 'CMS Pengaturan Landing Page')
@section('page_subtitle', 'Sesuaikan teks headline, deskripsi hero, nomor WhatsApp, dan kutipan pada website utama.')

@section('content')
<div class="max-w-4xl bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-8">
    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Hero Section Settings -->
        <div class="space-y-4">
            <h3 class="text-sm font-bold uppercase tracking-wider text-primary-800 border-b border-slate-100 pb-2">
                1. Hero & Headline Utama
            </h3>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Badge Tagline Hero</label>
                <input type="text" name="hero_badge" value="{{ old('hero_badge', $settings['hero_badge']) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Headline Baris 1</label>
                    <input type="text" name="hero_title_1" value="{{ old('hero_title_1', $settings['hero_title_1']) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Headline Baris 2 (Gradien)</label>
                    <input type="text" name="hero_title_2" value="{{ old('hero_title_2', $settings['hero_title_2']) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Paragraf Hero</label>
                <textarea name="hero_description" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">{{ old('hero_description', $settings['hero_description']) }}</textarea>
            </div>
        </div>

        <!-- Notification & Top Bar -->
        <div class="space-y-4 pt-4 border-t border-slate-100">
            <h3 class="text-sm font-bold uppercase tracking-wider text-primary-800 border-b border-slate-100 pb-2">
                2. Top Notice & Kontak Admin
            </h3>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Teks Pengumuman Top Bar</label>
                <input type="text" name="notice_text" value="{{ old('notice_text', $settings['notice_text']) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor WhatsApp Konsultan (Format: 628xxx)</label>
                    <input type="text" name="cta_whatsapp" value="{{ old('cta_whatsapp', $settings['cta_whatsapp']) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Email Konsultasi</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Lokasi / Alamat Kantor</label>
                <input type="text" name="contact_address" value="{{ old('contact_address', $settings['contact_address']) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>
        </div>

        <!-- Hadith Quote Showcase -->
        <div class="space-y-4 pt-4 border-t border-slate-100">
            <h3 class="text-sm font-bold uppercase tracking-wider text-primary-800 border-b border-slate-100 pb-2">
                3. Kutipan Hadits & Dalil
            </h3>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Teks Arab Hadits</label>
                <input type="text" name="quote_arabic" value="{{ old('quote_arabic', $settings['quote_arabic']) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm font-arabic focus:border-primary-600 outline-none text-right">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Terjemahan Hadits</label>
                <textarea name="quote_translation" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">{{ old('quote_translation', $settings['quote_translation']) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Sumber Riwayat Hadits</label>
                <input type="text" name="quote_source" value="{{ old('quote_source', $settings['quote_source']) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:border-primary-600 outline-none">
            </div>
        </div>

        <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('home') }}" target="_blank" class="px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold">
                Lihat Website Utama
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-rose-700 hover:bg-rose-800 text-white font-bold text-xs shadow transition-colors">
                Simpan Perubahan Landing Page
            </button>
        </div>
    </form>
</div>
@endsection
