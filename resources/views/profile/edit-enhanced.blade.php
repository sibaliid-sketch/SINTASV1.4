<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="font-semibold text-xl bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent leading-tight">
                {{ __('My Profile') }}
            </h2>
            <div class="flex items-center space-x-4">
                <div class="text-sm text-gray-500">
                    Last updated: {{ auth()->user()->updated_at->format('M d, Y') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profile Overview Card -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mr-6">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="w-20 h-20 rounded-2xl object-cover">
                            @else
                                <span class="text-2xl font-bold text-white">{{ auth()->user()->initials }}</span>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">{{ auth()->user()->name }}</h3>
                            <p class="text-gray-600">{{ auth()->user()->email }}</p>
                            <div class="flex items-center mt-2 space-x-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst(auth()->user()->role) }}
                                </span>
                                @if(auth()->user()->department)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    {{ auth()->user()->department }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Profile Completion Progress -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700">Profile Completion</span>
                            <span class="text-sm text-gray-500">{{ auth()->user()->profile_completion }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full transition-all duration-300" style="width: {{ auth()->user()->profile_completion }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Tabs -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button type="button" id="tab-profile" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-blue-500 text-blue-600" data-tab="profile">
                            Profile Information
                        </button>
                        <button type="button" id="tab-security" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="security">
                            Security & Password
                        </button>
                        <button type="button" id="tab-preferences" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="preferences">
                            Preferences
                        </button>
                        <button type="button" id="tab-google" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="google">
                            Google Account
                        </button>
                        <button type="button" id="tab-activity" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="activity">
                            Activity & Stats
                        </button>
                    </nav>
                </div>

                <div class="p-8">
                    <!-- Profile Information Tab -->
                    <div id="tab-content-profile" class="tab-content">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Profile Information</h3>
                        </div>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <!-- Security Tab -->
                    <div id="tab-content-security" class="tab-content hidden">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Password & Security</h3>
                        </div>
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Preferences Tab -->
                    <div id="tab-content-preferences" class="tab-content hidden">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
