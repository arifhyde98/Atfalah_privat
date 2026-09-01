<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\Payment;
use App\Models\SiteSetting;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_programs' => Program::count(),
            'active_classes' => ClassModel::where('status', 'active')->count(),
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
            'pending_enrollments' => Enrollment::where('status', 'pending')->count(),
        ];

        $recentEnrollments = Enrollment::with(['student', 'program'])->latest()->take(5)->get();
        $recentPayments = Payment::with('student')->latest()->take(5)->get();
        $upcomingSchedules = Schedule::with(['classModel.program', 'teacher'])->where('date', '>=', now()->toDateString())->orderBy('date')->orderBy('start_time')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentEnrollments', 'recentPayments', 'upcomingSchedules'));
    }

    // Students Management
    public function students()
    {
        $students = User::where('role', 'student')->with(['studentProfile', 'enrollments.program'])->latest()->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    public function createStudent()
    {
        return view('admin.students.create');
    }

    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:30',
            'gender' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'status' => $validated['status'],
            'email_verified_at' => now(),
        ]);

        StudentProfile::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'],
            'gender' => $validated['gender'],
            'date_of_birth' => $validated['date_of_birth'],
            'address' => $validated['address'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Data student berhasil ditambahkan.');
    }

    public function editStudent($id)
    {
        $student = User::where('role', 'student')->with('studentProfile')->findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        $student = User::where('role', 'student')->findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
            'phone' => 'nullable|string|max:30',
            'gender' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'status' => $validated['status'],
        ]);

        if (!empty($validated['password'])) {
            $student->update(['password' => Hash::make($validated['password'])]);
        }

        $student->studentProfile()->updateOrCreate(
            ['user_id' => $student->id],
            [
                'phone' => $validated['phone'],
                'gender' => $validated['gender'],
                'date_of_birth' => $validated['date_of_birth'],
                'address' => $validated['address'],
                'notes' => $validated['notes'],
            ]
        );

        return redirect()->route('admin.students.index')->with('success', 'Data student berhasil diperbarui.');
    }

    // Teachers Management
    public function teachers()
    {
        $teachers = User::where('role', 'teacher')->with(['teacherProfile', 'teacherClasses'])->latest()->paginate(15);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function createTeacher()
    {
        return view('admin.teachers.create');
    }

    public function storeTeacher(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:30',
            'specialization' => 'nullable|string',
            'bio' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'teacher',
            'status' => $validated['status'],
            'email_verified_at' => now(),
        ]);

        TeacherProfile::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'],
            'specialization' => $validated['specialization'],
            'bio' => $validated['bio'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Data teacher berhasil ditambahkan.');
    }

    public function editTeacher($id)
    {
        $teacher = User::where('role', 'teacher')->with('teacherProfile')->findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function updateTeacher(Request $request, $id)
    {
        $teacher = User::where('role', 'teacher')->findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
            'phone' => 'nullable|string|max:30',
            'specialization' => 'nullable|string',
            'bio' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $teacher->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'status' => $validated['status'],
        ]);

        if (!empty($validated['password'])) {
            $teacher->update(['password' => Hash::make($validated['password'])]);
        }

        $teacher->teacherProfile()->updateOrCreate(
            ['user_id' => $teacher->id],
            [
                'phone' => $validated['phone'],
                'specialization' => $validated['specialization'],
                'bio' => $validated['bio'],
                'status' => $validated['status'],
            ]
        );

        return redirect()->route('admin.teachers.index')->with('success', 'Data teacher berhasil diperbarui.');
    }

    // Programs & Curriculum
    public function programs()
    {
        $programs = Program::withCount(['curriculumItems', 'enrollments', 'classes'])->paginate(15);
        return view('admin.programs.index', compact('programs'));
    }

    public function createProgram()
    {
        return view('admin.programs.create');
    }

    public function storeProgram(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'learning_goal' => 'nullable|string',
            'target_audience' => 'nullable|string',
            'status' => 'required|in:draft,active,inactive',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        Program::create($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program baru berhasil dibuat.');
    }

    public function editProgram($id)
    {
        $program = Program::with('curriculumItems')->findOrFail($id);
        return view('admin.programs.edit', compact('program'));
    }

    public function updateProgram(Request $request, $id)
    {
        $program = Program::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'learning_goal' => 'nullable|string',
            'target_audience' => 'nullable|string',
            'status' => 'required|in:draft,active,inactive',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $program->update($validated);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil diperbarui.');
    }

    // Curriculums
    public function storeCurriculum(Request $request, $programId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'sequence' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['program_id'] = $programId;
        CurriculumItem::create($validated);

        return back()->with('success', 'Topik kurikulum berhasil ditambahkan.');
    }

    public function deleteCurriculum($id)
    {
        $item = CurriculumItem::findOrFail($id);
        $item->delete();
        return back()->with('success', 'Topik kurikulum berhasil dihapus.');
    }

    // Enrollments
    public function enrollments()
    {
        $enrollments = Enrollment::with(['student', 'program'])->latest()->paginate(15);
        $students = User::where('role', 'student')->where('status', 'active')->get();
        $programs = Program::where('status', 'active')->get();
        return view('admin.enrollments.index', compact('enrollments', 'students', 'programs'));
    }

    public function storeEnrollment(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'program_id' => 'required|exists:programs,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:pending,active,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        Enrollment::create($validated);
        return back()->with('success', 'Enrollment berhasil dibuat.');
    }

    public function updateEnrollmentStatus(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|in:pending,active,completed,cancelled',
        ]);
        $enrollment->update($validated);
        return back()->with('success', 'Status enrollment berhasil diupdate.');
    }

    // Classes
    public function classes()
    {
        $classes = ClassModel::with(['program', 'teacher', 'students'])->latest()->paginate(15);
        $programs = Program::where('status', 'active')->get();
        $teachers = User::where('role', 'teacher')->where('status', 'active')->get();
        $students = User::where('role', 'student')->where('status', 'active')->get();
        return view('admin.classes.index', compact('classes', 'programs', 'teachers', 'students'));
    }

    public function storeClass(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'teacher_id' => 'required|exists:users,id',
            'name' => 'required|string|max:150',
            'level' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
        ]);

        ClassModel::create($validated);
        return back()->with('success', 'Kelas baru berhasil dibuat.');
    }

    public function assignStudentToClass(Request $request, $classId)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);

        $enrollment = Enrollment::where('student_id', $validated['student_id'])->latest()->first();

        ClassStudent::updateOrCreate(
            ['class_id' => $classId, 'student_id' => $validated['student_id']],
            ['enrollment_id' => $enrollment ? $enrollment->id : null, 'status' => 'active']
        );

        return back()->with('success', 'Student berhasil dimasukkan ke kelas.');
    }

    // Schedules
    public function schedules()
    {
        $schedules = Schedule::with(['classModel.program', 'teacher'])->latest('date')->paginate(15);
        $classes = ClassModel::where('status', 'active')->with('teacher')->get();
        return view('admin.schedules.index', compact('schedules', 'classes'));
    }

    public function storeSchedule(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'meeting_url' => 'nullable|url|max:500',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $class = ClassModel::findOrFail($validated['class_id']);
        $validated['teacher_id'] = $class->teacher_id;

        Schedule::create($validated);
        return back()->with('success', 'Jadwal sesi berhasil ditambahkan.');
    }

    // Payments
    public function payments()
    {
        $payments = Payment::with(['student', 'enrollment.program'])->latest()->paginate(15);
        $students = User::where('role', 'student')->where('status', 'active')->get();
        return view('admin.payments.index', compact('payments', 'students'));
    }

    public function storePayment(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,paid,overdue,cancelled',
            'payment_method' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $enrollment = Enrollment::where('student_id', $validated['student_id'])->latest()->first();
        $validated['enrollment_id'] = $enrollment ? $enrollment->id : null;
        $validated['invoice_number'] = 'INV-ATF-' . date('Y') . '-' . strtoupper(Str::random(6));
        if ($validated['status'] === 'paid') {
            $validated['paid_at'] = now();
        }

        Payment::create($validated);
        return back()->with('success', 'Invoice pembayaran berhasil diterbitkan.');
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $status = $request->input('status');
        $payment->status = $status;
        if ($status === 'paid' && !$payment->paid_at) {
            $payment->paid_at = now();
        }
        $payment->save();

        return back()->with('success', 'Status pembayaran berhasil diupdate.');
    }

    // CMS / Landing Page Settings
    public function settings()
    {
        $settings = [
            'hero_badge' => SiteSetting::get('hero_badge', 'Personal Qur\'an Learning Journey'),
            'hero_title_1' => SiteSetting::get('hero_title_1', 'Read. Improve.'),
            'hero_title_2' => SiteSetting::get('hero_title_2', 'Understand. Live.'),
            'hero_description' => SiteSetting::get('hero_description', 'Platform pembelajaran privat Al-Qur\'an dan Islamic Studies yang dipersonalisasi. Dari belum mengenal huruf hijaiyah, menyempurnakan tajwid, hingga memahami dan mengamalkan nilai ayat dalam kehidupan sehari-hari.'),
            'cta_whatsapp' => SiteSetting::get('cta_whatsapp', '6281234567890'),
            'notice_text' => SiteSetting::get('notice_text', 'Program Pembelajaran Privat Al-Qur\'an & Islamic Studies Personal Berbasis Progress.'),
            'quote_arabic' => SiteSetting::get('quote_arabic', 'خَيْرُكُمْ مَنْ تَعَلَّمَ الْقُرْآنَ وَعَلَّمَهُ'),
            'quote_translation' => SiteSetting::get('quote_translation', 'Sebaik-baik kalian adalah orang yang belajar Al-Qur\'an dan mengajarkannya.'),
            'quote_source' => SiteSetting::get('quote_source', 'HR. Bukhari no. 5027'),
            'contact_email' => SiteSetting::get('contact_email', 'admin@atfalah.com'),
            'contact_address' => SiteSetting::get('contact_address', 'Jakarta, Indonesia'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $inputs = $request->except(['_token', '_method']);
        foreach ($inputs as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return back()->with('success', 'Pengaturan CMS Landing Page berhasil diperbarui.');
    }
}