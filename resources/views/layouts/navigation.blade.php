<style type="text/css">
    .ring-1{
        width: 14rem;
    }

    </style>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                @auth
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('employee.myProfile',\App\Http\Helpers\RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id()))" :active="request()->routeIs('employee.myProfile',\App\Http\Helpers\RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id()))">
                        {{ __('My Profile') }}
                    </x-nav-link>
                    <x-nav-link :href="route('employee.index')" :active="request()->routeIs('employee.index')">
                        {{ __('Employees') }}
                    </x-nav-link>
{{--                    <x-nav-link :href="route('employee.myAttendance',\App\Http\Helpers\RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id()))" :active="request()->routeIs('employee.myAttendance',\App\Http\Helpers\RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id()))">--}}
{{--                        {{ __('Attendance') }}--}}
{{--                    </x-nav-link>--}}
{{--                    <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">--}}
{{--                        {{ __('User') }}--}}
{{--                    </x-nav-link>--}}
{{--                    <x-nav-link :href="route('monthly_attendence.index')" :active="request()->routeIs('monthly_attendence.index')">--}}
{{--                        {{ __('Attendance Management') }}--}}
{{--                    </x-nav-link>--}}

{{--                    <x-nav-link :href="route('attendanceAdjustmentTab')" :active="request()->routeIs('attendanceAdjustmentTab')">--}}
{{--                        {{ __('Attendance Adjustment') }}--}}
{{--                    </x-nav-link>--}}

                </div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="left">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <p>Attendance</p>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <x-dropdown-link style="text-decoration: none; color: inherit" :href="route('employee.myAttendance',\App\Http\Helpers\RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id()))" :active="request()->routeIs('employee.myAttendance',\App\Http\Helpers\RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id()))">
                                    {{ __('My Attendance') }}
                                </x-dropdown-link>
                                @if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == 'admin')
                                    <x-dropdown-link style="text-decoration: none; color: inherit" :href="route('monthly_attendence.index')" :active="request()->routeIs('monthly_attendence.index')">
                                        {{ __('Attendance Management') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link style="text-decoration: none ;color: inherit" :href="route('attendanceAdjustmentTab')" :active="request()->routeIs('attendanceAdjustmentTab')">
                                        {{ __('Attendance Adjustment') }}
                                    </x-dropdown-link>
                                @endif

                            </x-slot>
                        </x-dropdown>
                    </div>

{{--                    @if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == 'admin')--}}

{{--                    <div class="hidden sm:flex sm:items-center sm:ml-6">--}}
{{--                        <x-dropdown align="left">--}}
{{--                            <x-slot name="trigger">--}}
{{--                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">--}}
{{--                                    <p>Holiday</p>--}}
{{--                                    <div class="ml-1">--}}
{{--                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
{{--                                </button>--}}
{{--                            </x-slot>--}}

{{--                            <x-slot name="content">--}}

{{--                                <x-dropdown-link style="text-decoration: none; color: inherit" :href="route('holiday.fixedWeeklyHoliday',\App\Http\Helpers\RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id()))" :active="request()->routeIs('holiday.fixedWeeklyHoliday',\App\Http\Helpers\RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id()))">--}}
{{--                                    {{ __('Manage Weekend') }}--}}
{{--                                </x-dropdown-link>--}}
{{--                                <x-dropdown-link style="text-decoration: none; color: inherit" :href="route('monthly_attendence.index')" :active="request()->routeIs('monthly_attendence.index')">--}}
{{--                                    {{ __('Manage Govt Holidays') }}--}}
{{--                                </x-dropdown-link>--}}

{{--                                <x-dropdown-link style="text-decoration: none ;color: inherit" :href="route('holiday.ownOfficeHoliday')" :active="request()->routeIs('holiday.ownOfficeHoliday')">--}}
{{--                                    {{ __('Manage Office Holidays') }}--}}
{{--                                </x-dropdown-link>--}}
{{--                            </x-slot>--}}
{{--                        </x-dropdown>--}}
{{--                    </div>--}}
{{--                    @endif--}}
                    <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
                        <x-nav-link :href="route('holiday.view')" :active="request()->routeIs('holiday.view')">
                            {{ __('Holiday') }}
                        </x-nav-link>
                    </div>
                    @if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == 'admin')
                        <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
                            <x-nav-link :href="route('report.index')" :active="request()->routeIs('report.index')">
                                {{ __('Report') }}
                            </x-nav-link>
                        </div>
                    @endif
                @endauth
            </div>

            @auth
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            @php
                                    $userImage = \App\Http\Helpers\RoleCheck::getLoggedInUserProfileImage(auth()->id());
                            @endphp
                            <span class="mr-2"><img src="{{asset('storage/'.$userImage)}}" alt="Avatar" style="width:45px;height:45px;border-radius: 50%;"></span><div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log out') }}
                            </x-dropdown-link>
                        </form>
                        <x-dropdown-link :href="route('user.edit', auth()->id())">
                            {{ __('Change Password') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>



            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            @endauth
        </div>
    </div>
    @auth
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
    @endauth
</nav>
