<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent leading-tight">
            {{ __('SINTAS - Services (Academic)') }}
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
                            Services Overview
                        </button>
                        <button onclick="showTab('available')" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Available Services
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
                            <div class="w-16 h-16 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center mr-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Academic Services Overview</h3>
                                <p class="text-gray-600">Comprehensive collection of educational services and management tools.</p>
                            </div>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            The Academic Department provides a comprehensive suite of services for managing educational programs, student services, curriculum development, and academic administration.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-6 rounded-xl border border-teal-200">
                                <h4 class="text-lg font-semibold text-teal-900 mb-2">Program Services</h4>
                                <p class="text-teal-700">Tools for managing educational programs and courses.</p>
                            </div>
                            <div class="bg-gradient-to-br from-cyan-50 to-cyan-100 p-6 rounded-xl border border-cyan-200">
                                <h4 class="text-lg font-semibold text-cyan-900 mb-2">Student Services</h4>
                                <p class="text-cyan-700">Support services for student enrollment and management.</p>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200">
                                <h4 class="text-lg font-semibold text-blue-900 mb-2">Assessment Services</h4>
                                <p class="text-blue-700">Tools for evaluation and academic assessment.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Available Services Tab -->
                    <div id="available-tab" class="tab-content hidden">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Available Academic Services</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Services Management</h4>
                                        <p class="text-sm text-gray-600">Manage educational services and offerings</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Create, update, and manage educational services offered by the institution.</p>
                                <a href="{{ route('departments.academic.services') }}" class="text-teal-600 hover:text-teal-700 font-medium text-sm">Access Service →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Programs Management</h4>
                                        <p class="text-sm text-gray-600">Manage educational programs and curricula</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Organize and maintain educational programs and course structures.</p>
                                <a href="{{ route('departments.academic.programs') }}" class="text-teal-600 hover:text-teal-700 font-medium text-sm">Access Program →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Schedules Management</h4>
                                        <p class="text-sm text-gray-600">Manage class schedules and timetables</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Create and manage class schedules, sessions, and program timelines.</p>
                                <a href="{{ route('departments.academic.schedules') }}" class="text-teal-600 hover:text-teal-700 font-medium text-sm">Access Schedule →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Assessment Tools</h4>
                                        <p class="text-sm text-gray-600">Student assessment and evaluation tools</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Tools for creating assessments, grading, and tracking student progress.</p>
                                <a href="#" class="text-teal-600 hover:text-teal-700 font-medium text-sm">Access Tool →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Curriculum Builder</h4>
                                        <p class="text-sm text-gray-600">Curriculum development and management</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Design and manage educational curricula and learning paths.</p>
                                <a href="#" class="text-teal-600 hover:text-teal-700 font-medium text-sm">Access Builder →</a>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-red-500 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Student Analytics</h4>
                                        <p class="text-sm text-gray-600">Student performance and engagement analytics</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm mb-4">Analyze student performance, engagement, and learning outcomes.</p>
                                <a href="#" class="text-teal-600 hover:text-teal-700 font-medium text-sm">Access Analytics →</a>
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
                                    <li>Access the Academic dashboard from the main menu</li>
                                    <li>Select the appropriate service from the Services section</li>
                                    <li>Review the service documentation before implementation</li>
                                    <li>Contact academic support if you need assistance</li>
                                </ol>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Best Practices</h4>
                                <ul class="list-disc list-inside space-y-2 text-gray-700">
                                    <li>Regularly update curriculum and program information</li>
                                    <li>Maintain accurate student records and assessments</li>
                                    <li>Follow academic standards and accreditation requirements</li>
                                    <li>Provide timely feedback and support to students</li>
                                </ul>
                            </div>
                            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Troubleshooting</h4>
                                <div class="space-y-4">
                                    <div>
                                        <h5 class="font-medium text-gray-900">Service Configuration Issues</h5>
                                        <p class="text-gray-700 text-sm">Check service settings and permissions. Contact academic support.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">Student Data Not Loading</h5>
                                        <p class="text-gray-700 text-sm">Verify database connections and refresh the page.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">Assessment Tools Not Working</h5>
                                        <p class="text-gray-700 text-sm">Check assessment configurations and student permissions.</p>
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
                                        <p class="font-medium text-gray-900">Academic Support</p>
                                        <p class="text-gray-700 text-sm">Email: support.academic@company.com</p>
                                        <p class="text-gray-700 text-sm">Phone: +1 (555) 123-4567</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Technical Support</p>
                                        <p class="text-gray-700 text-sm">Email: tech.academic@company.com</p>
                                        <p class="text-gray-700 text-sm">Phone: +1 (555) 987-6543</p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Student Services</p>
                                        <p class="text-gray-700 text-sm">Email: students@company.com</p>
                                        <p class="text-gray-700 text-sm">Phone: +1 (555) 555-0123</p>
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
                                        <p class="text-gray-700 text-sm">Saturday: 9:00 AM - 1:00 PM</p>
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
                                        <h5 class="font-medium text-gray-900">How do I add a new service?</h5>
                                        <p class="text-gray-700 text-sm">Use the Services Management tool and follow the creation wizard.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">How do I enroll students in programs?</h5>
                                        <p class="text-gray-700 text-sm">Use the Programs Management tool and select enrollment options.</p>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900">How do I create assessment rubrics?</h5>
                                        <p class="text-gray-700 text-sm">Access the Assessment Tools and use the rubric builder.</p>
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
