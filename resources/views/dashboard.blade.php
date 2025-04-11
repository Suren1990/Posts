<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <div class="bg-indigo-500 text-white p-4 rounded-lg mb-6 shadow-md">
                        <h3 class="text-lg font-semibold">{{ __("You're logged in!") }}</h3>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Welcome back {{ Auth::user()->name }} to your dashboard. You can access all your data and settings from here.</p>
                    <div class="mt-8">
                        <a href="#" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-indigo-700 transition duration-200 ease-in-out">
                            Go to Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

