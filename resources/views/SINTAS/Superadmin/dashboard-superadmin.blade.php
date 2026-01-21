<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Superadmin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Superadmin Dashboard -->
            <div class="bg-white overflow-hidden shadow-lg border border-gray-200 sm:rounded-2xl mb-6">
                <div class="p-8 text-gray-900">
                    <div class="text-center mb-8">
                        <div class="text-6xl mb-4">👑</div>
                        <h3 class="text-3xl font-bold mb-4 bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Superadmin Dashboard</h3>
                        <p class="text-gray-600 text-lg">Selamat datang, {{ auth()->user()->name }}. Anda memiliki akses penuh ke seluruh sistem PT. Siap Belajar Indonesia.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <!-- System Overview -->
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200 hover:shadow-lg transition-shadow">
                            <div class="text-4xl mb-3">📊</div>
                            <h4 class="text-lg font-semibold text-purple-800 mb-2">System Overview</h4>
                            <p class="text-purple-600 text-sm">Pantau performa keseluruhan sistem</p>
                        </div>

                        <!-- User Management -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 hover:shadow-lg transition-shadow">
                            <div class="text-4xl mb-3">👥</div>
                            <h4 class="text-lg font-semibold text-blue-800 mb-2">User Management</h4>
                            <p class="text-blue-600 text-sm">Kelola semua pengguna sistem</p>
                        </div>

                        <!-- Department Access -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200 hover:shadow-lg transition-shadow">
                            <div class="text-4xl mb-3">🏢</div>
                            <h4 class="text-lg font-semibold text-green-800 mb-2">All Departments</h4>
                            <p class="text-green-600 text-sm">Akses ke semua departemen</p>
                        </div>

                        <!-- Audit Logs -->
                        <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl border border-red-200 hover:shadow-lg transition-shadow">
                            <div class="text-4xl mb-3">📋</div>
                            <h4 class="text-lg font-semibold text-red-800 mb-2">Audit Logs</h4>
                            <p class="text-red-600 text-sm">Pantau aktivitas sistem</p>
                        </div>

                        <!-- System Settings -->
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-xl border border-yellow-200 hover:shadow-lg transition-shadow">
                            <div class="text-4xl mb-3">⚙️</div>
                            <h4 class="text-lg font-semibold text-yellow-800 mb-2">System Settings</h4>
                            <p class="text-yellow-600 text-sm">Konfigurasi sistem</p>
                        </div>

                        <!-- Reports -->
                        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-6 rounded-xl border border-indigo-200 hover:shadow-lg transition-shadow">
                            <div class="text-4xl mb-3">📈</div>
                            <h4 class="text-lg font-semibold text-indigo-800 mb-2">Reports</h4>
                            <p class="text-indigo-600 text-sm">Laporan dan analitik</p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="text-xl font-semibold mb-4 text-gray-800">Quick Actions</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('departments.operations') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all">
                                <div class="flex items-center">
                                    <span class="text-2xl mr-3">🏭</span>
                                    <div>
                                        <h5 class="font-semibold">Operations Dashboard</h5>
                                        <p class="text-sm opacity-90">Akses dashboard operasional</p>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('departments.it') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-lg hover:from-green-600 hover:to-green-700 transition-all">
                                <div class="flex items-center">
                                    <span class="text-2xl mr-3">💻</span>
                                    <div>
                                        <h5 class="font-semibold">IT Dashboard</h5>
                                        <p class="text-sm opacity-90">Akses dashboard IT</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
