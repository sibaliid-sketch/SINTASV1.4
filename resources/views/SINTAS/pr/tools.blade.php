<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent leading-tight">
            {{ __('SINTAS - Tools (PR)') }}
        </h2>
    </x-slot>
    @auth
    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin' || auth()->user()->role === 'employee' || auth()->user()->role === 'admin_operational' || (auth()->user()->role === 'karyawan' && auth()->user()->department === 'pr'))
    <!-- Include Department Sidebar -->
    @include('SINTAS.pr.pr-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs Navigation -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button onclick="showTab('overview')" class="tab-button active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-purple-500 text-purple-600">
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
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mr-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2">PR Tools Overview</h3>
                                <p class="text-gray-600">Comprehensive collection of tools for PR operations and digital content management.</p>
                            </div>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            The PR department provides a suite of specialized tools to ensure efficient content creation, social media management, asset organization, and digital communication across the company.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200">
                                <h4 class="text-lg font-semibold text-purple-900 mb-2">Content Creation Tools</h4>
                                <p class="text-purple-700">Streamlined content development and editing processes.</p>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200">
                                <h4 class="text-lg font-semibold text-blue-900 mb-2">Asset Management</h4>
                                <p class="text-blue-700">Comprehensive digital asset organization and Canva integration.</p>
                            </div>
                            <div class="bg-gradient-to-br from-pink-50 to-pink-100 p-6 rounded-xl border border-pink-200">
                                <h4 class="text-lg font-semibold text-pink-900 mb-2">Social Media Tools</h4>
                                <p class="text-pink-700">Advanced social media monitoring and content scheduling.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Available Tools Tab -->
                    <div id="available-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Available PR Tools</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Content Management System</h4>
                                        <p class="text-sm text-gray-600">Website content and article management</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Manage website articles, landing pages, and static content with rich editing capabilities.</p>
                                <a href="#" class="text-purple-600 hover:text-purple-700 font-medium text-sm">Access CMS →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0V8a2 2 0 01-2 2H9a2 2 0 01-2-2V6m8 0H8"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Social Media Hub</h4>
                                        <p class="text-sm text-gray-600">Social media content and engagement management</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Monitor social media channels, schedule posts, and track engagement metrics.</p>
                                <a href="#" class="text-purple-600 hover:text-purple-700 font-medium text-sm">Access Hub →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Canva Integration</h4>
                                        <p class="text-sm text-gray-600">Design asset creation and management</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Create and manage design assets with seamless Canva integration.</p>
                                <a href="#" class="text-purple-600 hover:text-purple-700 font-medium text-sm">Open Canva →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-violet-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Content Analytics Dashboard</h4>
                                        <p class="text-sm text-gray-600">Content performance and SEO tracking</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">View content analytics, track SEO performance, and generate reports.</p>
                                <a href="#" class="text-purple-600 hover:text-purple-700 font-medium text-sm">View Analytics →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Content Calendar</h4>
                                        <p class="text-sm text-gray-600">Content planning and scheduling</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Plan and schedule content across all platforms and channels.</p>
                                <a href="#" class="text-purple-600 hover:text-purple-700 font-medium text-sm">Open Calendar →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-teal-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Brand Guidelines Manager</h4>
                                        <p class="text-sm text-gray-600">Brand identity and guidelines management</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Access and maintain brand guidelines, logos, and visual identity assets.</p>
                                <a href="#" class="text-purple-600 hover:text-purple-700 font-medium text-sm">View Guidelines →</a>
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
                                    <li>Navigate to the PR department section</li>
                                    <li>Select the appropriate tool from the Tools menu</li>
                                    <li>Follow the on-screen instructions for each tool</li>
                                </ol>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Best Practices</h4>
                                <ul class="list-disc list-inside space-y-2 text-gray-700">
                                    <li>Always save your work regularly when using content tools</li>
                                    <li>Report any PR system issues immediately</li>
                                    <li>Follow brand guidelines when creating content</li>
                                    <li>Keep content assets organized and properly tagged</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Troubleshooting</h4>
                                <div class="space-y-4">
                                    <div>
                                        <h5 class="font-medium text-gray-900">Tool Not Loading</h5>
                                        <p class="text-gray-700 text-sm">Clear your browser cache and try again. If the issue persists, contact PR support.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">Access Denied</h5>
                                        <p class="text-gray-700 text-sm">Ensure you have the correct permissions. Contact your department head if needed.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">Content Not Saving</h5>
                                        <p class="text-gray-700 text-sm">Check your internet connection and try again. Report to PR if the problem continues.</p>
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
                                        <p class="font-medium text-gray-900">PR Help Desk</p>
                                        <p class="text-gray-700 text-sm">Email: pr.helpdesk@company.com</p>
                                        <p class="text-gray-700 text-sm">Phone: +1 (555) 123-4567</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Emergency Support</p>
                                        <p class="text-gray-700 text-sm">Email: pr.emergency@company.com</p>
                                        <p class="text-gray-700 text-sm">Phone: +1 (555) 911-0000</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">PR Manager</p>
                                        <p class="text-gray-700 text-sm">Email: pr.manager@company.com</p>
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
                                        <h5 class="font-medium text-gray-900">How do I create new content?</h5>
                                        <p class="text-gray-700 text-sm">Use the Content Management System to create and edit website articles and landing pages.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">How do I schedule social media posts?</h5>
                                        <p class="text-gray-700 text-sm">Access the Social Media Hub to schedule posts and monitor engagement across platforms.</p>
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
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => content.classList.add('hidden'));

            // Remove active class from all buttons
            const tabButtons = document.querySelectorAll('.tab-button');
            tabButtons.forEach(button => {
                button.classList.remove('active', 'border-purple-500', 'text-purple-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById(tabName + '-tab').classList.remove('hidden');

            // Add active class to selected button
            event.target.classList.add('active', 'border-purple-500', 'text-purple-600');
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
