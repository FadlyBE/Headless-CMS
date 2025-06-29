<x-app-layout>
    <x-layouts.admin>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Posts Card -->
                    <div class="bg-white shadow rounded-lg p-4">
                        <div class="text-sm font-medium text-gray-500">Posts</div>
                        <div class="text-2xl font-semibold text-gray-900">{{ $postCount }}</div>
                    </div>

                    <!-- Pages Card -->
                    <div class="bg-white shadow rounded-lg p-4">
                        <div class="text-sm font-medium text-gray-500">Pages</div>
                        <div class="text-2xl font-semibold text-gray-900">{{ $pageCount }}</div>
                    </div>

                    <!-- Categories Card -->
                    <div class="bg-white shadow rounded-lg p-4">
                        <div class="text-sm font-medium text-gray-500">Categories</div>
                        <div class="text-2xl font-semibold text-gray-900">{{ $categoryCount }}</div>
                    </div>

                </div>
            </div>
        </div>
    </x-layouts.admin>
</x-app-layout>
