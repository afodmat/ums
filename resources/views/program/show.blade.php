<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Program Details</h2>
                        <div class="flex space-x-2">
                            <button onclick="toggleEditMode()" id="editModeBtn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Enable Inline Editing
                            </button>
                            <a href="{{ route('program.edit', $program->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Full Edit Page
                            </a>
                            <a href="{{ route('program.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <!-- Program Code (Display Only) -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Program Code</label>
                                <div class="mt-1 text-2xl font-bold text-indigo-600">{{ $program->program_code }}</div>
                                <p class="text-xs text-gray-500 mt-1">Auto-generated, cannot be edited</p>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $program->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($program->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Inline Edit Form -->
                    <form id="inlineEditForm" method="POST" action="{{ route('program.update', $program->id) }}" style="display: none;">
                        @csrf
                        @method('PUT')
                        
                        <!-- Program Name -->
                        <div class="mb-4">
                            <x-input-label for="program_name_inline" :value="__('Program Name')" />
                            <x-text-input id="program_name_inline" class="block mt-1 w-full" type="text" name="program_name" :value="$program->program_name" required />
                        </div>

                        <!-- Degree Type -->
                        <div class="mb-4">
                            <x-input-label for="degree_type_inline" :value="__('Degree Type')" />
                            <select id="degree_type_inline" name="degree_type" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="Bachelor" {{ $program->degree_type == 'Bachelor' ? 'selected' : '' }}>Bachelor</option>
                                <option value="Master" {{ $program->degree_type == 'Master' ? 'selected' : '' }}>Master</option>
                                <option value="PhD" {{ $program->degree_type == 'PhD' ? 'selected' : '' }}>PhD</option>
                                <option value="Diploma" {{ $program->degree_type == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="Certificate" {{ $program->degree_type == 'Certificate' ? 'selected' : '' }}>Certificate</option>
                            </select>
                        </div>

                        <!-- Duration Years -->
                        <div class="mb-4">
                            <x-input-label for="duration_years_inline" :value="__('Duration (Years)')" />
                            <x-text-input id="duration_years_inline" class="block mt-1 w-full" type="number" name="duration_years" :value="$program->duration_years" required min="1" max="10" />
                        </div>

                        <!-- Duration Semesters -->
                        <div class="mb-4">
                            <x-input-label for="duration_semesters_inline" :value="__('Duration (Semesters)')" />
                            <x-text-input id="duration_semesters_inline" class="block mt-1 w-full" type="number" name="duration_semesters" :value="$program->duration_semesters" required min="2" max="20" />
                        </div>

                        <!-- Fees -->
                        <div class="mb-4">
                            <x-input-label for="fees_inline" :value="__('Fees (USD)')" />
                            <x-text-input id="fees_inline" class="block mt-1 w-full" type="number" step="0.01" name="fees" :value="$program->fees" required min="0" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description_inline" :value="__('Description')" />
                            <textarea id="description_inline" name="description" rows="4" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ $program->description }}</textarea>
                        </div>

                        <!-- Entry Requirements -->
                        <div class="mb-4">
                            <x-input-label for="entry_requirements_inline" :value="__('Entry Requirements')" />
                            <textarea id="entry_requirements_inline" name="entry_requirements" rows="3" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ $program->entry_requirements }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status_inline" :value="__('Status')" />
                            <select id="status_inline" name="status" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                <option value="active" {{ $program->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $program->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end gap-3 mt-6">
                            <button type="button" onclick="toggleEditMode()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save Changes
                            </button>
                        </div>
                    </form>

                    <!-- Display View -->
                    <div id="displayView">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Program Name</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg">{{ $program->program_name }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Degree Type</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg">{{ $program->degree_type }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Duration (Years)</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg">{{ $program->duration_years }} years</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Duration (Semesters)</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg">{{ $program->duration_semesters }} semesters</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Fees (USD)</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg">${{ number_format($program->fees, 2) }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Created At</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg">{{ $program->created_at->format('F d, Y h:i A') }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg">{{ $program->updated_at->format('F d, Y h:i A') }}</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-lg whitespace-pre-wrap">{{ $program->description }}</div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Entry Requirements</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-lg whitespace-pre-wrap">{{ $program->entry_requirements ?: 'No specific requirements listed' }}</div>
                        </div>
                    </div>

                    <!-- Delete Form -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <form method="POST" action="{{ route('program.destroy', $program->id) }}" onsubmit="return confirm('Are you sure you want to delete this program? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete Program
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleEditMode() {
            var inlineForm = document.getElementById('inlineEditForm');
            var displayView = document.getElementById('displayView');
            var editBtn = document.getElementById('editModeBtn');
            
            if (inlineForm.style.display === 'none') {
                inlineForm.style.display = 'block';
                displayView.style.display = 'none';
                editBtn.textContent = 'Cancel Inline Editing';
                editBtn.classList.remove('bg-green-500');
                editBtn.classList.add('bg-red-500');
            } else {
                inlineForm.style.display = 'none';
                displayView.style.display = 'block';
                editBtn.textContent = 'Enable Inline Editing';
                editBtn.classList.remove('bg-red-500');
                editBtn.classList.add('bg-green-500');
            }
        }
    </script>
</x-app-layout>