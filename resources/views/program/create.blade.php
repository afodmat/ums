<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Create New Program</h2>
                    
                    <form method="POST" action="{{ route('program.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Program Name -->
                        <div class="mb-4">
                            <x-input-label for="program_name" :value="__('Program Name')" />
                            <x-text-input id="program_name" class="block mt-1 w-full" type="text" name="program_name" :value="old('program_name')" required autofocus autocomplete="program_name" />
                            <x-input-error :messages="$errors->get('program_name')" class="mt-2" />
                        </div>

                        <!-- Degree Type -->
                        <div class="mb-4">
                            <x-input-label for="degree_type" :value="__('Degree Type')" />
                            <select id="degree_type" name="degree_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">Select Degree Type</option>
                                <option value="Bachelor" {{ old('degree_type') == 'Bachelor' ? 'selected' : '' }}>Bachelor</option>
                                <option value="Master" {{ old('degree_type') == 'Master' ? 'selected' : '' }}>Master</option>
                                <option value="PhD" {{ old('degree_type') == 'PhD' ? 'selected' : '' }}>PhD</option>
                                <option value="Diploma" {{ old('degree_type') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="Certificate" {{ old('degree_type') == 'Certificate' ? 'selected' : '' }}>Certificate</option>
                            </select>
                            <x-input-error :messages="$errors->get('degree_type')" class="mt-2" />
                        </div>

                        <!-- Duration Years -->
                        <div class="mb-4">
                            <x-input-label for="duration_years" :value="__('Duration (Years)')" />
                            <x-text-input id="duration_years" class="block mt-1 w-full" type="number" name="duration_years" :value="old('duration_years')" required autocomplete="duration_years" min="1" max="10" />
                            <x-input-error :messages="$errors->get('duration_years')" class="mt-2" />
                        </div>

                        <!-- Duration Semesters -->
                        <div class="mb-4">
                            <x-input-label for="duration_semesters" :value="__('Duration (Semesters)')" />
                            <x-text-input id="duration_semesters" class="block mt-1 w-full" type="number" name="duration_semesters" :value="old('duration_semesters')" required autocomplete="duration_semesters" min="2" max="20" />
                            <x-input-error :messages="$errors->get('duration_semesters')" class="mt-2" />
                        </div>

                        <!-- Fees -->
                        <div class="mb-4">
                            <x-input-label for="fees" :value="__('Fees (USD)')" />
                            <x-text-input id="fees" class="block mt-1 w-full" type="number" step="0.01" name="fees" :value="old('fees')" required autocomplete="fees" min="0" />
                            <x-input-error :messages="$errors->get('fees')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Entry Requirements -->
                        <div class="mb-4">
                            <x-input-label for="entry_requirements" :value="__('Entry Requirements')" />
                            <textarea id="entry_requirements" name="entry_requirements" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="List the entry requirements for this program...">{{ old('entry_requirements') }}</textarea>
                            <x-input-error :messages="$errors->get('entry_requirements')" class="mt-2" />
                            <p class="text-sm text-gray-500 mt-1">e.g., High School Diploma, Minimum GPA 2.5, Entrance Exam, etc.</p>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('program.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancel</a>
                            <x-primary-button>
                                {{ __('Create Program') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>