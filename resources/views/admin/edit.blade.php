<x-app-layout>
    <x-slot name="header">
        Edit User
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6">

        <form method="POST" action="{{ route('admin.update', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- First Name -->
            <div>
                <label>First Name</label>
                <input type="text" name="first_name"
                       value="{{ $user->first_name }}"
                       class="w-full border rounded p-2">
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <label>Last Name</label>
                <input type="text" name="last_name"
                       value="{{ $user->last_name }}"
                       class="w-full border rounded p-2">
            </div>

            <!-- Email -->
            <div class="mt-4">
                <label>Email</label>
                <input type="email" name="email"
                       value="{{ $user->email }}"
                       class="w-full border rounded p-2">
            </div>

            <!-- Role -->
            <div class="mt-4">
                <label>Role</label>
                <select name="role" class="w-full border rounded p-2">
                    <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                    <option value="student" {{ $user->hasRole('student') ? 'selected' : '' }}>Student</option>
                    <option value="lecturer" {{ $user->hasRole('lecturer') ? 'selected' : '' }}>Lecturer</option>
                    <option value="finance" {{ $user->hasRole('finance') ? 'selected' : '' }}>Finance</option>
                </select>
            </div>

            <!-- Phone (Admin only) -->
            @if($user->admin)
                <div class="mt-4">
                    <label>Phone</label>
                    <input type="text" name="phone"
                           value="{{ $user->admin->phone }}"
                           class="w-full border rounded p-2">
                </div>
            @endif

            <!-- Password -->
            <div class="mt-4">
                <label>Password (leave blank to keep current)</label>
                <input type="password" name="password"
                       class="w-full border rounded p-2">
            </div>

            <div class="mt-6 flex gap-2">
                <button class="px-4 py-2 bg-indigo-600 text-white rounded">
                    Update
                </button>

                <a href="{{ route('admin.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</x-app-layout>