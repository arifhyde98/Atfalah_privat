@extends('layouts.app')

@section('title', 'Placement Assessment — ATFALAH PRIVATE')

@section('content')
<div class="bg-islamic-pattern text-white py-20 border-b-4 border-gold-500/80 relative">
    <div class="max-w-4xl mx-auto px-4 text-center space-y-3 relative z-10">
        <div class="text-gold-400 font-quran text-2xl mb-1">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-950/80 border border-gold-500/30 text-xs font-bold tracking-widest text-gold-400 uppercase">
            <span>۞</span> Ikhtibar & Placement <span>۞</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-serif">Evaluasi Mandiri & Rekomendasi Program</h1>
        <p class="text-xs sm:text-sm text-emerald-100 max-w-2xl mx-auto leading-relaxed">
            Jawab beberapa pertanyaan singkat di bawah ini untuk mendapatkan rekomendasi jenjang pembelajaran yang paling tepat bagi perjalanan Qur'an Anda.
        </p>
    </div>
</div>

<div class="py-12 bg-slate-50 min-h-screen" x-data="assessmentWizard()">
    <div class="max-w-3xl mx-auto px-4">
        
        <!-- Step 1: Form Questions -->
        <div x-show="step === 1" class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-10 shadow-sm space-y-8">
            <div class="border-b border-slate-100 pb-4">
                <h2 class="text-lg font-bold text-slate-900">1. Kemampuan Membaca Al-Qur'an Saat Ini</h2>
                <p class="text-xs text-slate-500 mt-0.5">Pilih kondisi yang paling mendeskripsikan kemampuan Anda saat ini.</p>
                <div class="mt-4 space-y-2">
                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 hover:border-primary-600 hover:bg-primary-50/50 cursor-pointer transition-all">
                        <input type="radio" name="reading" value="zero" x-model="answers.reading" class="text-primary-600 focus:ring-primary-500">
                        <span class="text-xs font-medium text-slate-800">Sama sekali belum mengenal huruf hijaiyah / ingin belajar dari nol.</span>
                    </label>
                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 hover:border-primary-600 hover:bg-primary-50/50 cursor-pointer transition-all">
                        <input type="radio" name="reading" value="basic_letters" x-model="answers.reading" class="text-primary-600 focus:ring-primary-500">
                        <span class="text-xs font-medium text-slate-800">Mengenal sebagian huruf hijaiyah, namun masih kesulitan membaca huruf bersambung & harakat.</span>
                    </label>
                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 hover:border-primary-600 hover:bg-primary-50/50 cursor-pointer transition-all">
                        <input type="radio" name="reading" value="fluent_slow" x-model="answers.reading" class="text-primary-600 focus:ring-primary-500">
                        <span class="text-xs font-medium text-slate-800">Sudah bisa membaca Al-Qur'an, namun masih terbata-bata & belum menguasai hukum tajwid.</span>
                    </label>
                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 hover:border-primary-600 hover:bg-primary-50/50 cursor-pointer transition-all">
                        <input type="radio" name="reading" value="fluent_tajwid" x-model="answers.reading" class="text-primary-600 focus:ring-primary-500">
                        <span class="text-xs font-medium text-slate-800">Sudah lancar membaca Al-Qur'an dan ingin mendalami tadabbur makna ayat & Islamic Studies.</span>
                    </label>
                </div>
            </div>

            <div class="border-b border-slate-100 pb-4">
                <h2 class="text-lg font-bold text-slate-900">2. Pemahaman Kaidah & Hukum Tajwid</h2>
                <p class="text-xs text-slate-500 mt-0.5">Tingkat penguasaan hukum bacaan (Nun Sukun, Mim Sukun, Ghunnah, Mad).</p>
                <div class="mt-4 space-y-2">
                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 hover:border-primary-600 hover:bg-primary-50/50 cursor-pointer transition-all">
                        <input type="radio" name="tajwid" value="none" x-model="answers.tajwid" class="text-primary-600 focus:ring-primary-500">
                        <span class="text-xs font-medium text-slate-800">Belum pernah mempelajari kaidah tajwid secara formal.</span>
                    </label>
                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 hover:border-primary-600 hover:bg-primary-50/50 cursor-pointer transition-all">
                        <input type="radio" name="tajwid" value="basic" x-model="answers.tajwid" class="text-primary-600 focus:ring-primary-500">
                        <span class="text-xs font-medium text-slate-800">Pernah belajar dasar (Idzhar/Idgham), namun sering lupa & ragu saat tilawah.</span>
                    </label>
                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 hover:border-primary-600 hover:bg-primary-50/50 cursor-pointer transition-all">
                        <input type="radio" name="tajwid" value="mastered" x-model="answers.tajwid" class="text-primary-600 focus:ring-primary-500">
                        <span class="text-xs font-medium text-slate-800">Sudah menguasai tajwid praktis dan ingin meningkatkan keindahan tartil & tafsir.</span>
                    </label>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-bold text-slate-900">3. Target Utama Belajar Anda</h2>
                <p class="text-xs text-slate-500 mt-0.5">Apa fokus capaian terpenting yang ingin Anda raih?</p>
                <div class="mt-4 space-y-2">
                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 hover:border-primary-600 hover:bg-primary-50/50 cursor-pointer transition-all">
                        <input type="radio" name="target" value="read_quran" x-model="answers.target" class="text-primary-600 focus:ring-primary-500">
                        <span class="text-xs font-medium text-slate-800">Bisa membaca Al-Qur'an secara mandiri dengan lancar.</span>
                    </label>
                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 hover:border-primary-600 hover:bg-primary-50/50 cursor-pointer transition-all">
                        <input type="radio" name="target" value="tahsin_perfection" x-model="answers.target" class="text-primary-600 focus:ring-primary-500">
                        <span class="text-xs font-medium text-slate-800">Menyempurnakan makhraj & tajwid agar fasih dan tartil.</span>
                    </label>
                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 hover:border-primary-600 hover:bg-primary-50/50 cursor-pointer transition-all">
                        <input type="radio" name="target" value="tadabbur_meaning" x-model="answers.target" class="text-primary-600 focus:ring-primary-500">
                        <span class="text-xs font-medium text-slate-800">Memahami makna ayat, vocabulary Qur'an, dan tadabbur aplikatif.</span>
                    </label>
                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200 hover:border-primary-600 hover:bg-primary-50/50 cursor-pointer transition-all">
                        <input type="radio" name="target" value="islamic_basics" x-model="answers.target" class="text-primary-600 focus:ring-primary-500">
                        <span class="text-xs font-medium text-slate-800">Memperdalam fardhu 'ain: Aqidah, Thaharah, Shalat, & Akhlaq Islami.</span>
                    </label>
                </div>
            </div>

            <div class="pt-4">
                <button type="button" @click="calculateResult()" class="w-full py-4 rounded-2xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-sm shadow-lg shadow-primary-700/25 transition-all flex items-center justify-center gap-2">
                    <span>Lihat Hasil Analisis & Rekomendasi Program</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

        <!-- Step 2: Result Recommendation Card -->
        <div x-show="step === 2" x-transition class="bg-white rounded-3xl border border-primary-200 p-8 sm:p-10 shadow-xl space-y-6 text-center">
            <div class="w-16 h-16 rounded-3xl bg-emerald-100 text-emerald-700 flex items-center justify-center mx-auto">
                <i data-lucide="check-circle" class="w-8 h-8"></i>
            </div>
            <div>
                <span class="text-xs font-bold tracking-wider text-emerald-700 uppercase bg-emerald-100 px-3 py-1 rounded-full">Rekomendasi Terbaik Untuk Anda</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-3" x-text="recommendation.title"></h2>
                <p class="text-xs font-semibold text-gold-600 mt-1" x-text="recommendation.tagline"></p>
            </div>

            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 text-left space-y-3">
                <div class="text-xs font-bold text-slate-800">Alasan & Analisis Rekomendasi:</div>
                <p class="text-xs text-slate-600 leading-relaxed" x-text="recommendation.reason"></p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-4">
                <a :href="'{{ url('/register') }}?program=' + recommendation.slug" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow transition-all">
                    Daftar Program Ini Sekarang &rarr;
                </a>
                <button type="button" @click="step = 1" class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition-colors">
                    Ulangi Evaluasi
                </button>
            </div>
        </div>

    </div>
