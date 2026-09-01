<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\User;
use App\Models\SiteSetting;

class PublicController extends Controller
{
    public function home()
    {
        $programs = Program::where('status', 'active')->with('curriculumItems')->get();
        $teachers = User::where('role', 'teacher')->where('status', 'active')->with('teacherProfile')->get();
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
        ];
        return view('public.home', compact('programs', 'teachers', 'settings'));
    }

    public function programs()
    {
        $programs = Program::where('status', 'active')->with(['curriculumItems', 'materials'])->get();
        return view('public.programs', compact('programs'));
    }

    public function programDetail($slug)
    {
        $program = Program::where('slug', $slug)->with(['curriculumItems', 'materials'])->firstOrFail();
        $otherPrograms = Program::where('id', '!=', $program->id)->where('status', 'active')->take(3)->get();
        return view('public.program_detail', compact('program', 'otherPrograms'));
    }

    public function learningMethod()
    {
        return view('public.learning_method');
    }

    public function teachers()
    {
        $teachers = User::where('role', 'teacher')->where('status', 'active')->with('teacherProfile')->get();
        return view('public.teachers', compact('teachers'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function faq()
    {
        return view('public.faq');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function assessment()
    {
        $programs = Program::where('status', 'active')->get();
        return view('public.assessment', compact('programs'));
    }
}