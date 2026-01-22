<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent leading-tight">
            {{ __('SINTAS - Tools (Operations)') }}
        </h2>
    </x-slot>
    @auth
    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin' || auth()->user()->role === 'employee' || auth()->user()->role === 'admin_operational' || (auth()->user()->role === 'karyawan' && auth()->user()->department === 'operations'))
    <!-- Include Department Sidebar -->
    @include('SINTAS.operations.operations-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs Navigation -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button onclick="showTab('overview')" class="tab-button active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-orange-500 text-orange-600">
                            Tools Overview
                        </button>
                        <button onclick="showTab('available')" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Available Tools
                        </button>
                        <button onclick="showTab('guide')" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Usage Guide
                        </button>
                        <button onclick="showTab('support')" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Support
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Overview Tab -->
                    <div id="overview-tab" class="tab-content">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mr-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Operations Tools Overview</h3>
                                <p class="text-gray-600">Comprehensive collection of tools for operations management.</p>
                            </div>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            The Operations Department provides specialized tools for managing business processes, system operations, quality assurance, and operational efficiency across the organization.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-xl border border-orange-200">
                                <h4 class="text-lg font-semibold text-orange-900 mb-2">Process Tools</h4>
                                <p class="text-orange-700">Tools for optimizing and managing business processes.</p>
                            </div>
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl border border-red-200">
                                <h4 class="text-lg font-semibold text-red-900 mb-2">System Tools</h4>
                                <p class="text-red-700">Management tools for SIMY, SITRA, and other systems.</p>
                            </div>
                            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-xl border border-yellow-200">
                                <h4 class="text-lg font-semibold text-yellow-900 mb-2">Quality Tools</h4>
                                <p class="text-yellow-700">Quality assurance and compliance management tools.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Available Tools Tab -->
                    <div id="available-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Available Operations Tools</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Process Dashboard</h4>
                                        <p class="text-sm text-gray-600">Real-time process monitoring and analytics</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Monitor business processes and performance metrics in real-time.</p>
                                <a href="#" class="text-orange-600 hover:text-orange-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">SIMY Management</h4>
                                        <p class="text-sm text-gray-600">SIMY system administration and monitoring</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Manage and monitor the SIMY system operations and performance.</p>
                                <a href="#" class="text-orange-600 hover:text-orange-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">SITRA Management</h4>
                                        <p class="text-sm text-gray-600">SITRA system administration and monitoring</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Manage and monitor the SITRA system operations and performance.</p>
                                <a href="#" class="text-orange-600 hover:text-orange-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Quality Assurance</h4>
                                        <p class="text-sm text-gray-600">Quality control and compliance tools</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Manage quality standards and ensure compliance with regulations.</p>
                                <a href="#" class="text-orange-600 hover:text-orange-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Process Optimizer</h4>
                                        <p class="text-sm text-gray-600">Business process optimization tools</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Optimize and improve business processes for better efficiency.</p>
                                <a href="#" class="text-orange-600 hover:text-orange-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-violet-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Operations Reports</h4>
                                        <p class="text-sm text-gray-600">Generate operational reports and analytics</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Create comprehensive reports on operational performance and metrics.</p>
                                <a href="#" class="text-orange-600 hover:text-orange-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Operations Chat Console</h4>
                                        <p class="text-sm text-gray-600">Manage chat communications for guests, SIMY, and SITRA</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Handle chat communications and support for guest users, SIMY system, and SITRA system.</p>
                                <a href="{{ route('departments.operations.chat-console') }}" class="text-orange-600 hover:text-orange-700 font-medium text-sm">Access Chat Console →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Usage Guide Tab -->
                    <div id="guide-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Usage Guide</h3>
                        <div class="space-y-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Getting Started</h4>
                                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                                    <li>Access the Operations dashboard from the main menu</li>
                                    <li>Select the appropriate tool from the Tools section</li>
                                    <li>Review the tool documentation before use</li>
                                    <li>Contact operations support if you need assistance</li>
                                </ol>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Best Practices</h4>
                                <ul class="list-disc list-inside space-y-2 text-gray-700">
                                    <li>Always backup data before making changes</li>
                                    <li>Follow standard operating procedures</li>
                                    <li>Report any system issues immediately</li>
                                    <li>Keep documentation updated</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Troubleshooting</h4>
                                <div class="space-y-4">
                                    <div>
                                        <h5 class="font-medium text-gray-900">System Access Issues</h5>
                                        <p class="text-gray-700 text-sm">Check your permissions and contact operations support.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">Data Not Loading</h5>
                                        <p class="text-gray-700 text-sm">Refresh the page and check your internet connection.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">Report Generation Failed</h5>
                                        <p class="text-gray-700 text-sm">Verify input parameters and try again.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Support Tab -->
                    <div id="support-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Support & Help</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h4>
                                <div class="space-y-3">
                                    <div>
                                        <p class="font-medium text-gray-900">Operations Support</p>
                                        <p class="text-gray-700 text-sm">Email: support.ops@company.com</p>
                                        <p class="text-gray-700 text-sm">Phone: +1 (555) 123-4567</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">System Support</p>
                                        <p class="text-gray-700 text-sm">Email: systems@company.com</p>
                                        <p class="text-gray-700 text-sm">Phone: +1 (555) 987-6543</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Emergency Support</p>
                                        <p class="text-gray-700 text-sm">Email: emergency@company.com</p>
                                        <p class="text-gray-700 text-sm">Phone: +1 (555) 911-0000</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Support Hours</h4>
                                <div class="space-y-3">
                                    <div>
                                        <p class="font-medium text-gray-900">Regular Support</p>
                                        <p class="text-gray-700 text-sm">Monday - Friday: 8:00 AM - 6:00 PM</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Extended Support</p>
                                        <p class="text-gray-700 text-sm">Saturday: 9:00 AM - 2:00 PM</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Emergency Support</p>
                                        <p class="text-gray-700 text-sm">24/7 Available</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Response Time</p>
                                        <p class="text-gray-700 text-sm">Critical: < 30 minutes</p>
                                        <p class="text-gray-700 text-sm">High: < 2 hours</p>
                                        <p class="text-gray-700 text-sm">Normal: < 8 hours</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm md:col-span-2">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Frequently Asked Questions</h4>
                                <div class="space-y-4">
                                    <div>
                                        <h5 class="font-medium text-gray-900">How do I access SIMY system?</h5>
                                        <p class="text-gray-700 text-sm">Use the SIMY Management tool from the Tools section.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">What should I do if a process fails?</h5>
                                        <p class="text-gray-700 text-sm">Check the Process Dashboard and contact operations support.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">How do I generate reports?</h5>
                                        <p class="text-gray-700 text-sm">Use the Operations Reports tool with appropriate parameters.</p>
                                    </div>
                                </div>
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
    @endauth</x-app-layout>
