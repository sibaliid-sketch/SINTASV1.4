<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-orange-600 to-yellow-600 bg-clip-text text-transparent leading-tight">
            {{ __('SINTAS - General (Finance)') }}
        </h2>
    </x-slot>

    @auth
    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin' || auth()->user()->role === 'employee' || auth()->user()->role === 'admin_operational' || (auth()->user()->role === 'karyawan' && auth()->user()->department === 'finance'))

    <!-- Include Department Sidebar -->
    @include('SINTAS.finance.finance-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs Navigation -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button onclick="showTab('overview')" class="tab-button active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-orange-500 text-orange-600">
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
                    <!-- Overview Tab -->
                    <div id="overview-tab" class="tab-content">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-2xl flex items-center justify-center mr-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Finance Department Overview</h3>
                                <p class="text-gray-600">Comprehensive overview of financial operations and management.</p>
                            </div>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            The Finance Department manages all financial aspects of the organization, including budgeting, reporting, payments, and financial planning to ensure fiscal responsibility and growth.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-xl border border-orange-200">
                                <h4 class="text-lg font-semibold text-orange-900 mb-2">Mission</h4>
                                <p class="text-orange-700">To provide accurate financial management and strategic insights that support organizational growth.</p>
                            </div>
                            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-xl border border-yellow-200">
                                <h4 class="text-lg font-semibold text-yellow-900 mb-2">Vision</h4>
                                <p class="text-yellow-700">To be the financial backbone ensuring stability and enabling strategic investments.</p>
                            </div>
                            <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-xl border border-amber-200">
                                <h4 class="text-lg font-semibold text-amber-900 mb-2">Goals</h4>
                                <p class="text-amber-700">Maintain financial health, optimize costs, and provide accurate financial reporting.</p>
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
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Finance-Specific Metrics</h4>
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
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Finance Team</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">FC</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Finance Controller</h4>
                                        <p class="text-sm text-gray-600">Department Head</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Leads financial operations and oversees budgeting and reporting.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-amber-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">AA</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Accounting Analyst</h4>
                                        <p class="text-sm text-gray-600">Financial Reporting</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Handles financial reporting, analysis, and compliance.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">BP</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Budget Planner</h4>
                                        <p class="text-sm text-gray-600">Budget Management</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Manages budgeting, forecasting, and financial planning.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">PA</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Payment Administrator</h4>
                                        <p class="text-sm text-gray-600">Payments & Receivables</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Manages payments, receivables, and financial transactions.</p>
                            </div>
                        </div>
                        <div class="mt-6 bg-gradient-to-r from-orange-50 to-yellow-50 p-6 rounded-xl border border-orange-200">
                            <h4 class="text-lg font-semibold text-orange-900 mb-2">Team Size</h4>
                            <p class="text-orange-700">Total team members: <span class="font-bold">{{ $metrics['team_members'] }}</span></p>
                        </div>
                    </div>

                    <!-- Resources Tab -->
                    <div id="resources-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Finance Resources</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Documentation</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Financial Policies</li>
                                    <li>• Accounting Standards</li>
                                    <li>• Budget Guidelines</li>
                                    <li>• Compliance Procedures</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Tools & Systems</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Accounting Software</li>
                                    <li>• Budgeting Tools</li>
                                    <li>• Financial Reporting Systems</li>
                                    <li>• Payment Processing Platforms</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Training Materials</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Financial Analysis Training</li>
                                    <li>• Accounting Certification</li>
                                    <li>• Budget Management</li>
                                    <li>• Compliance Training</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Finance Controller: controller.finance@company.com</li>
                                    <li>• Accounting Team: accounting@company.com</li>
                                    <li>• Budget Office: budget@company.com</li>
                                    <li>• Support Hours: 8:00 AM - 5:00 PM</li>
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
                button.classList.remove('active', 'border-orange-500', 'text-orange-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById(tabName + '-tab').classList.remove('hidden');

            // Add active class to clicked button
            event.target.classList.add('active', 'border-orange-500', 'text-orange-600');
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
