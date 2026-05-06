<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lecturer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold">Welcome back, {{ Auth::user()->first_name }}!</h3>
                            <p class="text-gray-600">Lecturer ID: {{ Auth::user()->lecturer->lecturer_number ?? 'N/A' }}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                {{ Auth::user()->lecturer->status ?? 'Active' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-full">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">My Courses</p>
                                <p class="text-2xl font-bold">{{ $coursesCount ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Total Students</p>
                                <p class="text-2xl font-bold">{{ $studentsCount ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-100 rounded-full">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Assignments to Grade</p>
                                <p class="text-2xl font-bold">{{ $pendingGrading ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-full">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Consultation Hours</p>
                                <p class="text-2xl font-bold">{{ $consultationHours ?? 0 }}/wk</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Courses Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">My Courses</h3>
                        <a href="{{ route('lecturer.courses') }}" class="text-indigo-600 hover:text-indigo-900">View All →</a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @forelse($myCourses ?? [] as $course)
                            <div class="border rounded-lg p-4 hover:shadow-lg transition">
                                <h4 class="font-bold text-lg">{{ $course->name }}</h4>
                                <p class="text-gray-600 text-sm mt-1">{{ $course->code }}</p>
                                <p class="text-gray-500 text-sm mt-2">{{ Str::limit($course->description, 100) }}</p>
                                <div class="mt-3 flex justify-between items-center">
                                    <span class="text-sm text-gray-500">{{ $course->students_count ?? 0 }} students</span>
                                    <a href="{{ route('lecturer.courses.show', $course->id) }}" class="text-indigo-600 text-sm">Manage →</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 col-span-3">No courses assigned yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Today's Schedule -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Today's Schedule</h3>
                        <div class="space-y-3">
                            @forelse($todaySchedule ?? [] as $class)
                                <div class="flex items-center justify-between border-b pb-2">
                                    <div>
                                        <p class="font-medium">{{ $class->course_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $class->time }} - {{ $class->room }}</p>
                                    </div>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">{{ $class->duration }}</span>
                                </div>
                            @empty
                                <p class="text-gray-500">No classes scheduled for today.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Submissions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Submissions Need Grading</h3>
                        <div class="space-y-3">
                            @forelse($recentSubmissions ?? [] as $submission)
                                <div class="flex items-center justify-between border-b pb-2">
                                    <div>
                                        <p class="font-medium">{{ $submission->student_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $submission->assignment_name }}</p>
                                    </div>
                                    <a href="{{ route('lecturer.grade', $submission->id) }}" class="px-3 py-1 bg-yellow-500 text-white text-sm rounded">Grade</a>
                                </div>
                            @empty
                                <p class="text-gray-500">No pending submissions.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>