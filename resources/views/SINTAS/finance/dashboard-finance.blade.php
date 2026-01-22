<x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent leading-tight">
                    {{ __('SINTAS - Sistem Internal (Finance)') }}
                </h2>
            </x-slot>

    <!-- Include Department Sidebar OUTSIDE of auth gate -->
    @include('SINTAS.finance.finance-sidebar')

    @auth
    @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin' || auth()->user()->role === 'employee' || auth()->user()->role === 'admin_operational' || (auth()->user()->role === 'karyawan' && auth()->user()->department === 'finance'))

    <!-- Tab Navigation -->
    <div class="bg-white/60 backdrop-blur-sm border-b border-gray-200/50 mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="{{ route('departments.finance') }}" class="border-indigo-500 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" aria-current="page">
                    Dashboard
                </a>
                <a href="{{ route('departments.overview.finance') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Overview
                </a>
            </nav>
        </div>
    </div>

    <div class="py-12 bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Selamat Datang di SINTAS (Finance)</h3>
                            <p class="text-gray-600">Kelola keuangan, pembayaran, dan laporan finansial.</p>
                        </div>
                    </div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        Departemen Finance bertanggung jawab atas semua aspek keuangan perusahaan, termasuk pengelolaan anggaran, verifikasi pembayaran, pelaporan keuangan, dan pengendalian risiko finansial.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Payment Verification</h4>
                    <p class="text-gray-600 mb-4">Verifikasi bukti pembayaran siswa dan proses refund jika diperlukan.</p>
                    <a href="#" class="text-orange-600 hover:text-orange-700 font-medium">Verifikasi Pembayaran →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Financial Reports</h4>
                    <p class="text-gray-600 mb-4">Generate laporan keuangan bulanan dan analisis performa finansial.</p>
                    <a href="#" class="text-green-600 hover:text-green-700 font-medium">Lihat Laporan →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Budget Management</h4>
                    <p class="text-gray-600 mb-4">Kelola anggaran departemen dan monitor pengeluaran perusahaan.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Kelola Budget →</a>
                </div>
            </div>
        </div>
    </div>

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

