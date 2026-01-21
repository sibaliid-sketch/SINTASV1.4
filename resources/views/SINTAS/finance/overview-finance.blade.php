<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent leading-tight">
            {{ __('Finance Overview') }}
        </h2>
    </x-slot>

    <!-- Include Department Sidebar -->
    @include('SINTAS.finance.finance-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Performance Overview -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
</x-app-layout>
