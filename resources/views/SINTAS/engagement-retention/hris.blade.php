<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent leading-tight">
            SINTAS - HRIS (engagement-retention)
        </h2>
    </x-slot>

    @auth
    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin' || auth()->user()->role === 'employee' || auth()->user()->role === 'admin_operational' || (auth()->user()->role === 'karyawan' && auth()->user()->department === 'engagement-retention'))

    <!-- Include Department Sidebar -->
    @include('SINTAS.engagement-retention.engagement_retention-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/60 backdrop-blur-sm rounded-lg p-6">
                <h3 class="text-2xl font-bold">HRIS System - engagement-retention</h3>
                <p class="text-gray-600">Human Resource Information System</p>
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
