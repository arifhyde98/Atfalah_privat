<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\Program;
use App\Models\CurriculumItem;
use App\Models\Enrollment;
use App\Models\ClassModel;
use App\Models\ClassStudent;
use App\Models\Schedule;
use App\Models\Material;
use App\Models\Attendance;
use App\Models\Assessment;
use App\Models\AssessmentItem;
use App\Models\ProgressRecord;
use App\Models\TeacherFeedback;
use App\Models\Payment;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        $admin = User::create([
            'name' => 'Admin ATFALAH',
            'email' => 'admin@atfalah.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // 2. Create Teachers
        $teacher1 = User::create([
            'name' => 'Ustadz Ahmad Al-Hafizh',
            'email' => 'ustadz.ahmad@atfalah.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        TeacherProfile::create([
            'user_id' => $teacher1->id,
            'phone' => '+6281234567890',
            'specialization' => 'Tahsin & Tajwid, Qira\'ah Sab\'ah, Qur\'an Reading',
            'bio' => 'Lulusan Lembaga Tahfidz & Qiraat dengan sanad bacaan riwayat Hafsh \'an \'Ashim. Berpengalaman lebih dari 8 tahun membimbing ribuan pembelajar Al-Qur\'an dari tingkat dasar hingga mahir.',
            'status' => 'active',
        ]);

        $teacher2 = User::create([
            'name' => 'Ustadzah Fatimah Azzahra, Lc.',
            'email' => 'ustadzah.fatimah@atfalah.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        TeacherProfile::create([
            'user_id' => $teacher2->id,
            'phone' => '+6281234567891',
            'specialization' => 'Tahsin & Tadabbur, Islamic Studies (Fiqh & Akhlaq)',
            'bio' => 'Alumni Universitas Islam ternama bidang Dirasat Islamiyah dan Tafsir. Pengajar bersanad yang fokus pada pembinaan tadabbur Al-Qur\'an tematik dan penguatan pondasi fiqh ibadah keluarga.',
            'status' => 'active',
        ]);

        // 3. Create Students
        $student1 = User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'student@atfalah.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        StudentProfile::create([
            'user_id' => $student1->id,
            'phone' => '+6287712345678',
            'date_of_birth' => '1998-05-14',
            'gender' => 'male',
            'address' => 'Jl. Kebon Jeruk No. 45, Jakarta Barat',
            'notes' => 'Tujuan belajar: Memperbaiki makhraj huruf dan kelancaran membaca Al-Qur\'an untuk memimpin shalat keluarga.',
        ]);

        $student2 = User::create([
            'name' => 'Maryam Salsabila',
            'email' => 'maryam@atfalah.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        StudentProfile::create([
            'user_id' => $student2->id,
            'phone' => '+6287798765432',
            'date_of_birth' => '2001-11-20',
            'gender' => 'female',
            'address' => 'Jl. Boulevard Raya Blok A3, Tangerang Selatan',
            'notes' => 'Tujuan belajar: Mulai dari nol mengenal huruf hijaiyah bersambung dan tanda baca.',
        ]);

        // 4. Create 4 Main Programs from PRD
        $progReading = Program::create([
            'name' => 'Reading Class',
            'slug' => 'reading-class',
            'tagline' => 'From Zero to Qur\'an Reading',
            'description' => 'Program terstruktur untuk pemula yang baru mulai belajar membaca Al-Qur\'an, termasuk yang belum mengenal huruf hijaiyah sama sekali. Dibimbing secara privat dengan penuh kesabaran dan metode adaptif.',
            'learning_goal' => 'Dari belum bisa membaca sama sekali menjadi mampu membaca ayat-ayat Al-Qur\'an secara mandiri, mengenal bentuk huruf bersambung, harakat, sukun, dan tasydid.',
            'target_audience' => 'Complete beginners, orang dewasa yang belum pernah belajar mengaji, serta pembelajar yang ingin mengulang kembali dari pondasi awal.',
            'status' => 'active',
        ]);

        $progTahsin = Program::create([
            'name' => 'Tahsin & Tajwid',
            'slug' => 'tahsin-tajwid',
            'tagline' => 'From Reading to Correct Recitation',
            'description' => 'Program untuk pembelajar yang sudah bisa membaca Al-Qur\'an namun masih terbata-bata, sering ragu hukum tajwid, atau ingin menyempurnakan keindahan makhraj dan sifat huruf sesuai kaidah mutawatir.',
            'learning_goal' => 'Dari sekadar bisa membaca menjadi membaca dengan tepat, tartil, percaya diri, dan memahami aplikasi hukum tajwid (Nun Sukun, Mim Sukun, Ghunnah, Mad, Qalqalah).',
            'target_audience' => 'Basic & improving readers yang ingin memperbaiki ketepatan bacaan dan mendalami hukum tajwid secara praktis.',
            'status' => 'active',
        ]);

        $progTadabbur = Program::create([
            'name' => 'Tahsin & Tadabbur',
            'slug' => 'tahsin-tadabbur',
            'tagline' => 'Improve Your Recitation. Deepen Your Connection.',
            'description' => 'Menggabungkan keindahan perbaikan bacaan dengan pemahaman mendalam makna ayat dan tadabbur aplikatif. Menjadikan Al-Qur\'an bukan hanya sekadar dilafalkan, namun meresap ke dalam hati dan amalan hidup.',
            'learning_goal' => 'Membaca dengan benar sekaligus memahami kosakata kunci Al-Qur\'an, pesan utama surah, refleksi hikmah, dan implementasi nilai ayat dalam keseharian.',
            'target_audience' => 'Pembelajar Qur\'an yang ingin mendalami pesan firman Allah, memperkaya kosakata bahasa Qur\'an, dan mengaplikasikannya dalam kehidupan.',
            'status' => 'active',
        ]);

        $progIslamic = Program::create([
            'name' => 'Islamic Studies',
            'slug' => 'islamic-studies',
            'tagline' => 'Learn the Basics. Practice Your Faith.',
            'description' => 'Program pembelajaran komprehensif dasar-dasar fardhu \'ain yang esensial dalam kehidupan seorang muslim: Fiqh Ibadah harian, penguatan Aqidah Islamiyah, serta pembentukan Akhlaq dan Adab Islami.',
            'learning_goal' => 'Memahami rukun Islam & Iman secara benar, tata cara thaharah dan shalat sesuai sunnah, adab harian, serta menjalani ibadah dengan penuh keyakinan dan ilmu.',
            'target_audience' => 'Muslim yang ingin membenahi dan memperkuat pemahaman dasar agama (fardhu \'ain), mualaf, maupun keluarga muslim.',
            'status' => 'active',
        ]);

        // 5. Curriculum Items for Programs
        $curriculums = [
            $progReading->id => [
                'Pengenalan Huruf Hijaiyah Tunggal (Alif - Ya)',
                'Makharij Huruf Dasar & Perubahan Bentuk Huruf',
                'Huruf Hijaiyah Bersambung di Awal, Tengah, dan Akhir',
                'Harakat Dasar: Fathah, Kasrah, Dhommah',
                'Tanwin: Fathatain, Kasratain, Dhommatain',
                'Tanda Baca Sukun (Mati) & Latihan Kata Dua Huruf',
                'Tanda Baca Tasydid (Syaddah) & Huruf Bertasydid',
                'Membaca Kata Pendek & Kalimat Sederhana',
                'Latihan Membaca Potongan Ayat Juz \'Amma',
                'Evaluasi Mandiri Membaca Surah Pendek',
            ],
            $progTahsin->id => [
                'Pengantar Tahsin & Kaidah Makharijul Huruf (5 Tempat Keluar)',
                'Sifatul Huruf: Hams, Jahr, Syiddah, Rakhawah, Isti\'la',
                'Hukum Nun Sukun & Tanwin: Idzhar Halqi & Idgham Bighunnah',
                'Hukum Nun Sukun & Tanwin: Idgham Bilaghunnah, Iqlab, Ikhfa Haqiqi',
                'Hukum Mim Sukun: Ikhfa Syafawi, Idgham Mimi, Idzhar Syafawi',
                'Hukum Ghunnah & Tingkatan Dengung (Maratib al-Ghunnah)',
                'Hukum Qalqalah: Sughra, Kubra, dan Akbar',
                'Hukum Alif Lam: Syamsiyah dan Qamariyah',
                'Hukum Mad Thabi\'i & Mad Far\'i Bagian 1',
                'Hukum Mad Far\'i Bagian 2 & Waqaf / Ibtida\' dalam Praktik',
            ],
            $progTadabbur->id => [
                'Tahsin Surah Al-Fatihah & Makna Induk Al-Qur\'an (Ummul Kitab)',
                'Tafsir & Tadabbur Surah Al-Fatihah: Doa dan Petunjuk Jalan Lurus',
                'Kosakata Kunci Al-Qur\'an: Makna Rabb, Rahman, \'Ibad, Taqwa',
                'Tadabbur Surah Pendek Pilihan: Adh-Dhuha & Al-Insyirah (Harapan & Kelapangan)',
                'Tadabbur Surah Al-\'Ashr & At-Takatsur (Urgensi Waktu dan Bahaya Lalai)',
                'Tadabbur Surah Al-Ikhlas, Al-Falaq, An-Nas (Pondasi Tauhid & Perlindungan)',
                'Kaidah Refleksi Diri: Menjadikan Ayat sebagai Cermin Kehidupan',
                'Action Plan Tadabbur: Merancang Jurnal Harian Amalan Berbasis Ayat',
            ],
            $progIslamic->id => [
                'Dasar Aqidah: Rukun Iman, Mengenal Allah (Asmaul Husna) & Tauhid',
                'Kerasulan Nabi Muhammad ﷺ & Cinta Kepada Sunnah',
                'Fiqh Thaharah: Wudhu Sempurna, Tayammum, dan Mandi Wajib',
                'Fiqh Shalat: Syarat, Rukun, Bacaan Shalat, dan Pembatal Shalat',
                'Praktik Shalat Khusyu\' & Shalat-Shalat Sunnah Utama',
                'Fiqh Puasa Ramadhan & Zakat Fitrah / Maal',
                'Akhlaq & Adab: Adab kepada Allah, Rasulullah ﷺ, Orang Tua, dan Guru',
                'Adab Muamalah Harian & Akhlaq Mulia dalam Kehidupan Sosial',
            ],
        ];

        foreach ($curriculums as $programId => $items) {
            foreach ($items as $index => $title) {
                CurriculumItem::create([
                    'program_id' => $programId,
                    'title' => $title,
                    'description' => "Modul pembelajaran mendalam mengenai $title disertai contoh audio visual dan latihan praktik langsung.",
                    'sequence' => $index + 1,
                    'status' => 'active',
                ]);
            }
        }

        // 6. Enrollments
        $enrollment1 = Enrollment::create([
            'student_id' => $student1->id,
            'program_id' => $progTahsin->id,
            'start_date' => Carbon::now()->subMonths(1)->toDateString(),
            'end_date' => Carbon::now()->addMonths(2)->toDateString(),
            'status' => 'active',
            'notes' => 'Target: Menyelesaikan materi tajwid dasar dan lancar membaca Juz 30.',
        ]);

        $enrollment2 = Enrollment::create([
            'student_id' => $student2->id,
            'program_id' => $progReading->id,
            'start_date' => Carbon::now()->subWeeks(2)->toDateString(),
            'end_date' => Carbon::now()->addMonths(3)->toDateString(),
            'status' => 'active',
            'notes' => 'Target: Mengenal huruf hijaiyah bersambung dan tanda baca fathah/kasrah/dhommah.',
        ]);

        // 7. Classes
        $class1 = ClassModel::create([
            'program_id' => $progTahsin->id,
            'teacher_id' => $teacher1->id,
            'name' => 'Tahsin & Tajwid Eksekutif Malam A',
            'level' => 'Intermediate',
            'status' => 'active',
            'notes' => 'Kelas private intensif 2x seminggu via Google Meet / Zoom.',
        ]);

        $class2 = ClassModel::create([
            'program_id' => $progReading->id,
            'teacher_id' => $teacher2->id,
            'name' => 'Qur\'an Beginner Foundation B',
            'level' => 'Beginner (Zero)',
            'status' => 'active',
            'notes' => 'Kelas private dasar membaca Al-Qur\'an dari nol.',
        ]);

        // 8. Class Students
        ClassStudent::create([
            'class_id' => $class1->id,
            'student_id' => $student1->id,
            'enrollment_id' => $enrollment1->id,
            'status' => 'active',
        ]);

        ClassStudent::create([
            'class_id' => $class2->id,
            'student_id' => $student2->id,
            'enrollment_id' => $enrollment2->id,
            'status' => 'active',
        ]);

        // 9. Schedules
        // Past schedules
        $sch1 = Schedule::create([
            'class_id' => $class1->id,
            'teacher_id' => $teacher1->id,
            'date' => Carbon::now()->subDays(4)->toDateString(),
            'start_time' => '19:30:00',
            'end_time' => '20:30:00',
            'meeting_url' => 'https://meet.google.com/atf-tahs-xyz',
            'status' => 'completed',
            'notes' => 'Sesi 1: Evaluasi makharijul huruf halqiyyah dan lisan.',
        ]);

        $sch2 = Schedule::create([
            'class_id' => $class1->id,
            'teacher_id' => $teacher1->id,
            'date' => Carbon::now()->subDays(2)->toDateString(),
            'start_time' => '19:30:00',
            'end_time' => '20:30:00',
            'meeting_url' => 'https://meet.google.com/atf-tahs-xyz',
            'status' => 'completed',
            'notes' => 'Sesi 2: Praktik hukum Nun Sukun & Tanwin (Idzhar dan Idgham).',
        ]);

        // Upcoming schedule
        $sch3 = Schedule::create([
            'class_id' => $class1->id,
            'teacher_id' => $teacher1->id,
            'date' => Carbon::now()->addDays(2)->toDateString(),
            'start_time' => '19:30:00',
            'end_time' => '20:30:00',
            'meeting_url' => 'https://meet.google.com/atf-tahs-xyz',
            'status' => 'scheduled',
            'notes' => 'Sesi 3: Hukum Ikhfa Haqiqi & Iqlab pada surah An-Naba\'.',
        ]);

        $sch4 = Schedule::create([
            'class_id' => $class2->id,
            'teacher_id' => $teacher2->id,
            'date' => Carbon::now()->addDays(1)->toDateString(),
            'start_time' => '16:00:00',
            'end_time' => '17:00:00',
            'meeting_url' => 'https://meet.google.com/atf-read-abc',
            'status' => 'scheduled',
            'notes' => 'Sesi 2: Pengenalan tanda baca kasrah dan dhommah.',
        ]);

        // 10. Attendances
        Attendance::create([
            'schedule_id' => $sch1->id,
            'student_id' => $student1->id,
            'status' => 'present',
            'notes' => 'Tepat waktu, mengikuti sesi dengan sangat antusias.',
            'recorded_by' => $teacher1->id,
        ]);

        Attendance::create([
            'schedule_id' => $sch2->id,
            'student_id' => $student1->id,
            'status' => 'present',
            'notes' => 'Hadir penuh, berhasil mempraktikkan Idzhar dan Idgham dengan baik.',
            'recorded_by' => $teacher1->id,
        ]);

        // 11. Assessments
        $assessment1 = Assessment::create([
            'student_id' => $student1->id,
            'teacher_id' => $teacher1->id,
            'enrollment_id' => $enrollment1->id,
            'type' => 'progress',
            'assessment_date' => Carbon::now()->subDays(2)->toDateString(),
            'score' => 84.50,
            'level' => 'Intermediate (Developing)',
            'notes' => 'Perkembangan signifikan pada ketepatan makhraj huruf tenggorokan (Halq). Tinggal memperhalus durasi ghunnah.',
            'recommendation' => 'Lanjutkan ke bab Ikhfa Haqiqi dan tingkatkan durasi tilawah mandiri 15 menit setiap setelah shubuh.',
        ]);

        AssessmentItem::create([
            'assessment_id' => $assessment1->id,
            'criterion' => 'Makharijul Huruf',
            'score' => 85.00,
            'note' => 'Pelafalan \'Ain, Ha, dan Kha sudah jauh lebih bersih.',
        ]);
        AssessmentItem::create([
            'assessment_id' => $assessment1->id,
            'criterion' => 'Sifatul Huruf',
            'score' => 80.00,
            'note' => 'Karakter Hams dan Isti\'la sudah mulai konsisten.',
        ]);
        AssessmentItem::create([
            'assessment_id' => $assessment1->id,
            'criterion' => 'Penerapan Tajwid (Nun Sukun)',
            'score' => 88.00,
            'note' => 'Idzhar dan Idgham Bighunnah sangat baik.',
        ]);
        AssessmentItem::create([
            'assessment_id' => $assessment1->id,
            'criterion' => 'Kelancaran & Ketukan Mad',
            'score' => 82.00,
            'note' => 'Panjang 2 harakat stabil, hindari terburu-buru.',
        ]);
        AssessmentItem::create([
            'assessment_id' => $assessment1->id,
            'criterion' => 'Kepercayaan Diri (Confidence)',
            'score' => 90.00,
            'note' => 'Sangat percaya diri dan artikulatif.',
        ]);

        // 12. Progress Records (for visual charts)
        ProgressRecord::create([
            'student_id' => $student1->id,
            'enrollment_id' => $enrollment1->id,
            'assessment_id' => $assessment1->id,
            'learning_area' => 'Makharijul Huruf',
            'level' => 'good',
            'score' => 85.00,
            'notes' => 'Ketepatan makhraj meningkat dari 65% ke 85%.',
        ]);
        ProgressRecord::create([
            'student_id' => $student1->id,
            'enrollment_id' => $enrollment1->id,
            'assessment_id' => $assessment1->id,
            'learning_area' => 'Hukum Tajwid',
            'level' => 'good',
            'score' => 88.00,
            'notes' => 'Memahami kaidah hukum Nun Sukun & Tanwin dengan sangat baik.',
        ]);
        ProgressRecord::create([
            'student_id' => $student1->id,
            'enrollment_id' => $enrollment1->id,
            'assessment_id' => $assessment1->id,
            'learning_area' => 'Kelancaran (Fluency)',
            'level' => 'developing',
            'score' => 78.00,
            'notes' => 'Masih butuh latihan ritme pembacaan tartil.',
        ]);
        ProgressRecord::create([
            'student_id' => $student1->id,
            'enrollment_id' => $enrollment1->id,
            'assessment_id' => $assessment1->id,
            'learning_area' => 'Waqaf & Ibtida\'',
            'level' => 'developing',
            'score' => 75.00,
            'notes' => 'Perhatikan tanda waqaf lazim dan jaiz.',
        ]);
        ProgressRecord::create([
            'student_id' => $student1->id,
            'enrollment_id' => $enrollment1->id,
            'assessment_id' => $assessment1->id,
            'learning_area' => 'Adab & Kepercayaan Diri',
            'level' => 'excellent',
            'score' => 95.00,
            'notes' => 'Adab belajar dan motivasi sangat istiqomah.',
        ]);

        // 13. Teacher Feedback
        TeacherFeedback::create([
            'student_id' => $student1->id,
            'teacher_id' => $teacher1->id,
            'schedule_id' => $sch2->id,
            'strengths' => 'Makhraj huruf tenggorokan sudah sangat fasih dan tidak tertukar lagi antara Ha (tenggorokan bawah) dan Haa (tenggorokan tengah).',
            'improvements' => 'Perhatikan durasi dengung pada Idgham Bighunnah, tahan sekitar 2 harakat sempurna.',
            'next_focus' => 'Persiapan materi Ikhfa Haqiqi dan latihan membaca Surah An-Naba\' ayat 1-20.',
            'note' => 'Alhamdulillah, progres belajar Mas Ahmad sangat memuaskan. Tetap pertahankan tilawah hariannya.',
        ]);

        // 14. Materials
        $firstCurriculum = CurriculumItem::where('program_id', $progTahsin->id)->first();
        Material::create([
            'program_id' => $progTahsin->id,
            'curriculum_item_id' => $firstCurriculum ? $firstCurriculum->id : null,
            'title' => 'Panduan Visual Makharijul Huruf & Titik Artikulasi',
            'description' => 'E-Book PDF resmi penjelasan 5 tempat keluar huruf disertai ilustrasi anatomi rongga mulut dan tenggorokan.',
            'type' => 'link',
            'external_url' => 'https://drive.google.com/file/d/sample-makhraj-guide/view',
            'status' => 'published',
        ]);

        Material::create([
            'program_id' => $progTahsin->id,
            'curriculum_item_id' => $firstCurriculum ? $firstCurriculum->id : null,
            'title' => 'Audio Contoh Bacaan Tartil: Surah Al-Fatihah & Juz 30',
            'description' => 'Rekaman panduan makhraj dan sifat huruf oleh para Qari bersanad.',
            'type' => 'link',
            'external_url' => 'https://soundcloud.com/sample-quran-audio',
            'status' => 'published',
        ]);

        Material::create([
            'program_id' => $progReading->id,
            'curriculum_item_id' => null,
            'title' => 'Buku Saku Belajar Huruf Hijaiyah Mandiri',
            'description' => 'Modul latihan menulis dan menyambung huruf hijaiyah untuk pemula.',
            'type' => 'link',
            'external_url' => 'https://drive.google.com/file/d/sample-hijaiyah-basics/view',
            'status' => 'published',
        ]);

        // 15. Payments
        Payment::create([
            'student_id' => $student1->id,
            'enrollment_id' => $enrollment1->id,
            'invoice_number' => 'INV-ATF-2026-0001',
            'amount' => 750000.00,
            'due_date' => Carbon::now()->subWeeks(3)->toDateString(),
            'paid_at' => Carbon::now()->subWeeks(3)->addHours(2),
            'status' => 'paid',
            'payment_method' => 'Bank Transfer (BSI)',
            'notes' => 'Paket Private Tahsin & Tajwid Intensif (8 Sesi + Modul + Assessment).',
        ]);

        Payment::create([
            'student_id' => $student2->id,
            'enrollment_id' => $enrollment2->id,
            'invoice_number' => 'INV-ATF-2026-0002',
            'amount' => 650000.00,
            'due_date' => Carbon::now()->addDays(5)->toDateString(),
            'paid_at' => null,
            'status' => 'pending',
            'payment_method' => 'Bank Transfer (BSI / Mandiri)',
            'notes' => 'Paket Private Reading Class Foundation (8 Sesi).',
        ]);
    }
}
