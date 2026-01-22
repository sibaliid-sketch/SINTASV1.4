<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent leading-tight">
            {{ __('SINTAS - General (Engagement & Retention)') }}
        </h2>
    </x-slot>

    @auth
    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin' || auth()->user()->role === 'employee' || auth()->user()->role === 'admin_operational' || (auth()->user()->role === 'karyawan' && auth()->user()->department === 'engagement-retention'))

    <!-- Include Department Sidebar -->
    @include('SINTAS.engagement-retention.engagement_retention-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs Navigation -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button onclick="showTab('overview')" class="tab-button active whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-cyan-500 text-cyan-600">
                            Overview
                        </button>
                        <button onclick="showTab('metrics')" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Metrics
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Tab Content -->
            <div id="overview" class="tab-content block">
                <div class="bg-white/60 backdrop-blur-sm rounded-lg p-6">
                    <h3 class="text-2xl font-bold">Engagement & Retention General</h3>
                    <p class="text-gray-600">Department Overview</p>
                </div>
            </div>

            <div id="metrics" class="tab-content hidden">
                <div class="bg-white/60 backdrop-blur-sm rounded-lg p-6">
                    <h3 class="text-2xl font-bold">Key Metrics</h3>
                    <p class="text-gray-600">Performance indicators</p>
                </div>
            </div>
        </div>
    </div>

    @else
        <div class="py-12"><div class="text-center"><h2>Access Denied</h2></div></div>
    @endif
    @else
        <div class="py-12"><div class="text-center"><h2>Please Login</h2></div></div>
    @endauth
</x-app-layout>
