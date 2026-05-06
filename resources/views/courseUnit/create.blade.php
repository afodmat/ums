<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Create New Course Unit</h2>
                        <a href="{{ route('courseUnit.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to List
                        </a>
                    </div>

                    <form method="POST" action="{{ route('courseUnit.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Course Unit Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Course Unit Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="e.g., Introduction to Programming" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <p class="text-sm text-gray-500 mt-1">Enter the full name of the course unit</p>
                        </div>

                        <!-- Program Association -->
                        <div class="mb-4">
                            <x-input-label for="program_id" :value="__('Associated Program')" />
                            <select id="program_id" name="program_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Program (Optional)</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                        {{ $program->program_name }} ({{ $program->program_code }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('program_id')" class="mt-2" />
                            <p class="text-sm text-gray-500 mt-1">Assign this course unit to a program (you can change this later)</p>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="5" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Enter detailed description of the course unit...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            <p class="text-sm text-gray-500 mt-1">Provide information about course content, learning objectives, prerequisites, etc.</p>
                        </div>

                        <!-- Auto-generated Code Info -->
                        <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Auto-generated Course Code</h3>
                                    <div class="mt-1 text-sm text-blue-700">
                                        <p>A unique course code will be automatically generated when you create this course unit (e.g., CU-0001, CU-0002, etc.)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end gap-3 mt-6">
                            <a href="{{ route('courseUnit.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Create Course Unit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>