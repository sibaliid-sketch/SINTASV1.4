<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('departments.finance') }}" class="mr-4 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent leading-tight">
                {{ __('Finance Overview') }}
            </h2>
        </div>
    </x-slot>

    <!-- Tab Navigation -->
    <div class="bg-white/60 backdrop-blur-sm border-b border-gray-200/50 mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="{{ route('departments.finance') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Dashboard
                </a>
                <a href="{{ route('departments.overview.finance') }}" class="border-yellow-500 text-yellow-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" aria-current="page">
                    Overview
                </a>
            </nav>
        </div>
    </div>

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Performance Overview -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
</x-app-layout>
