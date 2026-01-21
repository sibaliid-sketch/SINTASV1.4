<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent leading-tight">
            {{ __('Engagement & Retention Overview') }}
        </h2>
    </x-slot>

    <!-- Include Department Sidebar -->
    @include('SINTAS.engagement-retention.engagement_retention-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Performance Overview -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Engagement & Retention Department Overview</h3>
                            <p class="text-gray-600">Comprehensive metrics and measurements for the Engagement & Retention department.</p>
                        </div>
                    </div>

                    <!-- Metrics Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-green-600">Tasks Completed</p>
                                    <p class="text-2xl font-bold text-green-900">{{ $metrics['tasks_completed'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-xl p-6 border border-yellow-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-yellow-600">Tasks Pending</p>
                                    <p class="text-2xl font-bold text-yellow-900">{{ $metrics['tasks_pending'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-red-50 to-red-100 rounded-xl p-6 border border-red-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-red-600">Tasks Overdue</p>
                                    <p class="text-2xl font-bold text-red-900">{{ $metrics['tasks_overdue'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-blue-600">Performance Score</p>
                                    <p class="text-2xl font-bold text-blue-900">{{ $metrics['performance_score'] }}%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Members -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Team Overview</h3>
                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-purple-600">Team Members</p>
                                <p class="text-2xl font-bold text-purple-900">{{ $metrics['team_members'] }}</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Department Specific Metrics -->
            @if(!empty($metrics['department_specific']))
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Department Specific Metrics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($metrics['department_specific'] as $key => $value)
                        <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-xl p-6 border border-indigo-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-indigo-600">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
                                    <p class="text-2xl font-bold text-indigo-900">{{ $value }}</p>
                                </div>
                                <div class="w-12 h-12 bg-indigo-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Performance Chart Placeholder -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50">
                <div class="p-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Performance Trends</h3>
                    <div class="bg-gray-50 rounded-xl p-8 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="text-gray-500">Interactive performance chart will be displayed here</p>
                        <p class="text-sm text-gray-400 mt-2">Chart visualization showing department task completion trends over time</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
