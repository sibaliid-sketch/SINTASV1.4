<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Academic Offering') }}
            </h2>
            <a href="{{ route('admin.programs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                ← Back to Academic Offerings
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg border border-gray-200 sm:rounded-2xl">
                <div class="p-8">
                    <form method="POST" action="{{ route('admin.programs.update', $program) }}" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Type Selection -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                Offering Type
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                                    <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="program" {{ $program->type === 'program' ? 'selected' : '' }}>Program</option>
                                        <option value="service" {{ $program->type === 'service' ? 'selected' : '' }}>Service</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
