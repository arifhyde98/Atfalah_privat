<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\ClassModel;
use App\Models\Attendance;
use App\Models\Assessment;
use App\Models\AssessmentItem;
use App\Models\ProgressRecord;
use App\Models\TeacherFeedback;
use App\Models\User;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $todaySchedules = Schedule::where('teacher_id', $user->id)
            ->whereDate('date', now()->toDateString())
            ->with(['classModel.program', 'classModel.students'])
            ->get();

        $upcomingSchedules = Schedule::where('teacher_id', $user->id)
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('start_time')
            ->with(['classModel.program', 'classModel.students'])
            ->take(5)
            ->get();

        $assignedClasses = ClassModel::where('teacher_id', $user->id)
            ->where('status', 'active')
            ->withCount('students')
            ->with('program')
            ->get();

        $recentFeedbacks = TeacherFeedback::where('teacher_id', $user->id)
            ->with('student')
            ->latest()
            ->take(5)
            ->get();

        return view('teacher.dashboard', compact('todaySchedules', 'upcomingSchedules', 'assignedClasses', 'recentFeedbacks'));
    }

    public function classes()
    {
        $user = Auth::user();
        $classes = ClassModel::where('teacher_id', $user->id)
            ->with(['program', 'students.studentProfile', 'schedules'])
            ->paginate(10);
        return view('teacher.classes', compact('classes'));
    }

    public function schedules()
    {
        $user = Auth::user();
        $schedules = Schedule::where('teacher_id', $user->id)
            ->with(['classModel.program', 'classModel.students', 'attendances'])
            ->orderBy('date', 'desc')
            ->paginate(15);
        return view('teacher.schedules', compact('schedules'));
    }

    public function attendanceForm($scheduleId)
    {
        $user = Auth::user();
        $schedule = Schedule::where('teacher_id', $user->id)
            ->with(['classModel.students.studentProfile', 'attendances'])
            ->findOrFail($scheduleId);

        return view('teacher.attendance', compact('schedule'));
    }

    public function saveAttendance(Request $request, $scheduleId)
    {
        $user = Auth::user();
        $schedule = Schedule::where('teacher_id', $user->id)->findOrFail($scheduleId);

        $attendances = $request->input('attendances', []);
        foreach ($attendances as $studentId => $data) {
            Attendance::updateOrCreate(
                ['schedule_id' => $schedule->id, 'student_id' => $studentId],
                [
                    'status' => $data['status'] ?? 'present',
                    'notes' => $data['notes'] ?? null,
                    'recorded_by' => $user->id,
                ]
            );
        }

        // Auto mark schedule completed if saved
        if ($schedule->status === 'scheduled') {
            $schedule->update(['status' => 'completed']);
        }

        return redirect()->route('teacher.schedules')->with('success', 'Presensi kehadiran berhasil disimpan.');
    }

    public function assessments()
    {
        $user = Auth::user();
        $assessments = Assessment::where('teacher_id', $user->id)
            ->with(['student', 'enrollment.program', 'items'])
            ->latest()
            ->paginate(15);

        $classes = ClassModel::where('teacher_id', $user->id)->with('students')->get();
        $students = collect();
        foreach ($classes as $c) {
            $students = $students->merge($c->students);
        }
        $students = $students->unique('id');

        return view('teacher.assessments', compact('assessments', 'students'));
    }

    public function storeAssessment(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'type' => 'required|in:placement,progress,final',
            'assessment_date' => 'required|date',
            'score' => 'required|numeric|min:0|max:100',
            'level' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'recommendation' => 'nullable|string',
            'criteria' => 'nullable|array',
            'criteria_scores' => 'nullable|array',
        ]);

        $student = User::findOrFail($validated['student_id']);
        $enrollment = $student->enrollments()->latest()->first();

        $assessment = Assessment::create([
            'student_id' => $student->id,
            'teacher_id' => $user->id,
            'enrollment_id' => $enrollment ? $enrollment->id : null,
            'type' => $validated['type'],
            'assessment_date' => $validated['assessment_date'],
            'score' => $validated['score'],
            'level' => $validated['level'],
            'notes' => $validated['notes'],
            'recommendation' => $validated['recommendation'],
        ]);

        if (!empty($validated['criteria'])) {
            foreach ($validated['criteria'] as $idx => $criterion) {
                if (!empty($criterion)) {
                    AssessmentItem::create([
                        'assessment_id' => $assessment->id,
                        'criterion' => $criterion,
                        'score' => $validated['criteria_scores'][$idx] ?? null,
                    ]);
                }
            }
        }

        return back()->with('success', 'Assessment student berhasil disimpan.');
    }

    public function feedback()
    {
        $user = Auth::user();
        $feedbacks = TeacherFeedback::where('teacher_id', $user->id)
            ->with(['student', 'schedule.classModel'])
            ->latest()
            ->paginate(15);

        $classes = ClassModel::where('teacher_id', $user->id)->with('students')->get();
        $students = collect();
        foreach ($classes as $c) {
            $students = $students->merge($c->students);
        }
        $students = $students->unique('id');

        return view('teacher.feedback', compact('feedbacks', 'students'));
    }

    public function storeFeedback(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'schedule_id' => 'nullable|exists:schedules,id',
            'strengths' => 'nullable|string',
            'improvements' => 'nullable|string',
            'next_focus' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $validated['teacher_id'] = $user->id;
        TeacherFeedback::create($validated);

        return back()->with('success', 'Feedback untuk student berhasil dikirim.');
    }
}