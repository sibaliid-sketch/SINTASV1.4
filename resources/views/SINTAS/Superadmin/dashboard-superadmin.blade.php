<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Superadmin Dashboard') }}
        </h2>
    </x-slot>

    @auth
        @if(auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
            <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl shadow-xl mb-8 overflow-hidden">
                <div class="p-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-4xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }} 👑</h3>
                            <p class="text-purple-100 text-lg">Anda memiliki akses penuh ke seluruh sistem PT. Siap Belajar Indonesia</p>
                        </div>
                        <div class="text-6xl opacity-20">👑</div>
                    </div>
                </div>
            </div>

            <!-- System Status Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Total Users</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\General\User::count() }}</p>
                        </div>
                        <div class="text-4xl text-blue-500">👥</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Active Registrations</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\General\Registration::where('status', 'approved')->count() }}</p>
                        </div>
                        <div class="text-4xl text-green-500">✅</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Departments</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">9</p>
                        </div>
                        <div class="text-4xl text-purple-500">🏢</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">System Health</p>
                            <p class="text-3xl font-bold text-green-600 mt-2">9.2/10</p>
                        </div>
                        <div class="text-4xl">💚</div>
                    </div>
                </div>
            </div>

            <!-- Superadmin Dashboard -->
            <div class="bg-white overflow-hidden shadow-lg border border-gray-200 sm:rounded-2xl mb-6">
                <div class="p-8 text-gray-900">
                    <!-- Section Title -->
                    <div class="mb-8 pb-6 border-b border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Management & Control</h3>
                        <p class="text-gray-600">Kelola seluruh sistem dan akses ke semua departemen</p>
                    </div>

                    <!-- Department & System Access Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <!-- SINTAS System -->
                        <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-6 rounded-xl border border-teal-200 hover:shadow-lg transition-all cursor-pointer group">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">🏢</div>
                                    <h4 class="text-lg font-semibold text-teal-800 mb-2">SINTAS System</h4>
                                    <p class="text-teal-600 text-sm">Employee & Department Management</p>
                                    <div class="mt-3 flex items-center text-xs text-teal-700 font-medium">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        9 Departments
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SIMY System -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 hover:shadow-lg transition-all cursor-pointer group">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">📚</div>
                                    <h4 class="text-lg font-semibold text-blue-800 mb-2">SIMY System</h4>
                                    <p class="text-blue-600 text-sm">Student Learning Management</p>
                                    <div class="mt-3 flex items-center text-xs text-blue-700 font-medium">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        6 Modules
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SITRA System -->
                        <div class="bg-gradient-to-br from-pink-50 to-pink-100 p-6 rounded-xl border border-pink-200 hover:shadow-lg transition-all cursor-pointer group">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">👨‍👩‍👧</div>
                                    <h4 class="text-lg font-semibold text-pink-800 mb-2">SITRA System</h4>
                                    <p class="text-pink-600 text-sm">Parent Portal & Monitoring</p>
                                    <div class="mt-3 flex items-center text-xs text-pink-700 font-medium">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        Active
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- System Overview -->
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200 hover:shadow-lg transition-all cursor-pointer group">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">📊</div>
                                    <h4 class="text-lg font-semibold text-purple-800 mb-2">System Overview</h4>
                                    <p class="text-purple-600 text-sm">Pantau performa keseluruhan sistem</p>
                                </div>
                            </div>
                        </div>

                        <!-- User Management -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200 hover:shadow-lg transition-all cursor-pointer group">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">👥</div>
                                    <h4 class="text-lg font-semibold text-green-800 mb-2">User Management</h4>
                                    <p class="text-green-600 text-sm">Kelola semua pengguna sistem</p>
                                </div>
                            </div>
                        </div>

                        <!-- Audit & Reports -->
                        <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl border border-red-200 hover:shadow-lg transition-all cursor-pointer group">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">📋</div>
                                    <h4 class="text-lg font-semibold text-red-800 mb-2">Audit & Reports</h4>
                                    <p class="text-red-600 text-sm">Pantau aktivitas dan laporan sistem</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Department Access -->
                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
                            <span class="text-2xl mr-2">⚡</span>
                            Quick Department Access
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                            <a href="{{ route('departments.operations') }}" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-4 rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all shadow-sm hover:shadow-md flex items-center">
                                <span class="text-xl mr-3">🏭</span>
                                <div>
                                    <h5 class="font-semibold text-sm">Operations</h5>
                                </div>
                            </a>
                            <a href="{{ route('departments.academic') }}" class="bg-gradient-to-r from-teal-500 to-teal-600 text-white p-4 rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all shadow-sm hover:shadow-md flex items-center">
                                <span class="text-xl mr-3">🎓</span>
                                <div>
                                    <h5 class="font-semibold text-sm">Academic</h5>
                                </div>
                            </a>
                            <a href="{{ route('departments.finance') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-lg hover:from-green-600 hover:to-green-700 transition-all shadow-sm hover:shadow-md flex items-center">
                                <span class="text-xl mr-3">💰</span>
                                <div>
                                    <h5 class="font-semibold text-sm">Finance</h5>
                                </div>
                            </a>
                            <a href="{{ route('departments.it') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all shadow-sm hover:shadow-md flex items-center">
                                <span class="text-xl mr-3">💻</span>
                                <div>
                                    <h5 class="font-semibold text-sm">IT Department</h5>
                                </div>
                            </a>
                            <a href="{{ route('departments.hr') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-4 rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all shadow-sm hover:shadow-md flex items-center">
                                <span class="text-xl mr-3">👔</span>
                                <div>
                                    <h5 class="font-semibold text-sm">Human Resource</h5>
                                </div>
                            </a>
                            <a href="{{ route('departments.sales-marketing') }}" class="bg-gradient-to-r from-red-500 to-red-600 text-white p-4 rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-sm hover:shadow-md flex items-center">
                                <span class="text-xl mr-3">📢</span>
                                <div>
                                    <h5 class="font-semibold text-sm">Sales & Marketing</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-8">
                        <h3 class="text-red-800 font-semibold text-lg mb-2">Akses Ditolak</h3>
                        <p class="text-red-600">Anda tidak memiliki izin untuk mengakses halaman ini. Hanya admin yang dapat mengakses dashboard superadmin.</p>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8">
                    <p class="text-yellow-800">Silakan <a href="{{ route('login') }}" class="text-blue-600 underline">login</a> terlebih dahulu untuk mengakses halaman ini.</p>
                </div>
            </div>
        </div>
    @endauth
</x-app-layout>
