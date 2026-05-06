<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CourseUnit;
use App\Models\Grade;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::user()->student;
        
        $currentGpa = $student->grades()->avg('percentage') ?? 0;
        $completedCredits = $student->completed_credits ?? 0;
        $attendanceRate = $student->attendances()->avg('percentage') ?? 0;
        $feesBalance = $student->total_fees - $student->paid_fees ?? 0;
        
        $currentCourses = $student->courses()->where('semester', $student->current_semester)->get();
        $upcomingAssignments = $student->assignments()->where('due_date', '>', now())->orderBy('due_date')->limit(5)->get();
        $latestGrades = $student->grades()->with('assignment')->latest()->limit(5)->get();
        
        $paidFees = $student->payments()->sum('amount');
        $totalFees = $student->program->total_fees ?? 0;
        $paymentPercentage = $totalFees > 0 ? ($paidFees / $totalFees) * 100 : 0;
        
        return view('student.dashboard', compact(
            'currentGpa', 'completedCredits', 'attendanceRate', 'feesBalance',
            'currentCourses', 'upcomingAssignments', 'latestGrades',
            'paidFees', 'totalFees', 'paymentPercentage'
        ));
    }
    
    public function courses()
    {
        $courses = Auth::user()->student->courses()->with('lecturer.user')->get();
        return view('student.courses', compact('courses'));
    }
    
    public function courseShow($id)
    {
        $course = CourseUnit::with(['lecturer.user', 'assignments', 'materials'])->findOrFail($id);
        
        // Verify student is enrolled
        if (!Auth::user()->student->courses->contains($id)) {
            abort(403);
        }
        
        return view('student.course-show', compact('course'));
    }
    
    public function courseMaterials($id)
    {
        $course = CourseUnit::findOrFail($id);
        return view('student.course-materials', compact('course'));
    }
    
    public function assignments()
    {
        $assignments = Auth::user()->student->assignments()
            ->with('course')
            ->orderBy('due_date')
            ->get();
        return view('student.assignments', compact('assignments'));
    }
    
    public function assignmentShow($id)
    {
        $assignment = Assignment::with('course', 'submissions')->findOrFail($id);
        $submission = $assignment->submissions->where('student_id', Auth::user()->student->id)->first();
        return view('student.assignment-show', compact('assignment', 'submission'));
    }
    
    public function grades()
    {
        $grades = Auth::user()->student->grades()
            ->with('assignment.course')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('student.grades', compact('grades'));
    }
    
    public function transcript()
    {
        $student = Auth::user()->student;
        $grades = $student->grades()->with('assignment.course')->get();
        $totalCredits = $student->completed_credits;
        $gpa = $student->grades()->avg('percentage') ?? 0;
        
        return view('student.transcript', compact('student', 'grades', 'totalCredits', 'gpa'));
    }
    
    public function downloadTranscript()
    {
        // Generate PDF transcript
        // Use Barryvdh\DomPDF or similar package
    }
    
    public function attendance()
    {
        $attendance = Auth::user()->student->attendances()
            ->with('course')
            ->orderBy('date', 'desc')
            ->get();
        return view('student.attendance', compact('attendance'));
    }
    
    public function schedule()
    {
        $schedule = Auth::user()->student->schedule()
            ->with('course')
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();
        return view('student.schedule', compact('schedule'));
    }
    
    public function profile()
    {
        $student = Auth::user()->student;
        return view('student.profile', compact('student'));
    }
    
    public function updateProfile(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'parent_name' => 'nullable|string',
            'parent_phone' => 'nullable|string',
        ]);
        
        $student = Auth::user()->student;
        $student->update($request->only(['phone', 'address', 'parent_name', 'parent_phone']));
        
        return back()->with('success', 'Profile updated successfully');
    }
}