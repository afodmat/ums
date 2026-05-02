<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //roles
        $guest = Role::firstOrCreate(['name' => 'guest']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $student = Role::firstOrCreate(['name' => 'student']);
        $lecturer = Role::firstOrCreate(['name' => 'lecturer']);
        $finance = Role::firstOrCreate(['name' => 'finance']);
        $registry = Role::firstOrCreate(['name' => 'registry']);

        //permissions

        //student management
        $registerStudent = Permission::firstOrCreate(['name' => 'register student']);
        $viewStudents = Permission::firstOrCreate(['name' => 'view students']);
        $editStudent = Permission::firstOrCreate(['name' => 'edit student records']);
        $deleteStudent = Permission::firstOrCreate(['name' => 'delete student record']);

        // Course management
        $createCourse = Permission::firstOrCreate(['name' => 'create course']);
        $assignCourse = Permission::firstOrCreate(['name' => 'assign course']);
        $viewCourses = Permission::firstOrCreate(['name' => 'view courses']);

        // Academic activities
        $enterMarks = Permission::firstOrCreate(['name' => 'enter marks']);
        $viewResults = Permission::firstOrCreate(['name' => 'view results']);

        // Finance
        $manageFees = Permission::firstOrCreate(['name' => 'manage fees']);
        $viewPayments = Permission::firstOrCreate(['name' => 'view payments']);
        $recordPayments = Permission::firstOrCreate(['name' => 'record payments']);

        //role permission assignment (pivot table)
        $admin->givePermissionTo([
            $registerStudent,
            $viewStudents,
            $editStudent,
            $deleteStudent,
            $createCourse,
            $assignCourse,
            $viewCourses,
            $enterMarks,
            $viewResults,
            $manageFees,
            $viewPayments,
            $recordPayments,
        ]);

        // LECTURER
        $lecturer->givePermissionTo([
            $viewStudents,
            $viewCourses,
            $enterMarks,
            $viewResults,
        ]);

        // FINANCE
        $finance->givePermissionTo([
            $viewStudents,
            $manageFees,
            $viewPayments,
            $recordPayments,
        ]);

        // STUDENT
        $student->givePermissionTo([
            $viewCourses,
            $viewResults,
            $viewPayments,
        ]);
    }
}
