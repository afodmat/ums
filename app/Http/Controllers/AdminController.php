<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Student;
// use App\Models\Lecturer;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function create(){
        return view('admin.create');
    }

    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'role'       => 'required|in:admin,student,lecturer,finance',
            'email'      => 'nullable|email',
            'phone'      => 'nullable',
            'password'   => 'required|min:6',
        ]);

        DB::transaction(function () use ($request) {

            // 1. CREATE USER (authentication)
            $user = User::create([
                'first_name'  => $request->first_name,
                'last_name'   => $request->last_name,
                'user_number' => User::generateUserNumber($request->role),
                'password'    => Hash::make($request->password),
                'email'   => $request->email,
            ]);

            // 2. ASSIGN ROLE
            $user->assignRole($request->role);

            // 3. CREATE PROFILE BASED ON ROLE
            if ($request->role === 'admin') {
                Amin::create([
                    'user_id' => $user->id,
                    'phone'   => $request->phone,
                    'photo'   => $request->photo,
                ]);
            }

            // if ($request->role === 'lecturer') {
            //     Lecturer::create([
            //         'user_id' => $user->id,
            //         'email'   => $request->email,
            //         'phone'   => $request->phone,
            //         'photo'   => $request->photo,
            //     ]);
            // }

            // if ($request->role === 'admin') {
            //     // optional admin profile or just skip
            // }

        });

        return back()->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::with('admin')->findOrFail($id);
        return view('admin.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('admin')->findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'role'       => 'required|in:admin,student,lecturer,finance',
            'email'      => 'nullable|email',
            'phone'      => 'nullable',
            'password'   => 'nullable|min:6',
        ]);
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        DB::transaction(function () use ($request) {
            $user = User::findOrFail($id);

            $user->update([
                'first_name'  => $request->first_name,
                'last_name'   => $request->last_name,
                'user_number' => User::generateUserNumber($request->role),
                'password'    => Hash::make($request->password),
                'email'   => $request->email,
            ]);
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
}
            if ($request->role === 'admin') {
                Admin::update([
                    'user_id' => $user->id,
                    'phone'   => $request->phone,
                    'photo'   => $request->photo,
                ]);
            }
        });
    }

    public function delete($id){
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect(route('dashboard', absolute: false));
    }
}
