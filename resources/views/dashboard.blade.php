<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user()->role === 'admin')
                <!-- Admin Dashboard -->
                <div class="bg-white overflow-hidden shadow-lg border border-gray-200 sm:rounded-2xl mb-6">
                    <div class="p-8 text-gray-900">
                        <div class="text-center mb-8">
                            <div class="text-6xl mb-4">👨‍💼</div>
                            <h3 class="text-3xl font-bold mb-4 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Dashboard Admin SINTAS</h3>
                            <p class="text-gray-600 text-lg">Selamat datang, {{ auth()->user()->name }}. Kelola sistem PT. Siap Belajar Indonesia dari sini.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div class="bg-gradient-to-br from-primary-50 to-primary-100 p-6 rounded-xl border border-primary-200 text-center hover:shadow-lg transition-shadow">
                                <h4 class="text-lg font-semibold text-primary-800 mb-2">Dashboard</h4>
                                <p class="text-primary-600 text-sm">Ringkasan sistem</p>
                            </div>
                            <div class="bg-gradient-to-br from-secondary-50 to-secondary-100 p-6 rounded-xl border border-secondary-200 text-center hover:shadow-lg transition-shadow">
                                <div class="text-4xl mb-3">👥</div>
                                <h4 class="text-lg font-semibold text-secondary-800 mb-2">Kelola User</h4>
                                <p class="text-secondary-600 text-sm">Pengguna & siswa</p>
                            </div>
                            <div class="bg-gradient-to-br from-accent-50 to-accent-100 p-6 rounded-xl border border-accent-200 text-center hover:shadow-lg transition-shadow">
                                <div class="text-4xl mb-3">📚</div>
                                <h4 class="text-lg font-semibold text-accent-800 mb-2">Program</h4>
                                <p class="text-accent-600 text-sm">Kelola program belajar</p>
                            </div>
                            <div class="bg-gradient-to-br from-primary-50 to-primary-100 p-6 rounded-xl border border-primary-200 text-center hover:shadow-lg transition-shadow">
                                <div class="text-4xl mb-3">📋</div>
                                <h4 class="text-lg font-semibold text-primary-800 mb-2">Pendaftaran</h4>
                                <p class="text-primary-600 text-sm">Lihat pemesanan</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Student/Parent Dashboard -->
                <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-2xl font-bold mb-4 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Selamat Datang di Dashboard!</h3>
                        <p class="text-gray-600 mb-6">Anda telah berhasil masuk ke akun Sibali.id. Dari sini, Anda dapat mengakses berbagai fitur dan layanan kami.</p>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-primary-50 to-primary-100 p-6 rounded-xl border border-primary-200">
                                <h4 class="text-lg font-semibold text-primary-800 mb-2">Program Pembelajaran</h4>
                                <p class="text-primary-600 text-sm">Akses materi dan jadwal pembelajaran Anda.</p>
                            </div>
                            <div class="bg-gradient-to-br from-secondary-50 to-secondary-100 p-6 rounded-xl border border-secondary-200">
                                <h4 class="text-lg font-semibold text-secondary-800 mb-2">Profil Saya</h4>
                                <p class="text-secondary-600 text-sm">Kelola informasi pribadi dan pengaturan akun.</p>
                            </div>
                            <div class="bg-gradient-to-br from-accent-50 to-accent-100 p-6 rounded-xl border border-accent-200">
                                <h4 class="text-lg font-semibold text-accent-800 mb-2">Dukungan</h4>
                                <p class="text-accent-600 text-sm">Hubungi tim kami untuk bantuan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
