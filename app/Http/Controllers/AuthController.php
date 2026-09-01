<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\Program;
use App\Models\Enrollment;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectUser(Auth::user());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->status !== 'active') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda berstatus nonaktif. Silakan hubungi admin.']);
            }

            return $this->redirectUser($user);
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function showRegister(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectUser(Auth::user());
        }
        $programs = Program::where('status', 'active')->get();
        $selectedProgram = $request->query('program');
        return view('auth.register', compact('programs', 'selectedProgram'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:30',
            'gender' => 'nullable|in:male,female',
            'program_id' => 'nullable|exists:programs,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        StudentProfile::create([
            'user_id' => $user->id,
            'phone' => $validated['phone'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        if (!empty($validated['program_id'])) {
            Enrollment::create([
                'student_id' => $user->id,
                'program_id' => $validated['program_id'],
                'start_date' => now()->toDateString(),
                'status' => 'pending',
                'notes' => 'Pendaftaran mandiri via website public.',
            ]);
        }

        Auth::login($user);

        return redirect()->route('student.dashboard')->with('success', 'Alhamdulillah! Pendaftaran akun berhasil. Selamat datang di ATFALAH PRIVATE.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Anda telah berhasil keluar.');
    }

    private function redirectUser(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isTeacher()) {
            return redirect()->route('teacher.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
}