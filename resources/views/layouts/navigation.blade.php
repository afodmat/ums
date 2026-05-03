<nav x-data="{ open: false, showNotifications: false }" class="bg-gradient-to-r from-indigo-600 to-purple-600 border-b border-indigo-500 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                        <span class="text-white font-bold text-xl hidden md:block">UMS</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-indigo-100 hover:text-white">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <!-- Dynamic nav items based on role -->
                    @role('super_admin|admin')
                    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')" class="text-indigo-100 hover:text-white">
                        {{ __('Management') }}
                    </x-nav-link>
                    @endrole
                    
                    @role('lecturer')
                    <x-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.*')" class="text-indigo-100 hover:text-white">
                        {{ __('My Courses') }}
                    </x-nav-link>
                    @endrole
                    
                    @role('student')
                    <x-nav-link :href="route('my-courses')" :active="request()->routeIs('my-courses')" class="text-indigo-100 hover:text-white">
                        {{ __('My Courses') }}
                    </x-nav-link>
                    @endrole
                </div>
            </div>

            <!-- Right side: Notifications, User Menu -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <!-- Notifications Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative text-indigo-100 hover:text-white transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5 min-w-[18px] text-center">
                            3
                        </span>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" x-cloak
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50 border border-gray-200">
                        <div class="p-3 border-b border-gray-200">
                            <h3 class="font-semibold text-gray-800">Notifications</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <a href="#" class="block p-3 hover:bg-gray-50 transition-colors border-b border-gray-100">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-user-plus text-blue-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm text-gray-800">New student registered</p>
                                        <p class="text-xs text-gray-500">5 minutes ago</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block p-3 hover:bg-gray-50 transition-colors border-b border-gray-100">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-file-alt text-green-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm text-gray-800">Assignment submitted</p>
                                        <p class="text-xs text-gray-500">1 hour ago</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="block p-3 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-calendar text-purple-500 mt-1"></i>
                                    <div>
                                        <p class="text-sm text-gray-800">Upcoming exam tomorrow</p>
                                        <p class="text-xs text-gray-500">3 hours ago</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 border-t border-gray-200">
                            <a href="#" class="block text-center text-sm text-indigo-600 hover:text-indigo-800 py-1">
                                View all notifications
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 px-3 py-2 rounded-md text-white bg-indigo-700 hover:bg-indigo-600 transition-all">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold">
                                        {{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}
                                    </span>
                                </div>
                                <div class="hidden md:block text-left">
                                    <div class="text-sm font-medium">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                                    <div class="text-xs text-indigo-200">
                                        @role('super_admin') Super Admin @endrole
                                        @role('admin') Admin @endrole
                                        @role('lecturer') Lecturer @endrole
                                        @role('student') Student @endrole
                                        @role('registry') Registry @endrole
                                        @role('finance') Finance @endrole
                                    </div>
                                </div>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-200 md:hidden">
                            <div class="font-medium text-gray-800">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            <div class="text-xs text-indigo-600 mt-1">
                                @role('super_admin') Super Admin @endrole
                                @role('admin') Admin @endrole
                                @role('lecturer') Lecturer @endrole
                                @role('student') Student @endrole
                            </div>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                            <i class="fas fa-user-circle w-4"></i>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        
                        <x-dropdown-link :href="route('admin.index')" class="flex items-center gap-2">
                            <i class="fas fa-cog w-4"></i>
                            {{ __('Settings') }}
                        </x-dropdown-link>
                        
                        @role('super_admin|admin')
                        <x-dropdown-link :href="route('admin.index')" class="flex items-center gap-2">
                            <i class="fas fa-shield-alt w-4"></i>
                            {{ __('System Settings') }}
                        </x-dropdown-link>
                        @endrole
                        
                        <div class="border-t border-gray-200 mt-2 pt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex items-center gap-2 text-red-600">
                                    <i class="fas fa-sign-out-alt w-4"></i>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-indigo-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-indigo-100 hover:text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            @role('super_admin|admin')
            <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')" class="text-indigo-100 hover:text-white">
                {{ __('Management') }}
            </x-responsive-nav-link>
            @endrole
            
            @role('lecturer')
            <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('courses.*')" class="text-indigo-100 hover:text-white">
                {{ __('My Courses') }}
            </x-responsive-nav-link>
            @endrole
            
            @role('student')
            <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('my-courses')" class="text-indigo-100 hover:text-white">
                {{ __('My Courses') }}
            </x-responsive-nav-link>
            @endrole
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-indigo-500">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                <div class="font-medium text-sm text-indigo-200">{{ Auth::user()->email }}</div>
                <div class="text-xs text-indigo-300 mt-1">
                    @role('super_admin') Super Admin @endrole
                    @role('admin') Admin @endrole
                    @role('lecturer') Lecturer @endrole
                    @role('student') Student @endrole
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.index')" class="text-indigo-100 hover:text-white">
                    <i class="fas fa-user-circle mr-2"></i>
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="route('admin.index')" class="text-indigo-100 hover:text-white">
                    <i class="fas fa-cog mr-2"></i>
                    {{ __('Settings') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-red-300 hover:text-red-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Add Font Awesome if not already added -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    [x-cloak] { display: none !important; }
    
    /* Custom animations */
    .transition-all {
        transition: all 0.2s ease-in-out;
    }
    
    /* Notification badge pulse animation */
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    .absolute .bg-red-500 {
        animation: pulse 2s infinite;
    }
</style>