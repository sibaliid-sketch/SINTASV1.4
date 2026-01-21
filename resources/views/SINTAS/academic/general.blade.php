<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent leading-tight">
            {{ __('SINTAS - General (Academic)') }}
        </h2>
    </x-slot>

    <!-- Include Department Sidebar -->
    @include('SINTAS.academic.academic-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs Navigation -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button onclick="showTab('overview')" class="tab-button active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-teal-500 text-teal-600">
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
                            <div class="w-16 h-16 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center mr-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Academic Department Overview</h3>
                                <p class="text-gray-600">Comprehensive overview of academic programs and educational services.</p>
                            </div>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            The Academic Department manages all educational programs, curriculum development, student services, and academic standards across the organization.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-6 rounded-xl border border-teal-200">
                                <h4 class="text-lg font-semibold text-teal-900 mb-2">Mission</h4>
                                <p class="text-teal-700">To provide high-quality educational programs and support services that empower learners.</p>
                            </div>
                            <div class="bg-gradient-to-br from-cyan-50 to-cyan-100 p-6 rounded-xl border border-cyan-200">
                                <h4 class="text-lg font-semibold text-cyan-900 mb-2">Vision</h4>
                                <p class="text-cyan-700">To be a leader in innovative education and professional development.</p>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200">
                                <h4 class="text-lg font-semibold text-blue-900 mb-2">Goals</h4>
                                <p class="text-blue-700">Deliver exceptional learning experiences and maintain academic excellence.</p>
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
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Academic-Specific Metrics</h4>
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
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Academic Team</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">AD</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Academic Director</h4>
                                        <p class="text-sm text-gray-600">Department Head</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Leads the academic department and oversees educational programs.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">PC</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Program Coordinator</h4>
                                        <p class="text-sm text-gray-600">Program Management</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Manages educational programs and curriculum development.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">IS</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Instructional Specialist</h4>
                                        <p class="text-sm text-gray-600">Teaching Support</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Provides support for teaching methodologies and student learning.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">AC</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Assessment Coordinator</h4>
                                        <p class="text-sm text-gray-600">Quality Assurance</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Manages assessment processes and academic quality standards.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">SS</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Student Services</h4>
                                        <p class="text-sm text-gray-600">Student Support</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Provides support services for students and program participants.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-red-500 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-white font-semibold">CD</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Curriculum Developer</h4>
                                        <p class="text-sm text-gray-600">Content Development</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm">Develops and updates educational content and materials.</p>
                            </div>
                        </div>
                        <div class="mt-6 bg-gradient-to-r from-teal-50 to-cyan-50 p-6 rounded-xl border border-teal-200">
                            <h4 class="text-lg font-semibold text-teal-900 mb-2">Team Size</h4>
                            <p class="text-teal-700">Total team members: <span class="font-bold">{{ $metrics['team_members'] }}</span></p>
                        </div>
                    </div>

                    <!-- Resources Tab -->
                    <div id="resources-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Academic Resources</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Documentation</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Curriculum Guidelines</li>
                                    <li>• Assessment Standards</li>
                                    <li>• Program Accreditation</li>
                                    <li>• Learning Objectives</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Tools & Platforms</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Learning Management System</li>
                                    <li>• Assessment Platforms</li>
                                    <li>• Content Development Tools</li>
                                    <li>• Student Tracking Systems</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Training Materials</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Instructor Training</li>
                                    <li>• Assessment Training</li>
                                    <li>• Curriculum Development</li>
                                    <li>• Student Support Training</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h4>
                                <ul class="space-y-2 text-gray-700">
                                    <li>• Academic Director: director.academic@company.com</li>
                                    <li>• Student Services: students@company.com</li>
                                    <li>• Program Support: programs@company.com</li>
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
                button.classList.remove('active', 'border-teal-500', 'text-teal-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById(tabName + '-tab').classList.remove('hidden');

            // Add active class to clicked button
            event.target.classList.add('active', 'border-teal-500', 'text-teal-600');
            event.target.classList.remove('border-transparent', 'text-gray-500');
        }
    </script>
</x-app-layout>
