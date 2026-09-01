<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Schedule;
use App\Models\Material;
use App\Models\Attendance;
use App\Models\Assessment;
use App\Models\ProgressRecord;
use App\Models\TeacherFeedback;
use App\Models\Payment;
use App\Models\User;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $activeEnrollment = Enrollment::where('student_id', $user->id)
            ->where('status', 'active')
            ->with(['program.curriculumItems', 'program.materials'])
            ->latest()
            ->first();

        $studentClasses = $user->studentClasses()->with(['teacher.teacherProfile', 'program'])->get();
        $classIds = $studentClasses->pluck('id');

        $nextSchedule = Schedule::whereIn('class_id', $classIds)
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('start_time')
            ->with(['classModel.program', 'teacher'])
            ->first();

        $totalAttendances = Attendance::where('student_id', $user->id)->count();
        $presentAttendances = Attendance::where('student_id', $user->id)->where('status', 'present')->count();
        $attendanceRate = $totalAttendances > 0 ? round(($presentAttendances / $totalAttendances) * 100) : 100;

        $latestAssessment = Assessment::where('student_id', $user->id)->latest('assessment_date')->first();
        $latestFeedback = TeacherFeedback::where('student_id', $user->id)->with('teacher')->latest()->first();
        $progressRecords = ProgressRecord::where('student_id', $user->id)->get();

        return view('student.dashboard', compact(
            'user',
            'activeEnrollment',
            'studentClasses',
            'nextSchedule',
            'attendanceRate',
            'latestAssessment',
            'latestFeedback',
            'progressRecords'
        ));
    }

    public function myPrograms()
    {
        $user = Auth::user();
        $enrollments = Enrollment::where('student_id', $user->id)
            ->with(['program.curriculumItems', 'program.materials'])
            ->latest()
            ->get();

        return view('student.programs', compact('enrollments'));
    }

    public function mySchedule()
    {
        $user = Auth::user();
        $classIds = $user->studentClasses()->pluck('classes.id');

        $schedules = Schedule::whereIn('class_id', $classIds)
            ->with(['classModel.program', 'teacher.teacherProfile', 'attendances' => function($q) use ($user) {
                $q->where('student_id', $user->id);
            }])
            ->orderBy('date', 'desc')
            ->paginate(15);

        return view('student.schedule', compact('schedules'));
    }

    public function materials()
    {
        $user = Auth::user();
        $programIds = Enrollment::where('student_id', $user->id)->pluck('program_id');
        $materials = Material::whereIn('program_id', $programIds)
            ->where('status', 'published')
            ->with(['program', 'curriculumItem'])
            ->latest()
            ->paginate(12);

        return view('student.materials', compact('materials'));
    }

    public function attendances()
    {
        $user = Auth::user();
        $attendances = Attendance::where('student_id', $user->id)
            ->with(['schedule.classModel.program', 'schedule.teacher'])
            ->latest()
            ->paginate(15);

        return view('student.attendances', compact('attendances'));
    }

    public function progress()
    {
        $user = Auth::user();
        $assessments = Assessment::where('student_id', $user->id)
            ->with(['teacher', 'items', 'enrollment.program'])
            ->latest('assessment_date')
            ->get();

        $progressRecords = ProgressRecord::where('student_id', $user->id)->get();
        $feedbacks = TeacherFeedback::where('student_id', $user->id)->with('teacher')->latest()->get();

        return view('student.progress', compact('assessments', 'progressRecords', 'feedbacks'));
    }

    public function payments()
    {
        $user = Auth::user();
        $payments = Payment::where('student_id', $user->id)
            ->with('enrollment.program')
            ->latest()
            ->paginate(10);

        return view('student.payments', compact('payments'));
    }

    public function profile()
    {
        $user = Auth::user();
        $profile = $user->studentProfile;
        return view('student.profile', compact('user', 'profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:30',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'address' => 'nullable|string',
        ]);

        $user->update(['name' => $validated['name']]);
        $user->studentProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $validated['phone'],
                'date_of_birth' => $validated['date_of_birth'],
                'gender' => $validated['gender'],
                'address' => $validated['address'],
            ]
        );

        return back()->with('success', 'Profil Anda berhasil diperbarui.');
    }
}