<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->name }} - Course Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs Navigation -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px">
                        <button onclick="showTab('overview')" id="tab-overview" class="tab-btn active px-6 py-3 text-sm font-medium">
                            Overview
                        </button>
                        <button onclick="showTab('students')" id="tab-students" class="tab-btn px-6 py-3 text-sm font-medium">
                            Students
                        </button>
                        <button onclick="showTab('assignments')" id="tab-assignments" class="tab-btn px-6 py-3 text-sm font-medium">
                            Assignments
                        </button>
                        <button onclick="showTab('attendance')" id="tab-attendance" class="tab-btn px-6 py-3 text-sm font-medium">
                            Attendance
                        </button>
                        <button onclick="showTab('grades')" id="tab-grades" class="tab-btn px-6 py-3 text-sm font-medium">
                            Grades
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Overview Tab -->
            <div id="overview-content" class="tab-content">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Course Information</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-600">Course Code</p>
                                <p class="font-medium">{{ $course->code }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Credit Hours</p>
                                <p class="font-medium">{{ $course->credit_hours ?? 3 }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-600">Description</p>
                                <p class="font-medium">{{ $course->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Students Tab -->
            <div id="students-content" class="tab-content hidden">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between mb-4">
                            <h3 class="text-lg font-semibold">Enrolled Students</h3>
                            <button onclick="downloadAttendance()" class="bg-green-600 text-white px-4 py-2 rounded text-sm">Download Report</button>
                        </div>
                        
                        <table class="w-full border rounded">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-3 text-left">Student Number</th>
                                    <th class="p-3 text-left">Name</th>
                                    <th class="p-3 text-left">Email</th>
                                    <th class="p-3 text-left">Attendance</th>
                                    <th class="p-3 text-left">Average Grade</th>
                                    <th class="p-3 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($course->students as $student)
                                    <tr class="border-t">
                                        <td class="p-3">{{ $student->student_number }}</td>
                                        <td class="p-3">{{ $student->user->first_name }} {{ $student->user->last_name }}</td>
                                        <td class="p-3">{{ $student->user->email }}</td>
                                        <td class="p-3">{{ $student->attendance_percentage ?? 0 }}%</td>
                                        <td class="p-3">{{ $student->average_grade ?? 'N/A' }}</td>
                                        <td class="p-3">
                                            <a href="{{ route('lecturer.student.show', $student->id) }}" class="text-indigo-600">View Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Assignments Tab -->
            <div id="assignments-content" class="tab-content hidden">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between mb-4">
                            <h3 class="text-lg font-semibold">Assignments</h3>
                            <button onclick="openCreateAssignment()" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm">+ Create Assignment</button>
                        </div>
                        
                        <div class="space-y-4">
                            @foreach($course->assignments ?? [] as $assignment)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-bold">{{ $assignment->title }}</h4>
                                            <p class="text-sm text-gray-600 mt-1">{{ $assignment->description }}</p>
                                            <div class="flex gap-4 mt-2 text-sm text-gray-500">
                                                <span>Due: {{ $assignment->due_date->format('M d, Y') }}</span>
                                                <span>Max Score: {{ $assignment->max_score }}</span>
                                                <span>Submissions: {{ $assignment->submissions_count ?? 0 }}/{{ $course->students->count() }}</span>
                                            </div>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('lecturer.assignments.grade', $assignment->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Grade</a>
                                            <a href="{{ route('lecturer.assignments.edit', $assignment->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'border-indigo-500', 'text-indigo-600');
                btn.classList.add('text-gray-500');
            });
            
            // Show selected tab content
            document.getElementById(`${tabName}-content`).classList.remove('hidden');
            
            // Add active class to clicked button
            const activeBtn = document.getElementById(`tab-${tabName}`);
            activeBtn.classList.add('active', 'border-indigo-500', 'text-indigo-600');
            activeBtn.classList.remove('text-gray-500');
        }
        
        function openCreateAssignment() {
            // Implement create assignment modal or redirect
            window.location.href = "{{ route('lecturer.assignments.create', $course->id) }}";
        }
        
        function downloadAttendance() {
            // Implement attendance report download
            window.location.href = "{{ route('lecturer.courses.attendance.download', $course->id) }}";
        }
    </script>
</x-app-layout>