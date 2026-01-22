<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent leading-tight">
            {{ __('SINTAS - General (HR)') }}
        </h2>
    </x-slot>
    @auth
    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin' || auth()->user()->role === 'employee' || auth()->user()->role === 'admin_operational' || (auth()->user()->role === 'karyawan' && auth()->user()->department === 'hr'))
    <!-- Include Department Sidebar -->
    @include('SINTAS.' . $dept . '.' . $dept . '-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs Navigation -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button onclick="showTab('dashboard')" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Dashboard
                        </button>
                        <button onclick="showTab('overview')" class="tab-button active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-indigo-500 text-indigo-600">
                            Overview
                        </button>
                        <button onclick="showTab('metrics')" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Metrics
                        </button>
                        <button onclick="showTab('team')" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Team
                        </button>
                        <button onclick="showTab('resources')" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Resources
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Dashboard Tab -->
                    <div id="dashboard-tab" class="tab-content hidden">
                        <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                            <div class="p-8">
                                <div class="flex items-center mb-6">
                                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-2xl flex items-center justify-center mr-6">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Selamat Datang di SINTAS (HR)</h3>
                                        <p class="text-gray-600">Kelola sumber daya manusia, rekrutmen, dan pengembangan karyawan.</p>
                                    </div>
                                </div>
                                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                                    Departemen HR bertanggung jawab atas semua aspek sumber daya manusia perusahaan, termasuk rekrutmen, pengembangan karyawan, manajemen kinerja, dan administrasi kepegawaian.
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                                <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">System Administration</h4>
                                <p class="text-gray-600 mb-4">Kelola server, database, dan infrastruktur sistem perusahaan.</p>
                                <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium">System Admin →</a>
                            </div>

                            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Security & Compliance</h4>
                                <p class="text-gray-600 mb-4">Pastikan keamanan data dan kepatuhan terhadap regulasi privasi.</p>
                                <a href="#" class="text-green-600 hover:text-green-700 font-medium">Security Check →</a>
                            </div>

                            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Technical Support</h4>
                                <p class="text-gray-600 mb-4">Berikan dukungan teknis untuk semua pengguna dan departemen.</p>
                                <a href="#" class="text-orange-600 hover:text-orange-700 font-medium">Support Center →</a>
                            </div>

                            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Network Administration</h4>
                                <p class="text-gray-600 mb-4">Kelola jaringan dan konektivitas infrastruktur.</p>
                                <a href="#" class="text-purple-600 hover:text-purple-700 font-medium">Network Admin →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Overview Tab -->
                    <div id="overview-tab" class="tab-content">
                        <!-- Performance Overview -->
                        <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                            <div class="p-8">
                                <div class="flex items-center mb-6">
                                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-2xl flex items-center justify-center mr-6">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">HR Department Overview</h3>
                                        <p class="text-gray-600">Comprehensive metrics and measurements for the HR department.</p>
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
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
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
                                <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-xl p-6 border border-indigo-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-indigo-600">Team Members</p>
                                            <p class="text-2xl font-bold text-indigo-900">{{ $metrics['team_members'] }}</p>
                                        </div>
                                        <div class="w-12 h-12 bg-indigo-500 rounded-lg flex items-center justify-center">
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

                    <!-- Metrics Tab -->
                    <div id="metrics-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Department Metrics</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-blue-600 text-sm font-medium">Tasks Completed</p>
                                        <p class="text-2xl font-bold text-blue-800">{{ $metrics['tasks_completed'] }}</p>
                                    </div>
                                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-xl border border-yellow-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-yellow-600 text-sm font-medium">Tasks Pending</p>
                                        <p class="text-2xl font-bold text-yellow-800">{{ $metrics['tasks_pending'] }}</p>
                                    </div>
                                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl border border-red-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-red-600 text-sm font-medium">Tasks Overdue</p>
                                        <p class="text-2xl font-bold text-red-800">{{ $metrics['tasks_overdue'] }}</p>
                                    </div>
                                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-green-600 text-sm font-medium">Performance Score</p>
                                        <p class="text-2xl font-bold text-green-800">{{ $metrics['performance_score'] }}%</p>
                                    </div>
                                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @if(!empty($metrics['department_specific']))
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 rounded-xl border border-gray-200">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">HR-Specific Metrics</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($metrics['department_specific'] as $key => $value)
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}</span>
                                    <span class="font-semibold text-gray-900">{{ $value }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Team Tab -->
                    <div id="team-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">HR Team</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">HR</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">HR Manager</h4>
                                        <p class="text-sm text-gray-600">Department Head</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Leads the HR department and oversees all human resources initiatives.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">HS</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">HR Specialist</h4>
                                        <p class="text-sm text-gray-600">Employee Relations</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Handles employee relations, conflict resolution, and workplace policies.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">RC</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Recruiter</h4>
                                        <p class="text-sm text-gray-600">Talent Acquisition</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Manages recruitment processes and candidate sourcing.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">PO</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Payroll Officer</h4>
                                        <p class="text-sm text-gray-600">Compensation</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Manages employee compensation, benefits, and payroll processing.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">TC</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Training Coordinator</h4>
                                        <p class="text-sm text-gray-600">Learning & Development</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Organizes training programs and employee development initiatives.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">HA</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">HR Administrator</h4>
                                        <p class="text-sm text-gray-600">Administrative Support</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Handles administrative tasks, record-keeping, and HR documentation.</p>
                            </div>
                        </div>
                        <div class="mt-6 bg-gradient-to-r from-indigo-50 to-blue-50 p-6 rounded-xl border border-indigo-200">
                            <h4 class="text-lg font-semibold text-indigo-900 mb-2">Team Size</h4>
                            <p class="text-indigo-700">Total team members: <span class="font-bold">{{ $metrics['team_members'] }}</span></p>
                        </div>
                    </div>

                    <!-- Resources Tab -->
                    <div id="resources-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">{{ ucfirst($dept) }} Resources</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Documentation</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• System Architecture Guide</li>
                                    <li>• Security Policies</li>
                                    <li>• User Manuals</li>
                                    <li>• API Documentation</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Tools & Software</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Development Environments</li>
                                    <li>• Monitoring Tools</li>
                                    <li>• Backup Systems</li>
                                    <li>• Collaboration Platforms</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Training Materials</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• HR Compliance Training</li>
                                    <li>• Employee Relations</li>
                                    <li>• Recruitment Best Practices</li>
                                    <li>• Performance Management</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• HR Help Desk: hr.help@company.com</li>
                                    <li>• Emergency: emergency@company.com</li>
                                    <li>• HR Manager: manager.hr@company.com</li>
                                    <li>• Support Hours: 9 AM - 5 PM</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.classList.add('hidden'));

            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach(button => {
                button.classList.remove('active', 'border-indigo-500', 'text-indigo-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById(tabName + '-tab').classList.remove('hidden');

            // Add active class to clicked button
            event.target.classList.add('active', 'border-indigo-500', 'text-indigo-600');
            event.target.classList.remove('border-transparent', 'text-gray-500');
        }
    </script>

    @else
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-center py-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Access Denied</h2>
                    <p class="text-gray-600 mb-6">You don't have permission to access this page.</p>
                </div>
            </div>
        </div>
    @endif
    @else
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-center py-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Please Login</h2>
                    <p class="text-gray-600 mb-6">You must be logged in to access this page.</p>
                </div>
            </div>
        </div>
    @endauth
</x-app-layout>
