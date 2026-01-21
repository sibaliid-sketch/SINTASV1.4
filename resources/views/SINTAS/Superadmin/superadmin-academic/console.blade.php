<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Academic Dashboard Console') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <h3 class="ml-2 text-lg font-medium text-gray-900">
                            Academic Overview & Analytics
                        </h3>
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Services Card -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-500 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Services</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_services'] }}</p>
                                    <p class="text-sm text-green-600">{{ $stats['active_services'] }} active</p>
                                </div>
                            </div>
                        </div>

                        <!-- Programs Card -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-500 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Programs</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_programs'] }}</p>
                                    <p class="text-sm text-green-600">{{ $stats['active_programs'] }} active</p>
                                </div>
                            </div>
                        </div>

                        <!-- Registrations Card -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center">
                                <div class="p-2 bg-purple-500 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Registrations</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_registrations'] }}</p>
                                    <p class="text-sm text-yellow-600">{{ $stats['pending_registrations'] }} pending</p>
                                </div>
                            </div>
                        </div>

                        <!-- Schedules Card -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center">
                                <div class="p-2 bg-orange-500 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Schedules</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_schedules'] }}</p>
                                    <p class="text-sm text-green-600">{{ $stats['active_schedules'] }} active</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Programs by Education Level -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Programs by Education Level</h4>
                            <div class="space-y-3">
                                @foreach($programsByLevel as $level => $count)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">{{ $level }}</span>
                                    <div class="flex items-center">
                                        <div class="w-24 bg-gray-200 rounded-full h-2 mr-2">
                                            <div class="bg-blue-500 h-2 rounded-full"
                                                 style="width: {{ ($count / $stats['total_programs']) * 100 }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600">{{ $count }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Programs by Service -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Programs by Service</h4>
                            <div class="space-y-3">
                                @foreach($programsByService as $service => $count)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">{{ $service }}</span>
                                    <div class="flex items-center">
                                        <div class="w-24 bg-gray-200 rounded-full h-2 mr-2">
                                            <div class="bg-green-500 h-2 rounded-full"
                                                 style="width: {{ ($count / $stats['total_programs']) * 100 }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600">{{ $count }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Profit Analysis & Recent Activity -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Profit Margin Analysis -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Profit Margin Analysis</h4>
                            @if($profitAnalysis)
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-green-600">
                                            {{ number_format($profitAnalysis->avg_margin, 1) }}%
                                        </p>
                                        <p class="text-sm text-gray-600">Average Margin</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-blue-600">
                                            {{ $profitAnalysis->total_programs }}
                                        </p>
                                        <p class="text-sm text-gray-600">Total Programs</p>
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-gray-200">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Min Margin:</span>
                                        <span class="font-medium {{ $profitAnalysis->min_margin >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($profitAnalysis->min_margin, 1) }}%
                                        </span>
                                    </div>
                                    <div class="flex justify-between text-sm mt-1">
                                        <span class="text-gray-600">Max Margin:</span>
                                        <span class="font-medium text-green-600">
                                            {{ number_format($profitAnalysis->max_margin, 1) }}%
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @else
                            <p class="text-gray-500">No profit data available</p>
                            @endif
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h4>
                            <div class="space-y-3">
                                <a href="{{ route('admin.programs.index') }}"
                                   class="block w-full bg-green-500 hover:bg-green-600 text-white text-center py-2 px-4 rounded-lg transition-colors">
                                    Manage Academic Offerings
                                </a>
                                <a href="{{ route('admin.schedules.index') }}"
                                   class="block w-full bg-orange-500 hover:bg-orange-600 text-white text-center py-2 px-4 rounded-lg transition-colors">
                                    Manage Schedules
                                </a>
                                <a href="{{ route('departments.academic') }}"
                                   class="block w-full bg-purple-500 hover:bg-purple-600 text-white text-center py-2 px-4 rounded-lg transition-colors">
                                    Academic Department
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Programs & Registrations -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Recent Programs -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Recent Programs</h4>
                            <div class="space-y-3">
                                @forelse($recentPrograms as $program)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                            {{ substr($program->name, 0, 2) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $program->name }}</p>
                                            <p class="text-xs text-gray-600">{{ $program->service->name }} • {{ $program->education_level }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-green-600">{{ $program->formatted_price }}</span>
                                </div>
                                @empty
                                <p class="text-gray-500 text-center py-4">No recent programs</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Recent Registrations -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Recent Registrations</h4>
                            <div class="space-y-3">
                                @forelse($recentRegistrations as $registration)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                            {{ substr($registration->user->name ?? 'U', 0, 2) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $registration->user->name ?? 'Unknown User' }}</p>
                                            <p class="text-xs text-gray-600">
                                                {{ $registration->program->name ?? 'Unknown Program' }}
                                                @if($registration->program && $registration->program->service)
                                                • {{ $registration->program->service->name }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $registration->status === 'confirmed' ? 'bg-green-100 text-green-800' :
                                           ($registration->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($registration->status) }}
                                    </span>
                                </div>
                                @empty
                                <p class="text-gray-500 text-center py-4">No recent registrations</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
