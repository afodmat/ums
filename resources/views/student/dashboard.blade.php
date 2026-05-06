<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold">Welcome, {{ Auth::user()->first_name }}!</h3>
                            <p class="text-gray-600">Student ID: {{ Auth::user()->student->student_number ?? 'N/A' }}</p>
                            <p class="text-gray-600">Program: {{ Auth::user()->student->program->program_name ?? 'Not Assigned' }}</p>
                        </div>
                        <div>
                            <span class="px-3 py-1 rounded-full text-sm {{ Auth::user()->student->academic_status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst(Auth::user()->student->academic_status ?? 'Active') }}
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
                                <p class="text-gray-500 text-sm">Current GPA</p>
                                <p class="text-2xl font-bold">{{ $currentGpa ?? '3.45' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Completed Credits</p>
                                <p class="text-2xl font-bold">{{ $completedCredits ?? 45 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-100 rounded-full">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Attendance Rate</p>
                                <p class="text-2xl font-bold">{{ $attendanceRate ?? '92' }}%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-full">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Fees Balance</p>
                                <p class="text-2xl font-bold text-red-600">${{ $feesBalance ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Courses -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Current Semester Courses</h3>
                        <a href="{{ route('student.courses') }}" class="text-indigo-600 hover:text-indigo-900">View All →</a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @forelse($currentCourses ?? [] as $course)
                            <div class="border rounded-lg p-4">
                                <h4 class="font-bold">{{ $course->name }}</h4>
                                <p class="text-gray-600 text-sm">{{ $course->code }}</p>
                                <p class="text-gray-500 text-sm mt-2">{{ $course->lecturer->user->first_name ?? 'TBA' }} {{ $course->lecturer->user->last_name ?? '' }}</p>
                                <div class="mt-3 flex justify-between items-center">
                                    <span class="text-sm text-gray-500">{{ $course->schedule ?? 'Schedule TBA' }}</span>
                                    <a href="{{ route('student.courses.show', $course->id) }}" class="text-indigo-600 text-sm">View →</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 col-span-3">No courses enrolled for this semester.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Upcoming Assignments & Latest Grades -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Upcoming Assignments</h3>
                        <div class="space-y-3">
                            @forelse($upcomingAssignments ?? [] as $assignment)
                                <div class="flex items-center justify-between border-b pb-2">
                                    <div>
                                        <p class="font-medium">{{ $assignment->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $assignment->course->name }} - Due: {{ $assignment->due_date->format('M d, Y') }}</p>
                                    </div>
                                    <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">{{ $assignment->due_date->diffForHumans() }}</span>
                                </div>
                            @empty
                                <p class="text-gray-500">No upcoming assignments.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Latest Grades</h3>
                        <div class="space-y-3">
                            @forelse($latestGrades ?? [] as $grade)
                                <div class="flex items-center justify-between border-b pb-2">
                                    <div>
                                        <p class="font-medium">{{ $grade->assignment->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $grade->assignment->course->name }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="font-bold text-lg">{{ $grade->score }}/{{ $grade->assignment->max_score }}</span>
                                        <span class="text-sm text-gray-500 ml-1">({{ $grade->percentage }}%)</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">No grades available yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fee Payment Status -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold">Fee Payment Status</h3>
                            <p class="text-gray-600">Semester: {{ $currentSemester ?? 'Spring 2024' }}</p>
                        </div>
                        <a href="{{ route('student.fees') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Make Payment</a>
                    </div>
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-full h-4">
                            <div class="bg-green-600 h-4 rounded-full" style="width: {{ $paymentPercentage ?? 65 }}%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-sm">
                            <span>Paid: ${{ $paidFees ?? 6500 }}</span>
                            <span>Due: ${{ $dueFees ?? 3500 }}</span>
                            <span>Total: ${{ $totalFees ?? 10000 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>