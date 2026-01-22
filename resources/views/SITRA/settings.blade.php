<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SITRA - Pengaturan & Preferensi') }}
        </h2>
    </x-slot>

    @auth
        @if(auth()->user()->role === 'parent')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Settings Menu -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Pengaturan</h3>
                        </div>
                        <nav class="divide-y divide-gray-200">
                            <a href="#preferences" class="block px-6 py-3 text-gray-700 hover:bg-gray-50 font-medium">
                                Preferensi Notifikasi
                            </a>
                            <a href="#profile" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">
                                Profil & Data
                            </a>
                            <a href="#privacy" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">
                                Privasi & Keamanan
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Settings Content -->
                <div class="lg:col-span-2">
                    <!-- Notification Preferences -->
                    <div class="bg-white rounded-lg shadow p-6 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Preferensi Notifikasi</h2>
                        
                        <form action="{{ route('sitra.preferences.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PATCH')

                            <!-- Email Notifications -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="flex items-center">
                                    <input type="checkbox" name="email_notifications" value="1" 
                                        {{ ($preferences['email_notifications'] ?? true) ? 'checked' : '' }}
                                        class="form-checkbox h-4 w-4 text-blue-600">
                                    <span class="ml-3">
                                        <span class="text-sm font-medium text-gray-900">Notifikasi Email</span>
                                        <p class="text-xs text-gray-600 mt-1">Terima update tentang perkembangan anak melalui email</p>
                                    </span>
                                </label>
                            </div>

                            <!-- SMS Notifications -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="flex items-center">
                                    <input type="checkbox" name="sms_notifications" value="1"
                                        {{ ($preferences['sms_notifications'] ?? false) ? 'checked' : '' }}
                                        class="form-checkbox h-4 w-4 text-blue-600">
                                    <span class="ml-3">
                                        <span class="text-sm font-medium text-gray-900">Notifikasi SMS</span>
                                        <p class="text-xs text-gray-600 mt-1">Terima update penting melalui SMS</p>
                                    </span>
                                </label>
                            </div>

                            <!-- Push Notifications -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="flex items-center">
                                    <input type="checkbox" name="push_notifications" value="1"
                                        {{ ($preferences['push_notifications'] ?? false) ? 'checked' : '' }}
                                        class="form-checkbox h-4 w-4 text-blue-600">
                                    <span class="ml-3">
                                        <span class="text-sm font-medium text-gray-900">Notifikasi Push</span>
                                        <p class="text-xs text-gray-600 mt-1">Terima notifikasi di perangkat Anda</p>
                                    </span>
                                </label>
                            </div>

                            <!-- Report Frequency -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-900 mb-3">Frekuensi Laporan</label>
                                <select name="report_frequency" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="daily" {{ ($preferences['report_frequency'] ?? 'weekly') === 'daily' ? 'selected' : '' }}>Harian</option>
                                    <option value="weekly" {{ ($preferences['report_frequency'] ?? 'weekly') === 'weekly' ? 'selected' : '' }}>Mingguan</option>
                                    <option value="monthly" {{ ($preferences['report_frequency'] ?? 'weekly') === 'monthly' ? 'selected' : '' }}>Bulanan</option>
                                </select>
                            </div>

                            <!-- Language -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-900 mb-3">Bahasa</label>
                                <select name="language" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="id" {{ ($preferences['language'] ?? 'id') === 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                                    <option value="en" {{ ($preferences['language'] ?? 'id') === 'en' ? 'selected' : '' }}>English</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                                Simpan Preferensi
                            </button>
                        </form>
                    </div>

                    <!-- Profile Information -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Profil</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" value="{{ $guardian->name }}" disabled class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" value="{{ $guardian->email }}" disabled class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="tel" value="{{ $guardian->phone ?? '-' }}" disabled class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50">
                            </div>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="inline-block mt-6 px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @else
            <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-red-50 border border-red-200 rounded-lg p-8"><h3 class="text-red-800 font-semibold text-lg mb-2">Akses Ditolak</h3><p class="text-red-600">Anda tidak memiliki izin untuk mengakses halaman ini.</p></div></div></div>
        @endif
    @else
        <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8"><p class="text-yellow-800">Silakan <a href="{{ route('login') }}" class="text-blue-600 underline font-semibold">login</a> terlebih dahulu.</p></div></div></div>
    @endauth
</x-app-layout>
