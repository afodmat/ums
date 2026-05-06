<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($courses as $course)
                            <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                                <div class="bg-indigo-600 p-4">
                                    <h3 class="text-white font-bold text-lg">{{ $course->name }}</h3>
                                    <p class="text-indigo-200 text-sm">{{ $course->code }}</p>
                                </div>
                                <div class="p-4">
                                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($course->description, 120) }}</p>
                                    
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-sm text-gray-500">
                                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                            {{ $course->students_count ?? 0 }} Students
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                            {{ $course->assignments_count ?? 0 }} Assignments
                                        </span>
                                    </div>
                                    
                                    <div class="flex gap-2">
                                        <a href="{{ route('lecturer.courses.show', $course->id) }}" class="flex-1 bg-indigo-600 text-white text-center px-3 py-2 rounded text-sm hover:bg-indigo-700">
                                            View Course
                                        </a>
                                        <a href="{{ route('lecturer.courses.students', $course->id) }}" class="flex-1 bg-gray-600 text-white text-center px-3 py-2 rounded text-sm hover:bg-gray-700">
                                            Students
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>