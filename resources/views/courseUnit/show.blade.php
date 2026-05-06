<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Course Unit Details</h2>
                        <div class="flex space-x-2">
                            <a href="{{ route('courseUnit.edit', $courseUnit->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit Course Unit
                            </a>
                            <a href="{{ route('courseUnit.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <!-- Course Code Display -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Course Code</label>
                                <div class="mt-1 text-2xl font-bold text-indigo-600">{{ $courseUnit->code }}</div>
                                <p class="text-xs text-gray-500 mt-1">Auto-generated, cannot be edited</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Course Unit Name</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-lg">{{ $courseUnit->name }}</div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Associated Program</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-lg">
                                {{ $courseUnit->program->program_name ?? 'No program assigned' }}
                                @if($courseUnit->program)
                                    <span class="text-sm text-gray-500 ml-2">({{ $courseUnit->program->program_code }})</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1 p-3 bg-gray-50 rounded-lg whitespace-pre-wrap">
                                {{ $courseUnit->description ?: 'No description provided' }}
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Created At</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg">
                                    {{ $courseUnit->created_at ? $courseUnit->created_at->format('F d, Y h:i A') : 'N/A' }}
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                                <div class="mt-1 p-3 bg-gray-50 rounded-lg">
                                    {{ $courseUnit->updated_at ? $courseUnit->updated_at->format('F d, Y h:i A') : 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Form -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <form method="POST" action="{{ route('courseUnit.destroy', $courseUnit->id) }}" 
                              onsubmit="return confirm('Are you sure you want to delete this course unit? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete Course Unit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>