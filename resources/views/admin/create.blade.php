<!-- admin/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        Create New User
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between mb-6">
            <h2 class="text-2xl font-bold">Create User (Admin/Lecturer/Student/Finance)</h2>
            <a href="{{ route('admin.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to List</a>
        </div>

        <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Basic Information -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label for="first_name" :value="__('First Name')" />
                    <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="last_name" :value="__('Last Name')" />
                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
            </div>

            <!-- Role Selection -->
            <div class="mb-4">
                <x-input-label for="role" :value="__('Role')" />
                <select id="role" name="role" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" required onchange="toggleRoleFields()">
                    <option value="">Select Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="lecturer" {{ old('role') == 'lecturer' ? 'selected' : '' }}>Lecturer</option>
                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="finance" {{ old('role') == 'finance' ? 'selected' : '' }}>Finance</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="photo" :value="__('Photo')" />
                    <input type="file" id="photo" name="photo" class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                </div>
            </div>

            <!-- Student-specific fields -->
            <div id="studentFields" style="display: none;">
                <div class="border-t pt-4 mt-4">
                    <h3 class="text-lg font-semibold mb-4">Student Information</h3>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="program_id" :value="__('Program')" />
                            <select id="program_id" name="program_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Select Program</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->program_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="enrollment_date" :value="__('Enrollment Date')" />
                            <x-text-input id="enrollment_date" class="block mt-1 w-full" type="date" name="enrollment_date" :value="old('enrollment_date')" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="parent_name" :value="__('Parent/Guardian Name')" />
                            <x-text-input id="parent_name" class="block mt-1 w-full" type="text" name="parent_name" :value="old('parent_name')" />
                        </div>

                        <div>
                            <x-input-label for="parent_phone" :value="__('Parent/Guardian Phone')" />
                            <x-text-input id="parent_phone" class="block mt-1 w-full" type="text" name="parent_phone" :value="old('parent_phone')" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="address" :value="__('Address')" />
                        <textarea id="address" name="address" rows="2" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('address') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="high_school_name" :value="__('High School Name')" />
                            <x-text-input id="high_school_name" class="block mt-1 w-full" type="text" name="high_school_name" :value="old('high_school_name')" />
                        </div>

                        <div>
                            <x-input-label for="high_school_gpa" :value="__('High School GPA')" />
                            <x-text-input id="high_school_gpa" class="block mt-1 w-full" type="number" step="0.01" name="high_school_gpa" :value="old('high_school_gpa')" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lecturer-specific fields -->
            <div id="lecturerFields" style="display: none;">
                <div class="border-t pt-4 mt-4">
                    <h3 class="text-lg font-semibold mb-4">Lecturer Information</h3>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="department_id" :value="__('Department')" />
                            <select id="department_id" name="department_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="specialization" :value="__('Specialization')" />
                            <x-text-input id="specialization" class="block mt-1 w-full" type="text" name="specialization" :value="old('specialization')" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="qualification" :value="__('Qualifications (comma-separated)')" />
                            <x-text-input id="qualification" class="block mt-1 w-full" type="text" name="qualification" :value="old('qualification')" placeholder="PhD, MSc, BSc" />
                        </div>

                        <div>
                            <x-input-label for="employment_type" :value="__('Employment Type')" />
                            <select id="employment_type" name="employment_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="full_time">Full Time</option>
                                <option value="part_time">Part Time</option>
                                <option value="contract">Contract</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="years_of_experience" :value="__('Years of Experience')" />
                            <x-text-input id="years_of_experience" class="block mt-1 w-full" type="number" name="years_of_experience" :value="old('years_of_experience')" />
                        </div>

                        <div>
                            <x-input-label for="join_date" :value="__('Join Date')" />
                            <x-text-input id="join_date" class="block mt-1 w-full" type="date" name="join_date" :value="old('join_date')" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="office_location" :value="__('Office Location')" />
                            <x-text-input id="office_location" class="block mt-1 w-full" type="text" name="office_location" :value="old('office_location')" />
                        </div>

                        <div>
                            <x-input-label for="office_phone" :value="__('Office Phone')" />
                            <x-text-input id="office_phone" class="block mt-1 w-full" type="text" name="office_phone" :value="old('office_phone')" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="research_interests" :value="__('Research Interests')" />
                        <textarea id="research_interests" name="research_interests" rows="2" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('research_interests') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Finance-specific fields -->
            <div id="financeFields" style="display: none;">
                <div class="border-t pt-4 mt-4">
                    <h3 class="text-lg font-semibold mb-4">Finance Information</h3>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="department" :value="__('Department')" />
                            <x-text-input id="department" class="block mt-1 w-full" type="text" name="department" :value="old('department')" />
                        </div>

                        <div>
                            <x-input-label for="position" :value="__('Position')" />
                            <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-6 gap-3">
                <a href="{{ route('admin.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Create User</button>
            </div>
        </form>
    </div>

    <script>
        function toggleRoleFields() {
            const role = document.getElementById('role').value;
            
            // Hide all role-specific fields
            document.getElementById('studentFields').style.display = 'none';
            document.getElementById('lecturerFields').style.display = 'none';
            document.getElementById('financeFields').style.display = 'none';
            
            // Show fields based on selected role
            if (role === 'student') {
                document.getElementById('studentFields').style.display = 'block';
                // Make program_id required
                document.getElementById('program_id').required = true;
            } else if (role === 'lecturer') {
                document.getElementById('lecturerFields').style.display = 'block';
                document.getElementById('department_id').required = true;
            } else if (role === 'finance') {
                document.getElementById('financeFields').style.display = 'block';
            } else if (role === 'admin') {
                // No additional fields needed
            }
        }
        
        // Call on page load if old value exists
        if (document.getElementById('role').value) {
            toggleRoleFields();
        }
    </script>
</x-app-layout>