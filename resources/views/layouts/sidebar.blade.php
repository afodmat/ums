@props(['activePage'])

<aside
    x-data="{ 
        collapsed: false,
        openMenus: {
            admins: {{ request()->routeIs('admin.*') ? 'true' : 'false' }},
            lecturers: false,
            students: false,
            academics: false,
            finance: false
        },
        toggleMenu(menu) {
            if (!this.collapsed) {
                this.openMenus[menu] = !this.openMenus[menu];
            }
        }
    }"
    :class="collapsed ? 'w-20' : 'w-64'"
    class="bg-gradient-dark shadow-lg transition-all duration-300 flex-shrink-0 flex flex-col h-screen overflow-hidden"
    style="background: linear-gradient(195deg, #42424a, #191919) !important;"
>

    <!-- HEADER - Fixed at top -->
    <div class="sidenav-header flex items-center justify-between px-4 py-4 flex-shrink-0">
        <span x-show="!collapsed" class="text-white font-bold text-xl whitespace-nowrap">
            UMS System
        </span>
        <button @click="collapsed = !collapsed" class="text-white hover:bg-white/10 rounded-lg p-2 transition-all">
            <i class="fas fa-bars text-lg"></i>
        </button>
    </div>

    <hr class="horizontal light my-2 mx-3 flex-shrink-0" style="background-color: rgba(255,255,255,0.1);">

    <!-- SCROLLABLE MENU AREA -->
    <div class="flex-1 overflow-y-auto overflow-x-hidden px-3">
        <ul class="flex flex-col gap-1 pb-4">
            <!-- DASHBOARD -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                   class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-chart-pie w-5"></i>
                    <span x-show="!collapsed" class="font-medium whitespace-nowrap">Dashboard</span>
                </a>
            </li>

            <hr class="horizontal light my-2 mx-2 flex-shrink-0" style="background-color: rgba(255,255,255,0.05);">

            <!-- ADMIN DROPDOWN -->
            @role('super_admin|admin')
            <li class="nav-item">
                <a @click.prevent="toggleMenu('admins')" 
                   class="nav-link flex items-center justify-between gap-3 px-3 py-2 rounded-lg cursor-pointer transition-all duration-200 {{ request()->routeIs('admin.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-user-shield w-5"></i>
                        <span x-show="!collapsed" class="font-medium whitespace-nowrap">Admins</span>
                    </div>
                    <i x-show="!collapsed" class="fas fa-chevron-down transition-transform duration-200" 
                       :style="openMenus.admins ? 'transform: rotate(180deg);' : 'transform: rotate(0deg);'"></i>
                </a>

                <div x-show="openMenus.admins && !collapsed" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-cloak
                     class="mt-1 ml-8 space-y-1 border-l-2 border-white/20 pl-3">
                    <a href="{{ route('admin.index') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.index') ? 'text-blue-400 bg-white/5' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <i class="fas fa-users w-4 text-xs"></i>
                        <span>All Admins</span>
                    </a>
                    <a href="{{ route('admin.create') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.create') ? 'text-blue-400 bg-white/5' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <i class="fas fa-user-plus w-4 text-xs"></i>
                        <span>Add Admin</span>
                    </a>
                </div>
            </li>
            @endrole

            <!-- LECTURERS DROPDOWN -->
            @role('super_admin|admin|registry')
            <li class="nav-item">
                <a @click.prevent="toggleMenu('lecturers')" 
                   class="nav-link flex items-center justify-between gap-3 px-3 py-2 rounded-lg cursor-pointer transition-all duration-200 text-gray-300 hover:bg-white/10 hover:text-white">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-chalkboard-teacher w-5"></i>
                        <span x-show="!collapsed" class="font-medium whitespace-nowrap">Lecturers</span>
                    </div>
                    <i x-show="!collapsed" class="fas fa-chevron-down transition-transform duration-200" 
                       :style="openMenus.lecturers ? 'transform: rotate(180deg);' : 'transform: rotate(0deg);'"></i>
                </a>

                <div x-show="openMenus.lecturers && !collapsed" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-cloak
                     class="mt-1 ml-8 space-y-1 border-l-2 border-white/20 pl-3">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5">
                        <i class="fas fa-users w-4 text-xs"></i>
                        <span>All Lecturers</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5">
                        <i class="fas fa-user-plus w-4 text-xs"></i>
                        <span>Add Lecturer</span>
                    </a>
                </div>
            </li>
            @endrole

            <!-- STUDENTS DROPDOWN -->
            @role('super_admin|admin|registry|lecturer')
            <li class="nav-item">
                <a @click.prevent="toggleMenu('students')" 
                   class="nav-link flex items-center justify-between gap-3 px-3 py-2 rounded-lg cursor-pointer transition-all duration-200 text-gray-300 hover:bg-white/10 hover:text-white">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-user-graduate w-5"></i>
                        <span x-show="!collapsed" class="font-medium whitespace-nowrap">Students</span>
                    </div>
                    <i x-show="!collapsed" class="fas fa-chevron-down transition-transform duration-200" 
                       :style="openMenus.students ? 'transform: rotate(180deg);' : 'transform: rotate(0deg);'"></i>
                </a>

                <div x-show="openMenus.students && !collapsed" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-cloak
                     class="mt-1 ml-8 space-y-1 border-l-2 border-white/20 pl-3">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5">
                        <i class="fas fa-users w-4 text-xs"></i>
                        <span>All Students</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5">
                        <i class="fas fa-user-plus w-4 text-xs"></i>
                        <span>Add Student</span>
                    </a>
                </div>
            </li>
            @endrole

            @role('super_admin|admin')
            <li class="nav-item">
                <a @click.prevent="toggleMenu('programs')" 
                   class="nav-link flex items-center justify-between gap-3 px-3 py-2 rounded-lg cursor-pointer transition-all duration-200 {{ request()->routeIs('admin.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-user-shield w-5"></i>
                        <span x-show="!collapsed" class="font-medium whitespace-nowrap">Programs</span>
                    </div>
                    <i x-show="!collapsed" class="fas fa-chevron-down transition-transform duration-200" 
                       :style="openMenus.programs ? 'transform: rotate(180deg);' : 'transform: rotate(0deg);'"></i>
                </a>

                <div x-show="openMenus.programs && !collapsed" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-cloak
                     class="mt-1 ml-8 space-y-1 border-l-2 border-white/20 pl-3">
                    <a href="{{ route('program.index') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('program.index') ? 'text-blue-400 bg-white/5' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <i class="fas fa-users w-4 text-xs"></i>
                        <span>All Programs</span>
                    </a>
                    <a href="{{ route('program.create') }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('program.create') ? 'text-blue-400 bg-white/5' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <i class="fas fa-user-plus w-4 text-xs"></i>
                        <span>Add Program</span>
                    </a>
                </div>
            </li>
            @endrole

            <!-- ACADEMICS DROPDOWN -->
            @role('super_admin|admin|lecturer')
            <li class="nav-item">
                <a @click.prevent="toggleMenu('academics')" 
                   class="nav-link flex items-center justify-between gap-3 px-3 py-2 rounded-lg cursor-pointer transition-all duration-200 text-gray-300 hover:bg-white/10 hover:text-white">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-book w-5"></i>
                        <span x-show="!collapsed" class="font-medium whitespace-nowrap">Academics</span>
                    </div>
                    <i x-show="!collapsed" class="fas fa-chevron-down transition-transform duration-200" 
                       :style="openMenus.academics ? 'transform: rotate(180deg);' : 'transform: rotate(0deg);'"></i>
                </a>

                <div x-show="openMenus.academics && !collapsed" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-cloak
                     class="mt-1 ml-8 space-y-1 border-l-2 border-white/20 pl-3">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5">
                        <i class="fas fa-graduation-cap w-4 text-xs"></i>
                        <span>Programs</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5">
                        <i class="fas fa-layer-group w-4 text-xs"></i>
                        <span>Courses</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5">
                        <i class="fas fa-list-ul w-4 text-xs"></i>
                        <span>Course Units</span>
                    </a>
                </div>
            </li>
            @endrole

            <!-- FINANCE DROPDOWN -->
            @role('super_admin|finance|admin')
            <li class="nav-item">
                <a @click.prevent="toggleMenu('finance')" 
                   class="nav-link flex items-center justify-between gap-3 px-3 py-2 rounded-lg cursor-pointer transition-all duration-200 text-gray-300 hover:bg-white/10 hover:text-white">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-coins w-5"></i>
                        <span x-show="!collapsed" class="font-medium whitespace-nowrap">Finance</span>
                    </div>
                    <i x-show="!collapsed" class="fas fa-chevron-down transition-transform duration-200" 
                       :style="openMenus.finance ? 'transform: rotate(180deg);' : 'transform: rotate(0deg);'"></i>
                </a>

                <div x-show="openMenus.finance && !collapsed" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-cloak
                     class="mt-1 ml-8 space-y-1 border-l-2 border-white/20 pl-3">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5">
                        <i class="fas fa-credit-card w-4 text-xs"></i>
                        <span>Payments</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5">
                        <i class="fas fa-chart-line w-4 text-xs"></i>
                        <span>Fee Structure</span>
                    </a>
                </div>
            </li>
            @endrole

            <!-- ROLES -->
            @role('super_admin')
            <li class="nav-item">
                <a href="#" class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-200 text-gray-300 hover:bg-white/10 hover:text-white">
                    <i class="fas fa-lock w-5"></i>
                    <span x-show="!collapsed" class="font-medium whitespace-nowrap">Roles & Permissions</span>
                </a>
            </li>
            @endrole

        </ul>
    </div>

    <style>
        [x-cloak] { display: none !important; }
        
        /* Custom scrollbar for sidebar menu */
        .overflow-y-auto::-webkit-scrollbar {
            width: 4px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }
        
        /* Custom scrollbar for main content */
        .overflow-y-auto:not(aside .overflow-y-auto)::-webkit-scrollbar {
            width: 8px;
        }
        
        .overflow-y-auto:not(aside .overflow-y-auto)::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .overflow-y-auto:not(aside .overflow-y-auto)::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        
        .overflow-y-auto:not(aside .overflow-y-auto)::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        .transition-all {
            transition: all 0.3s ease-in-out;
        }
        
        .bg-gradient-to-r {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }
        
        .hover\:bg-white\/10:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .border-l-2 {
            border-left-width: 2px;
        }
        
        .whitespace-nowrap {
            white-space: nowrap;
        }
    </style>
</aside>