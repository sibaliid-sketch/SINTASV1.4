<x-app-layout>
    <x-department-sidebar current="retention" />

    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('sintas') }}" class="mr-4 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent leading-tight">
                {{ __('Retention Department') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen ml-16">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tab Navigation -->
            <div class="mb-8">
                <nav class="flex space-x-8" aria-label="Tabs">
                    <a href="{{ route('departments.retention') }}" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('departments.retention') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('departments.overview.retention') }}" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('departments.overview.retention') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Overview
                    </a>
                </nav>
            </div>

            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Retention Department</h3>
                            <p class="text-gray-600">Meningkatkan retensi pengguna dan mengurangi churn rate.</p>
                        </div>
                    </div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        Departemen Retention fokus pada strategi untuk mempertahankan pengguna jangka panjang, mengurangi tingkat churn, dan meningkatkan loyalitas pelanggan.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Loyalty Programs</h4>
                    <p class="text-gray-600 mb-4">Mengembangkan program loyalitas untuk mempertahankan pengguna.</p>
                    <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium">Kelola Program →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Customer Support</h4>
                    <p class="text-gray-600 mb-4">Menyediakan dukungan pelanggan yang excellent untuk retensi.</p>
                    <a href="#" class="text-green-600 hover:text-green-700 font-medium">Dukung Pelanggan →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Churn Analysis</h4>
                    <p class="text-gray-600 mb-4">Menganalisis pola churn dan mengembangkan strategi pencegahan.</p>
                    <a href="#" class="text-orange-600 hover:text-orange-700 font-medium">Analisis Churn →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