</div>

<script>
function assessmentWizard() {
    return {
        step: 1,
        answers: {
            reading: 'basic_letters',
            tajwid: 'basic',
            target: 'tahsin_perfection',
        },
        recommendation: {
            title: 'Tahsin & Tajwid',
            tagline: 'From Reading to Correct Recitation',
            slug: 'tahsin-tajwid',
            reason: 'Berdasarkan input Anda, Anda sudah memiliki modal bacaan dasar namun butuh bimbingan intensif dalam ketepatan makharijul huruf dan hukum tajwid tartil.',
        },
        calculateResult() {
            if (this.answers.reading === 'zero' || this.answers.reading === 'basic_letters' || this.answers.target === 'read_quran') {
                this.recommendation = {
                    title: 'Reading Class',
                    tagline: 'From Zero to Qur\'an Reading',
                    slug: 'reading-class',
                    reason: 'Program ini sangat ideal untuk membangun pondasi pengenalan huruf hijaiyah tunggal, huruf bersambung, dan tanda baca dengan bimbingan privat yang sabar dan terstruktur.',
                };
            } else if (this.answers.target === 'tadabbur_meaning') {
                this.recommendation = {
                    title: 'Tahsin & Tadabbur',
                    tagline: 'Improve Your Recitation. Deepen Your Connection.',
                    slug: 'tahsin-tadabbur',
                    reason: 'Anda sudah memiliki kemampuan bacaan yang cukup dan siap untuk meningkatkan kualitas bacaan sekaligus menyelami makna kosakata serta tadabbur ayat Al-Qur\'an.',
                };
            } else if (this.answers.target === 'islamic_basics') {
                this.recommendation = {
                    title: 'Islamic Studies',
                    tagline: 'Learn the Basics. Practice Your Faith.',
                    slug: 'islamic-studies',
                    reason: 'Program ini memfokuskan penguatan pondasi fardhu \'ain: fiqh ibadah, aqidah shahihah, dan pembentukan akhlaq islami dalam kehidupan sehari-hari.',
                };
            } else {
                this.recommendation = {
                    title: 'Tahsin & Tajwid',
                    tagline: 'From Reading to Correct Recitation',
                    slug: 'tahsin-tajwid',
                    reason: 'Program ini dirancang khusus untuk membenahi ketepatan makhraj 5 tempat keluar huruf, sifatul huruf, dan hukum tajwid tartil agar tilawah Anda semakin percaya diri.',
                };
            }
            this.step = 2;
            setTimeout(() => {
                lucide.createIcons();
            }, 100);
        }
    }
}
</script>
@endsection