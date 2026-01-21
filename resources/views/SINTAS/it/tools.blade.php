<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent leading-tight">
            {{ __('SINTAS - Tools (IT)') }}
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
                            <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-2xl flex items-center justify-center mr-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2">IT Tools Overview</h3>
                                <p class="text-gray-600">Comprehensive collection of tools for IT operations and management.</p>
                            </div>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            The IT department provides a suite of specialized tools to ensure efficient operations, system monitoring, security management, and technical support across the organization.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-6 rounded-xl border border-indigo-200">
                                <h4 class="text-lg font-semibold text-indigo-900 mb-2">Monitoring Tools</h4>
                                <p class="text-indigo-700">Real-time system monitoring and performance tracking.</p>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200">
                                <h4 class="text-lg font-semibold text-blue-900 mb-2">Security Tools</h4>
                                <p class="text-blue-700">Advanced security scanning and threat detection systems.</p>
                            </div>
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200">
                                <h4 class="text-lg font-semibold text-purple-900 mb-2">Development Tools</h4>
                                <p class="text-purple-700">Integrated development environments and deployment tools.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Available Tools Tab -->
                    <div id="available-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Available IT Tools</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">System Monitoring Dashboard</h4>
                                        <p class="text-sm text-gray-600">Real-time system performance monitoring</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Monitor server performance, network traffic, and system health in real-time.</p>
                                <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Security Scanner</h4>
                                        <p class="text-sm text-gray-600">Automated security vulnerability scanning</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Scan systems for security vulnerabilities and compliance issues.</p>
                                <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Chat Console</h4>
                                        <p class="text-sm text-gray-600">Technical support communication platform</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Communicate with users and provide technical support through chat.</p>
                                <a href="{{ route('departments.it.chat-console') }}" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-violet-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Database Management</h4>
                                        <p class="text-sm text-gray-600">Database administration and optimization</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Manage databases, perform backups, and optimize performance.</p>
                                <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Network Diagnostics</h4>
                                        <p class="text-sm text-gray-600">Network troubleshooting and diagnostics</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Diagnose network issues and monitor connectivity.</p>
                                <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-teal-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Documentation Portal</h4>
                                        <p class="text-sm text-gray-600">Technical documentation and knowledge base</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Access technical documentation and knowledge base articles.</p>
                                <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">Access Portal →</a>
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
                                    <li>Log in to the SINTAS system with your credentials</li>
                                    <li>Navigate to the IT department section</li>
                                    <li>Select the appropriate tool from the Tools menu</li>
                                    <li>Follow the on-screen instructions for each tool</li>
                                </ol>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Best Practices</h4>
                                <ul class="list-disc list-inside space-y-2 text-gray-700">
                                    <li>Always log out after using sensitive tools</li>
                                    <li>Report any system issues immediately</li>
                                    <li>Follow security protocols when handling data</li>
                                    <li>Keep documentation updated</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Troubleshooting</h4>
                                <div class="space-y-4">
                                    <div>
                                        <h5 class="font-medium text-gray-900">Tool Not Loading</h5>
                                        <p class="text-gray-700 text-sm">Clear your browser cache and try again. If the issue persists, contact IT support.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">Access Denied</h5>
                                        <p class="text-gray-700 text-sm">Ensure you have the correct permissions. Contact your department head if needed.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">Data Not Saving</h5>
                                        <p class="text-gray-700 text-sm">Check your internet connection and try again. Report to IT if the problem continues.</p>
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
                                        <p class="font-medium text-gray-900">IT Help Desk</p>
                                        <p class="text-gray-700 text-sm">Email: helpdesk@company.com</p>
                                        <p class="text-gray-700 text-sm">Phone: +1 (555) 123-4567</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Emergency Support</p>
                                        <p class="text-gray-700 text-sm">Email: emergency@company.com</p>
                                        <p class="text-gray-700 text-sm">Phone: +1 (555) 911-0000</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">IT Manager</p>
                                        <p class="text-gray-700 text-sm">Email: it.manager@company.com</p>
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
                                        <p class="font-medium text-gray-900">Emergency Support</p>
                                        <p class="text-gray-700 text-sm">24/7 Available</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Response Time</p>
                                        <p class="text-gray-700 text-sm">Critical: < 1 hour</p>
                                        <p class="text-gray-700 text-sm">High: < 4 hours</p>
                                        <p class="text-gray-700 text-sm">Normal: < 24 hours</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm md:col-span-2">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Frequently Asked Questions</h4>
                                <div class="space-y-4">
                                    <div>
                                        <h5 class="font-medium text-gray-900">How do I reset my password?</h5>
                                        <p class="text-gray-700 text-sm">Use the password reset link on the login page or contact IT support.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">What should I do if my computer is slow?</h5>
                                        <p class="text-gray-700 text-sm">Run a virus scan and clear temporary files. Contact IT if the problem persists.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">How do I request new software?</h5>
                                        <p class="text-gray-700 text-sm">Submit a request through the IT service portal or email helpdesk@company.com.</p>
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
