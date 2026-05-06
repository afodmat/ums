<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Edit Course Unit</h2>
                        <div class="flex space-x-2">
                            <a href="{{ route('courseUnit.show', $courseUnit->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                View Course Unit
                            </a>
                            <a href="{{ route('courseUnit.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('courseUnit.update', $courseUnit->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Course Code (Read-only) -->
                        <div class="mb-4">
                            <x-input-label for="code" :value="__('Course Code')" />
                            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="$courseUnit->code" disabled readonly style="background-color: #f3f4f6;" />
                            <p class="text-sm text-gray-500 mt-1">Course code is auto-generated and cannot be edited</p>
                        </div>

                        <!-- Course Unit Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Course Unit Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $courseUnit->name)" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Program Association -->
                        <div class="mb-4">
                            <x-input-label for="program_id" :value="__('Associated Program')" />
                            <select id="program_id" name="program_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Program (Optional)</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" 
                                        {{ old('program_id', $courseUnit->program_id) == $program->id ? 'selected' : '' }}>
                                        {{ $program->program_name }} ({{ $program->program_code }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('program_id')" class="mt-2" />
                            <p class="text-sm text-gray-500 mt-1">Assign this course unit to a program (optional)</p>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="5" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Enter detailed description of the course unit...">{{ old('description', $courseUnit->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            <p class="text-sm text-gray-500 mt-1">Provide a comprehensive description of the course content, objectives, and learning outcomes</p>
                        </div>

                        <!-- Metadata Section (Read-only) -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-semibold mb-4">Metadata</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <x-input-label for="created_at" :value="__('Created At')" />
                                    <x-text-input id="created_at" class="block mt-1 w-full" type="text" :value="$courseUnit->created_at ? $courseUnit->created_at->format('F d, Y h:i A') : 'N/A'" disabled readonly style="background-color: #f3f4f6;" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="updated_at" :value="__('Last Updated')" />
                                    <x-text-input id="updated_at" class="block mt-1 w-full" type="text" :value="$courseUnit->updated_at ? $courseUnit->updated_at->format('F d, Y h:i A') : 'N/A'" disabled readonly style="background-color: #f3f4f6;" />
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end gap-3 mt-6">
                            <a href="{{ route('courseUnit.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Course Unit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>