<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CourseUnit;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerController extends Controller
{
    public function dashboard()
    {
        $lecturer = Auth::user()->lecturer;
        
        $coursesCount = $lecturer->courses()->count();
        $studentsCount = $lecturer->courses()->with('students')->get()->sum(function($course) {
            return $course->students->count();
        });
        $pendingGrading = 0; // Calculate based on assignments
        $consultationHours = 5; // Default or from settings
        
        $myCourses = $lecturer->courses()->withCount('students')->get();
        $todaySchedule = []; // Fetch from schedule table
        $recentSubmissions = []; // Fetch recent submissions needing grading
        
        return view('lecturer.dashboard', compact(
            'coursesCount', 'studentsCount', 'pendingGrading', 
            'consultationHours', 'myCourses', 'todaySchedule', 
            'recentSubmissions'
        ));
    }
    
    public function courses()
    {
        $courses = Auth::user()->lecturer->courses()->withCount(['students', 'assignments'])->get();
        return view('lecturer.courses', compact('courses'));
    }
    
    public function courseShow($id)
    {
        $course = CourseUnit::with(['students.user', 'assignments'])->findOrFail($id);
        
        // Verify lecturer owns this course
        if ($course->lecturer_id !== Auth::user()->lecturer->id) {
            abort(403);
        }
        
        return view('lecturer.course-show', compact('course'));
    }
    
    public function courseStudents($id)
    {
        $course = CourseUnit::with('students.user')->findOrFail($id);
        return view('lecturer.course-students', compact('course'));
    }
    
    public function studentShow($id)
    {
        $student = User::findOrFail($id)->student;
        return view('lecturer.student-show', compact('student'));
    }
    
    public function schedule()
    {
        $lecturer = Auth::user()->lecturer;
        $schedule = []; // Fetch from schedule table
        return view('lecturer.schedule', compact('schedule'));
    }
}