<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CREATE ROLE (if not exists)
        $role = Role::firstOrCreate(['name' => 'super_admin']);

        // 2. CREATE USER
        $user = User::firstOrCreate([
            'first_name'  => 'Super',
            'last_name'   => 'Admin',
            'email'       => 'admin@example.com',
            'password'    => Hash::make('admin123'),
            'user_number' => User::generateUserNumber('super_admin'),
            'email_verified_at' => now(),
        ]);

        // 3. ASSIGN ROLE
        $user->assignRole($role);

        // 4. CREATE ADMIN PROFILE
        Admin::create([
            'user_id' => $user->id,
            'phone'   => '0700000000',
            'photo'   => null,
        ]);
    }
}
