<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent leading-tight">
            {{ __('SINTAS - General (IT)') }}
        </h2>
    </x-slot>

    <!-- Include Department Sidebar -->
    @include('SINTAS.it.it-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs Navigation -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
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
                    <!-- Overview Tab -->
                    <div id="overview-tab" class="tab-content">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-2xl flex items-center justify-center mr-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2">IT Department Overview</h3>
                                <p class="text-gray-600">Comprehensive overview of IT operations and infrastructure.</p>
                            </div>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            The IT Department manages all aspects of the company's technology infrastructure, including system development, infrastructure maintenance, data security, and technical support for all users.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-6 rounded-xl border border-indigo-200">
                                <h4 class="text-lg font-semibold text-indigo-900 mb-2">Mission</h4>
                                <p class="text-indigo-700">To provide reliable, secure, and innovative technology solutions that support business objectives.</p>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200">
                                <h4 class="text-lg font-semibold text-blue-900 mb-2">Vision</h4>
                                <p class="text-blue-700">To be the leading technology partner in driving digital transformation.</p>
                            </div>
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200">
                                <h4 class="text-lg font-semibold text-purple-900 mb-2">Goals</h4>
                                <p class="text-purple-700">Achieve 99.9% uptime, implement cutting-edge technologies, and ensure data security.</p>
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
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">IT-Specific Metrics</h4>
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
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">IT Team</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">IT</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">IT Manager</h4>
                                        <p class="text-sm text-gray-600">Department Head</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Leads the IT department and oversees all technology initiatives.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">SA</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">System Administrator</h4>
                                        <p class="text-sm text-gray-600">Infrastructure</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Manages servers, networks, and system infrastructure.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">SD</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Software Developer</h4>
                                        <p class="text-sm text-gray-600">Development</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Develops and maintains software applications.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">TS</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Technical Support</h4>
                                        <p class="text-sm text-gray-600">Support</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Provides technical assistance to users and departments.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">SC</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Security Consultant</h4>
                                        <p class="text-sm text-gray-600">Security</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Ensures data security and compliance with regulations.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">NA</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Network Administrator</h4>
                                        <p class="text-sm text-gray-600">Networking</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Manages network infrastructure and connectivity.</p>
                            </div>
                        </div>
                        <div class="mt-6 bg-gradient-to-r from-indigo-50 to-blue-50 p-6 rounded-xl border border-indigo-200">
                            <h4 class="text-lg font-semibold text-indigo-900 mb-2">Team Size</h4>
                            <p class="text-indigo-700">Total team members: <span class="font-bold">{{ $metrics['team_members'] }}</span></p>
                        </div>
                    </div>

                    <!-- Resources Tab -->
                    <div id="resources-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">IT Resources</h3>
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
                                    <li>• IT Security Training</li>
                                    <li>• System Administration</li>
                                    <li>• Software Development</li>
                                    <li>• Technical Support</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Help Desk: help@company.com</li>
                                    <li>• Emergency: emergency@company.com</li>
                                    <li>• IT Manager: manager.it@company.com</li>
                                    <li>• Support Hours: 24/7</li>
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
</x-app-layout>
