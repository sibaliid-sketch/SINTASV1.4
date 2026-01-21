<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent leading-tight">
            {{ __('SINTAS - Sistem Internal (Operations)') }}
        </h2>
    </x-slot>

    <!-- Include Department Sidebar -->
    @include('SINTAS.operations.operations-sidebar')

    <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Selamat Datang di SINTAS (Operations)</h3>
                            <p class="text-gray-600">Kelola operasional harian dan proses bisnis perusahaan.</p>
                        </div>
                    </div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        SINTAS adalah platform internal yang digunakan oleh departemen Operations untuk mengelola website, sistem SIMY, sistem SITRA, serta operasional perusahaan secara keseluruhan. Sistem ini menyediakan tools dan dashboard yang diperlukan untuk menjalankan bisnis dengan efisien.
                    </p>
                </div>
            </div>

            <!-- Metrics Overview Section -->
            @if(isset($metrics) && auth()->user()->role === 'karyawan')
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Overview Metrics Tugas Anda</h3>
                            <p class="text-gray-600">Ringkasan performa berdasarkan jabatan dan level Anda</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-600 text-sm font-medium">Tugas Selesai</p>
                                    <p class="text-2xl font-bold text-blue-800">{{ $metrics['tasks_completed'] }}</p>
                                </div>
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-xl border border-yellow-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-yellow-600 text-sm font-medium">Tugas Pending</p>
                                    <p class="text-2xl font-bold text-yellow-800">{{ $metrics['tasks_pending'] }}</p>
                                </div>
                                <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl border border-red-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-red-600 text-sm font-medium">Tugas Overdue</p>
                                    <p class="text-2xl font-bold text-red-800">{{ $metrics['tasks_overdue'] }}</p>
                                </div>
                                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-600 text-sm font-medium">Skor Performa</p>
                                    <p class="text-2xl font-bold text-green-800">{{ $metrics['performance_score'] }}%</p>
                                </div>
                                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    @if(!empty($metrics['department_specific']))
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 rounded-xl border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Metrics Khusus Departemen</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($metrics['department_specific'] as $key => $value)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 capitalize">{{ str_replace('_', ' ', $key) }}</span>
                                <span class="font-semibold text-gray-900">{{ $value }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Photo Grid Section -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent mb-4">Galeri Operasional Internal</h3>
                        <div class="w-16 h-1 bg-gradient-to-r from-orange-500 to-red-500 mx-auto rounded-full"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&h=300&fit=crop&crop=center" alt="Tim Operasional" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Tim Operasional Profesional</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=300&fit=crop&crop=center" alt="Dashboard Analytics" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Dashboard dan Analytics</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=300&fit=crop&crop=center" alt="Meeting Room" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Ruang Meeting dan Kolaborasi</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=400&h=300&fit=crop&crop=center" alt="Server Infrastructure" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Infrastruktur Server</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=400&h=300&fit=crop&crop=center" alt="Team Collaboration" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Kolaborasi Tim</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=400&h=300&fit=crop&crop=center" alt="Innovation Hub" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Pusat Inovasi dan Pengembangan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Operations</h4>
                    <p class="text-gray-600 mb-4">Kelola operasional harian dan proses bisnis perusahaan.</p>
                    <a href="{{ route('departments.operations') }}" class="text-blue-600 hover:text-blue-700 font-medium">Akses Dashboard →</a>
                </div>



                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Sales & Marketing</h4>
                    <p class="text-gray-600 mb-4">Pantau penjualan, kampanye marketing, dan analisis pasar.</p>
                    <a href="{{ route('departments.sales-marketing') }}" class="text-green-600 hover:text-green-700 font-medium">Lihat Laporan →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Finance</h4>
                    <p class="text-gray-600 mb-4">Kelola keuangan, pembayaran, dan laporan finansial.</p>
                    <a href="{{ route('departments.finance') }}" class="text-orange-600 hover:text-orange-700 font-medium">Akses Finance →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Product R&D</h4>
                    <p class="text-gray-600 mb-4">Kembangkan produk baru dan inovasi layanan.</p>
                    <a href="{{ route('departments.product-rnd') }}" class="text-purple-600 hover:text-purple-700 font-medium">Akses R&D →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">IT</h4>
                    <p class="text-gray-600 mb-4">Kelola infrastruktur IT, sistem, dan dukungan teknis.</p>
                    <a href="{{ route('departments.it') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Akses IT →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Academic</h4>
                    <p class="text-gray-600 mb-4">Kelola kurikulum, materi pembelajaran, dan standar akademik.</p>
                    <a href="{{ route('departments.academic') }}" class="text-teal-600 hover:text-teal-700 font-medium">Akses Academic →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
