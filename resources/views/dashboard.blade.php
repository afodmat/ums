<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="text-sm text-gray-500">
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg mb-8 overflow-hidden">
                <div class="p-6 text-white">
                    <h1 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->first_name }}! 👋</h1>
                    <p class="text-blue-100">Here's what's happening with your {{ config('app.name') }} today.</p>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Students -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Students</p>
                            <p class="text-2xl font-bold text-gray-800 mt-2">1,234</p>
                            <p class="text-green-500 text-xs mt-2">
                                <i class="fas fa-arrow-up"></i> 12% increase
                            </p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <i class="fas fa-user-graduate text-blue-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Lecturers -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Lecturers</p>
                            <p class="text-2xl font-bold text-gray-800 mt-2">48</p>
                            <p class="text-green-500 text-xs mt-2">
                                <i class="fas fa-arrow-up"></i> 4% increase
                            </p>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <i class="fas fa-chalkboard-teacher text-green-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Active Courses -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Active Courses</p>
                            <p class="text-2xl font-bold text-gray-800 mt-2">24</p>
                            <p class="text-gray-500 text-xs mt-2">This semester</p>
                        </div>
                        <div class="bg-purple-100 rounded-full p-3">
                            <i class="fas fa-book text-purple-600 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Pending Payments -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Pending Payments</p>
                            <p class="text-2xl font-bold text-gray-800 mt-2">$45,230</p>
                            <p class="text-red-500 text-xs mt-2">
                                <i class="fas fa-arrow-down"></i> 8% from last month
                            </p>
                        </div>
                        <div class="bg-yellow-100 rounded-full p-3">
                            <i class="fas fa-dollar-sign text-yellow-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Analytics -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Enrollment Chart -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Student Enrollment Trends</h3>
                        <select class="text-sm border rounded-md px-2 py-1">
                            <option>This Year</option>
                            <option>Last Year</option>
                            <option>Last 5 Years</option>
                        </select>
                    </div>
                    <canvas id="enrollmentChart" height="250"></canvas>
                </div>

                <!-- Course Distribution -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Course Distribution</h3>
                    <canvas id="courseChart" height="250"></canvas>
                </div>
            </div>

            <!-- Recent Activities and Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activities -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Activities</h3>
                        <a href="#" class="text-blue-600 text-sm hover:text-blue-800">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                            <div class="bg-green-100 rounded-full p-2">
                                <i class="fas fa-user-plus text-green-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">New student registered</p>
                                <p class="text-xs text-gray-500">John Doe joined Computer Science program</p>
                                <p class="text-xs text-gray-400 mt-1">2 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                            <div class="bg-blue-100 rounded-full p-2">
                                <i class="fas fa-file-alt text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">Assignment submitted</p>
                                <p class="text-xs text-gray-500">5 students submitted Database Design assignment</p>
                                <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                            <div class="bg-yellow-100 rounded-full p-2">
                                <i class="fas fa-credit-card text-yellow-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">Payment received</p>
                                <p class="text-xs text-gray-500">$5,000 tuition fee received from 10 students</p>
                                <p class="text-xs text-gray-400 mt-1">3 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="bg-purple-100 rounded-full p-2">
                                <i class="fas fa-calendar text-purple-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">Upcoming exam</p>
                                <p class="text-xs text-gray-500">Final Exam - Web Development scheduled for tomorrow</p>
                                <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Alerts -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <button class="w-full bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition flex items-center justify-center gap-2">
                            <i class="fas fa-user-plus"></i> Add New Student
                        </button>
                        <button class="w-full bg-green-600 text-white rounded-lg px-4 py-2 hover:bg-green-700 transition flex items-center justify-center gap-2">
                            <i class="fas fa-chalkboard-teacher"></i> Add New Course
                        </button>
                        <button class="w-full bg-purple-600 text-white rounded-lg px-4 py-2 hover:bg-purple-700 transition flex items-center justify-center gap-2">
                            <i class="fas fa-file-invoice-dollar"></i> Process Payments
                        </button>
                        <button class="w-full bg-gray-600 text-white rounded-lg px-4 py-2 hover:bg-gray-700 transition flex items-center justify-center gap-2">
                            <i class="fas fa-download"></i> Generate Reports
                        </button>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="mt-6">
                        <h4 class="font-medium text-gray-800 mb-3">Upcoming Events</h4>
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                            <p class="text-sm font-medium text-yellow-800">Faculty Meeting</p>
                            <p class="text-xs text-yellow-600">Tomorrow at 10:00 AM</p>
                        </div>
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-3 rounded mt-2">
                            <p class="text-sm font-medium text-blue-800">Exam Week</p>
                            <p class="text-xs text-blue-600">Starts in 3 days</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Role-Specific Sections -->
            @role('super_admin|admin')
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- System Status -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">System Status</h3>
                    <div class="space-y-3">
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Server Load</span>
                                <span>45%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 rounded-full h-2" style="width: 45%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Storage Used</span>
                                <span>2.3 TB / 5 TB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 rounded-full h-2" style="width: 46%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Active Users</span>
                                <span>156</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-purple-500 rounded-full h-2" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Registrations</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-gray-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Sarah Johnson</p>
                                    <p class="text-xs text-gray-500">Student</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-400">2 hours ago</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-gray-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Dr. Michael Chen</p>
                                    <p class="text-xs text-gray-500">Lecturer</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-400">1 day ago</span>
                        </div>
                    </div>
                </div>
            </div>
            @endrole

        </div>
    </div>

    <!-- Add Chart.js for charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enrollment Chart
            const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
            new Chart(enrollmentCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Enrollments',
                        data: [65, 78, 82, 95, 102, 118, 125, 140, 158, 165, 178, 190],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Course Distribution Chart
            const courseCtx = document.getElementById('courseChart').getContext('2d');
            new Chart(courseCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Computer Science', 'Business', 'Engineering', 'Medicine', 'Arts'],
                    datasets: [{
                        data: [35, 25, 20, 12, 8],
                        backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>

    <style>
        /* Custom animations */
        .transition-shadow {
            transition: box-shadow 0.3s ease;
        }
        
        /* Dashboard card hover effects */
        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        /* Smooth transitions */
        button {
            transition: all 0.2s ease;
        }
    </style>
</x-app-layout>