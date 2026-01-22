<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent leading-tight">
            {{ __('SINTAS - General (Sales & Marketing)') }}
        </h2>
    </x-slot>
    @auth
    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin' || auth()->user()->role === 'employee' || auth()->user()->role === 'admin_operational' || (auth()->user()->role === 'karyawan' && auth()->user()->department === 'sales-marketing'))
    <!-- Include Department Sidebar -->
    @include('SINTAS.sales-marketing.sales_marketing-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs Navigation -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button onclick="showTab('overview')" class="tab-button active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-green-500 text-green-600">
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
                            <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mr-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Sales & Marketing Department Overview</h3>
                                <p class="text-gray-600">Comprehensive overview of sales and marketing operations.</p>
                            </div>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            The Sales & Marketing Department drives business growth through strategic marketing campaigns, lead generation, customer acquisition, and market analysis to achieve revenue targets and expand market presence.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200">
                                <h4 class="text-lg font-semibold text-green-900 mb-2">Mission</h4>
                                <p class="text-green-700">To drive revenue growth and market expansion through innovative marketing strategies and exceptional customer experiences.</p>
                            </div>
                            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 p-6 rounded-xl border border-emerald-200">
                                <h4 class="text-lg font-semibold text-emerald-900 mb-2">Vision</h4>
                                <p class="text-emerald-700">To be the leading sales and marketing force in the industry, setting standards for customer engagement.</p>
                            </div>
                            <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-6 rounded-xl border border-teal-200">
                                <h4 class="text-lg font-semibold text-teal-900 mb-2">Goals</h4>
                                <p class="text-teal-700">Achieve sales targets, increase market share, and build strong brand loyalty.</p>
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
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Sales & Marketing-Specific Metrics</h4>
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
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Sales & Marketing Team</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">SM</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Sales Manager</h4>
                                        <p class="text-sm text-gray-600">Department Head</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Leads the sales team and oversees revenue generation strategies.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">MR</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Marketing Manager</h4>
                                        <p class="text-sm text-gray-600">Marketing Strategy</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Develops marketing strategies and manages brand campaigns.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">SA</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Sales Associate</h4>
                                        <p class="text-sm text-gray-600">Direct Sales</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Handles direct sales activities and customer relationship management.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">CM</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Content Marketer</h4>
                                        <p class="text-sm text-gray-600">Content Creation</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Creates engaging content for marketing campaigns and brand awareness.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">DA</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Digital Analyst</h4>
                                        <p class="text-sm text-gray-600">Analytics & Insights</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Analyzes marketing performance and provides data-driven insights.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">LE</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Lead Generator</h4>
                                        <p class="text-sm text-gray-600">Lead Generation</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Generates and qualifies leads for the sales team.</p>
                            </div>
                        </div>
                        <div class="mt-6 bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl border border-green-200">
                            <h4 class="text-lg font-semibold text-green-900 mb-2">Team Size</h4>
                            <p class="text-green-700">Total team members: <span class="font-bold">{{ $metrics['team_members'] }}</span></p>
                        </div>
                    </div>

                    <!-- Resources Tab -->
                    <div id="resources-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Sales & Marketing Resources</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Documentation</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Sales Playbook</li>
                                    <li>• Marketing Strategy Guide</li>
                                    <li>• Campaign Templates</li>
                                    <li>• Customer Journey Maps</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Tools & Platforms</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• CRM System</li>
                                    <li>• Marketing Automation</li>
                                    <li>• Analytics Platforms</li>
                                    <li>• Social Media Tools</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Training Materials</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Sales Training</li>
                                    <li>• Marketing Certification</li>
                                    <li>• Product Knowledge</li>
                                    <li>• Communication Skills</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Sales Manager: manager.sales@company.com</li>
                                    <li>• Marketing Team: marketing@company.com</li>
                                    <li>• Customer Support: support@company.com</li>
                                    <li>• Business Hours: 8:00 AM - 6:00 PM</li>
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
                button.classList.remove('active', 'border-green-500', 'text-green-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById(tabName + '-tab').classList.remove('hidden');

            // Add active class to clicked button
            event.target.classList.add('active', 'border-green-500', 'text-green-600');
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
