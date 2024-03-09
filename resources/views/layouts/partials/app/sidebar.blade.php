@php
    $links = [
        // Home
        [
            'name' => 'Home',
            'icon' => 'fa-solid fa-house',
            'route' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
        ],
        // Appointments
        [
            'name' => 'Appointments',
            'icon' => 'fa-solid fa-calendar-check',
            'route' => route('appointments.index'),
            'active' => request()->routeIs('appointments.*'),
        ],
        // Doctors
        [
            'name' => 'Doctors',
            'icon' => 'fa-solid fa-stethoscope',
            'route' => '',
            'active' => '',
        ],
        // Patients
        [
            'name' => 'Patients',
            'icon' => 'fa-solid fa-users',
            'route' => '',
            'active' => '',
        ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-56 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-out': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
    }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    <a href="{{ $link['route'] }}"
                        class="flex items-center p-2 text-gray-900 dark:text-white rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 group {{ $link['active'] ? 'bg-gray-200 dark:bg-gray-600' : '' }}">
                        <span class="inline-flex w-8 h-8 justify-center items-center">
                            <i class="{{ $link['icon'] }} text-gray-900 dark:text-white"></i>
                        </span>
                        <span class="ml-2">
                            {{ $link['name'] }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
