<x-app-layout :breadcrumbs="[
    [
        'name' => 'Home',
    ],
]">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-xl p-6">
            <div class="flex items-center">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />
                <div class="ml-4 flex-1">
                    <h2 class="text-lg font-semibold">
                        {{ __('¡Welcome!') }} {{ Auth::user()->name }}.
                    </h2>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm hover:text-primary-500">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-xl p-6">
            <h2 class="text-xl font-semibold text-center">
                {{ config('app.name', 'Laravel') }}
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    {{ __('Medical appointment scheduling system') }}
                </p>
            </h2>
        </div>
    </div>

</x-app-layout>
