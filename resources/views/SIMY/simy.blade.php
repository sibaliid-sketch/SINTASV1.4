<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent leading-tight">
            {{ __('SIMY - Learning Management System') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Halo! {{ auth()->user()->name }}, Selamat Datang di SIMY</h3>
                            <p class="text-gray-600">Sistem pembelajaran online untuk siswa dengan fitur lengkap dan interaktif.</p>
                        </div>
                    </div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        SIMY adalah platform pembelajaran digital yang dirancang khusus untuk mendukung proses belajar siswa. Dengan antarmuka yang intuitif dan fitur-fitur canggih, siswa dapat mengakses materi pembelajaran, mengerjakan tugas, dan memantau perkembangan akademik secara real-time.
                    </p>
                    @if(auth()->user()->role === 'student_over_18')
                        <div class="bg-gradient-to-r from-purple-50 to-blue-50 border border-purple-200 rounded-xl p-6 mb-6">
                            <h4 class="text-lg font-semibold text-purple-900 mb-2">🎓 Fitur Khusus untuk Siswa >18 Tahun</h4>
                            <p class="text-purple-700">Anda memiliki akses ke fitur SITRA untuk pengelolaan pembayaran dan aktivitas tambahan.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Photo Grid Section -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="text-center mb-12">
                        <h3 class="text-3xl font-serif font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-6">Galeri Pembelajaran</h3>
                        <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 fade-in-up">
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 fade-in-up">
                            <img src="https://images.unsplash.com/photo-1588072432836-e10032774350?w=400&h=300&fit=crop&crop=center" alt="Kelas Online" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Kelas Online Interaktif</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=300&fit=crop&crop=center" alt="Materi Digital" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Materi Pembelajaran Digital</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=300&fit=crop&crop=center" alt="Tugas Praktis" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Tugas dan Latihan Praktis</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=300&fit=crop&crop=center" alt="Diskusi Grup" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Diskusi dan Kolaborasi</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=300&fit=crop&crop=center" alt="Progress Tracking" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Pelacakan Progress Belajar</p>
                            </div>
                        </div>
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=400&h=300&fit=crop&crop=center" alt="Sertifikat" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <p class="text-white font-semibold">Sertifikat dan Penghargaan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 fade-in-up">
                <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 float">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-serif font-semibold text-gray-900 mb-4">Materi Pembelajaran</h4>
                    <p class="text-gray-600 mb-6 text-lg">Akses materi lengkap sesuai kurikulum dengan format multimedia interaktif.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-lg">Akses Materi →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-teal-500 rounded-2xl flex items-center justify-center mb-6 float">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-serif font-semibold text-gray-900 mb-4">Tugas & Ujian</h4>
                    <p class="text-gray-600 mb-6 text-lg">Kerjakan tugas dan ujian online dengan sistem penilaian otomatis.</p>
                    <a href="#" class="text-green-600 hover:text-green-700 font-medium text-lg">Lihat Tugas →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mb-6 float">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-serif font-semibold text-gray-900 mb-4">Progress Belajar</h4>
                    <p class="text-gray-600 mb-6 text-lg">Pantau perkembangan belajar Anda dengan dashboard analitik lengkap.</p>
                    <a href="#" class="text-orange-600 hover:text-orange-700 font-medium text-lg">Lihat Progress →</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
