<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Admin;
use App\Models\Finance;
use App\Models\Program;
// use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display all users with their roles
     */
    public function index()
    {
        $users = User::with(['roles', 'student.program', 'lecturer.department', 'admin'])->get();
        
        // Statistics
        $stats = [
            'total_users' => User::count(),
            'students' => User::role('student')->count(),
            'lecturers' => User::role('lecturer')->count(),
            'admins' => User::role('admin')->count(),
            'finance' => User::role('finance')->count(),
        ];
        
        return view('admin.index', compact('users', 'stats'));
    }

    /**
     * Show form to create a new user (admin, lecturer, student, or finance)
     */
    public function create()
    {
        $programs = Program::where('status', 'active')->get();
        // $departments = Department::all();
        return view('admin.create', compact('programs'));
    }

    /**
     * Store a newly created user with specific role
     */
    public function store(Request $request)
    {
        // Validate based on role
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'role'       => 'required|in:admin,student,lecturer,finance',
            'email'      => 'nullable|email|unique:users,email',
            'phone'      => 'nullable|string',
            'password'   => 'required|min:6',
        ];
        
        // Add role-specific validation rules
        if ($request->role === 'student') {
            $rules['program_id'] = 'required|exists:programs,id';
            $rules['enrollment_date'] = 'nullable|date';
            $rules['parent_name'] = 'nullable|string';
            $rules['parent_phone'] = 'nullable|string';
            $rules['address'] = 'nullable|string';
            $rules['high_school_gpa'] = 'nullable|numeric|min:0|max:4';
        }
        
        if ($request->role === 'lecturer') {
            // $rules['department_id'] = 'required|exists:departments,id';
            $rules['specialization'] = 'nullable|string';
            $rules['employment_type'] = 'nullable|in:full_time,part_time,contract';
            $rules['join_date'] = 'nullable|date';
        }
        
        if ($request->role === 'finance') {
            // $rules['department'] = 'nullable|string';
            $rules['position'] = 'nullable|string';
        }
        
        $request->validate($rules);

        DB::transaction(function () use ($request) {
            // 1. CREATE USER (authentication)
            $user = User::create([
                'first_name'  => $request->first_name,
                'last_name'   => $request->last_name,
                'user_number' => User::generateUserNumber($request->role),
                'password'    => Hash::make($request->password),
                'email'       => $request->email,
            ]);

            // 2. ASSIGN ROLE
            $user->assignRole($request->role);

            // Handle photo upload
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos/' . $request->role, 'public');
            }

            // 3. CREATE PROFILE BASED ON ROLE
            if ($request->role === 'admin') {
                Admin::create([
                    'user_id' => $user->id,
                    'phone'   => $request->phone,
                    'photo'   => $photoPath,
                    'position' => $request->position ?? 'Administrator',
                ]);
            }

            if ($request->role === 'student') {
                Student::create([
                    'user_id' => $user->id,
                    'student_number' => $this->generateStudentNumber(),
                    'program_id' => $request->program_id,
                    'enrollment_date' => $request->enrollment_date ?? now(),
                    'expected_graduation_date' => $request->expected_graduation_date,
                    'current_semester' => 1,
                    'academic_status' => 'active',
                    'parent_name' => $request->parent_name,
                    'parent_phone' => $request->parent_phone,
                    'parent_email' => $request->parent_email,
                    'address' => $request->address,
                    'emergency_contact_name' => $request->emergency_contact_name,
                    'emergency_contact_phone' => $request->emergency_contact_phone,
                    'high_school_name' => $request->high_school_name,
                    'high_school_gpa' => $request->high_school_gpa,
                    'previous_institution' => $request->previous_institution,
                    'transfer_credits' => $request->transfer_credits ?? 0,
                    'photo' => $photoPath,
                ]);
            }

            if ($request->role === 'lecturer') {
                Lecturer::create([
                    'user_id' => $user->id,
                    'lecturer_number' => $this->generateLecturerNumber(),
                    // 'department_id' => $request->department_id,
                    'specialization' => $request->specialization,
                    'qualification' => $request->qualification ? json_encode(explode(',', $request->qualification)) : null,
                    'years_of_experience' => $request->years_of_experience ?? 0,
                    'join_date' => $request->join_date ?? now(),
                    'employment_type' => $request->employment_type ?? 'full_time',
                    'office_location' => $request->office_location,
                    'office_phone' => $request->office_phone,
                    'consultation_hours' => $request->consultation_hours,
                    'research_interests' => $request->research_interests,
                    'biography' => $request->biography,
                    'photo' => $photoPath,
                    'status' => 'active',
                ]);
            }
            
            if ($request->role === 'finance') {
                Finance::create([
                    'user_id' => $user->id,
                    'employee_number' => $this->generateFinanceNumber(),
                    // 'department' => $request->department ?? 'Finance',
                    'position' => $request->position ?? 'Finance Officer',
                    'phone' => $request->phone,
                    'photo' => $photoPath,
                ]);
            }
        });

        return redirect()->route('admin.index')->with('success', ucfirst($request->role) . ' created successfully!');
    }

    /**
     * Display specific user details
     */
    public function show($id)
    {
        $user = User::with(['student.program', 'lecturer.department', 'admin'])->findOrFail($id);
        
        // Get role-specific data
        $roleData = null;
        if ($user->hasRole('student')) {
            $roleData = $user->student;
        } elseif ($user->hasRole('lecturer')) {
            $roleData = $user->lecturer;
        } elseif ($user->hasRole('admin')) {
            $roleData = $user->admin;
        }
        
        return view('admin.show', compact('user', 'roleData'));
    }

    /**
     * Show form to edit user
     */
    public function edit($id)
    {
        $user = User::with(['student', 'lecturer', 'admin'])->findOrFail($id);
        $programs = Program::where('status', 'active')->get();
        $departments = Department::all();
        return view('admin.edit', compact('user', 'programs'));
    }

    /**
     * Update user information
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|email|unique:users,email,' . $id,
            'phone'      => 'nullable|string',
            'password'   => 'nullable|min:6',
        ];
        
        // Add role-specific validation rules
        if ($user->hasRole('student')) {
            $rules['program_id'] = 'required|exists:programs,id';
            $rules['academic_status'] = 'nullable|in:active,suspended,graduated,withdrawn';
            $rules['current_semester'] = 'nullable|integer|min:1';
        }
        
        if ($user->hasRole('lecturer')) {
            // $rules['department_id'] = 'required|exists:departments,id';
            $rules['employment_type'] = 'nullable|in:full_time,part_time,contract';
            $rules['status'] = 'nullable|in:active,on_leave,terminated';
        }
        
        $request->validate($rules);

        DB::transaction(function () use ($request, $user) {
            // Update user data
            $userData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ];
            
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            
            $user->update($userData);
            
            // Handle photo upload
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos/' . $user->getRoleNames()->first(), 'public');
                
                if ($user->hasRole('student') && $user->student) {
                    $user->student->update(['photo' => $photoPath]);
                } elseif ($user->hasRole('lecturer') && $user->lecturer) {
                    $user->lecturer->update(['photo' => $photoPath]);
                } elseif ($user->hasRole('admin') && $user->admin) {
                    $user->admin->update(['photo' => $photoPath]);
                }
            }
            
            // Update role-specific profiles
            if ($user->hasRole('student') && $user->student) {
                $user->student->update([
                    'program_id' => $request->program_id,
                    'academic_status' => $request->academic_status ?? $user->student->academic_status,
                    'current_semester' => $request->current_semester ?? $user->student->current_semester,
                    'parent_name' => $request->parent_name,
                    'parent_phone' => $request->parent_phone,
                    'address' => $request->address,
                ]);
            }
            
            if ($user->hasRole('lecturer') && $user->lecturer) {
                $user->lecturer->update([
                    // 'department_id' => $request->department_id,
                    'specialization' => $request->specialization,
                    'employment_type' => $request->employment_type ?? $user->lecturer->employment_type,
                    'status' => $request->status ?? $user->lecturer->status,
                    'office_location' => $request->office_location,
                    'office_phone' => $request->office_phone,
                ]);
            }
            
            if ($user->hasRole('admin') && $user->admin) {
                $user->admin->update([
                    'phone' => $request->phone,
                    'position' => $request->position,
                ]);
            }
        });

        return redirect()->route('admin.index')->with('success', 'User updated successfully');
    }

    /**
     * Delete user (soft delete)
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Check if user has related records
        if ($user->hasRole('student') && $user->student) {
            $user->student->delete();
        } elseif ($user->hasRole('lecturer') && $user->lecturer) {
            $user->lecturer->delete();
        } elseif ($user->hasRole('admin') && $user->admin) {
            $user->admin->delete();
        }
        
        $user->delete(); // Soft delete user
        
        return redirect()->route('admin.index')->with('success', 'User deleted successfully');
    }
    
    /**
     * Helper methods for generating unique numbers
     */
    private function generateStudentNumber()
    {
        $last = Student::orderBy('student_number', 'desc')->first();
        if (!$last) {
            return 'STU' . str_pad(1, 5, '0', STR_PAD_LEFT);
        }
        $number = (int) substr($last->student_number, 3);
        return 'STU' . str_pad($number + 1, 5, '0', STR_PAD_LEFT);
    }
    
    private function generateLecturerNumber()
    {
        $last = Lecturer::orderBy('lecturer_number', 'desc')->first();
        if (!$last) {
            return 'LEC' . str_pad(1, 5, '0', STR_PAD_LEFT);
        }
        $number = (int) substr($last->lecturer_number, 3);
        return 'LEC' . str_pad($number + 1, 5, '0', STR_PAD_LEFT);
    }
    
    private function generateFinanceNumber()
    {
        $last = Finance::orderBy('employee_number', 'desc')->first();
        if (!$last) {
            return 'FIN' . str_pad(1, 5, '0', STR_PAD_LEFT);
        }
        $number = (int) substr($last->employee_number, 3);
        return 'FIN' . str_pad($number + 1, 5, '0', STR_PAD_LEFT);
    }
}