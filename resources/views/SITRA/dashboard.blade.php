<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent leading-tight">
                {{ __('SITRA - Sistem Informasi Transparansi Akademik') }}
            </h2>

            <!-- Search Bar -->
            <div class="relative max-w-md w-full">
                <input type="text" placeholder="Cari anak, laporan, atau pembayaran..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white/80 backdrop-blur-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </x-slot>

    @auth
        @if(auth()->user()->role === 'parent')
            <!-- Include SITRA Sidebar -->
            @include('SITRA.sitra-sidebar')

            <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Card -->
            <div class="mb-8 bg-gradient-to-r from-green-600 to-teal-600 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}! 👨‍👩‍👧</h1>
                            <p class="text-green-100 text-lg">Pantau perkembangan belajar anak Anda dengan mudah dan transparan</p>
                        </div>
                        <div class="text-6xl opacity-20">👨‍👩‍👧‍👦</div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Total Anak</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $childrenData->count() ?? 0 }}</p>
                        </div>
                        <div class="text-4xl">👧</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Rata-rata Kehadiran</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ round(($childrenData->avg('attendance_rate') ?? 0), 1) }}%</p>
                        </div>
                        <div class="text-4xl">📍</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Tugas Menunggu</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $childrenData->sum('pending_assignments') ?? 0 }}</p>
                        </div>
                        <div class="text-4xl">📝</div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Sertifikat Anak</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $childrenData->sum('certificates') ?? 0 }}</p>
                        </div>
                        <div class="text-4xl">🏆</div>
                    </div>
                </div>
            </div>

            <!-- Children Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @forelse($childrenData as $childData)
                    <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                        <!-- Header with Child Name -->
                        <div class="bg-gradient-to-r from-green-500 to-teal-500 p-4 text-white">
                            <h3 class="text-lg font-semibold">{{ $childData['user']->name }}</h3>
                            <p class="text-sm text-green-100">{{ $childData['user']->email }}</p>
                        </div>

                        <!-- Child Info -->
                        <div class="p-6">
                            <!-- Progress Bar -->
                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-600">Progres Pembelajaran</span>
                                    <span class="text-sm font-bold text-green-600">{{ $childData['progress']->overall_progress_percentage ?? 0 }}%</span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-green-500 to-teal-500" style="width: {{ $childData['progress']->overall_progress_percentage ?? 0 }}%"></div>
                                </div>
                            </div>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <p class="text-xs text-gray-600 mb-1">Tugas Menunggu</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $childData['pending_assignments'] }}</p>
                                </div>
                                <div class="bg-purple-50 p-4 rounded-lg">
                                    <p class="text-xs text-gray-600 mb-1">Kehadiran</p>
                                    <p class="text-2xl font-bold text-purple-600">{{ $childData['attendance_rate'] }}%</p>
                                </div>
                            </div>

                            <!-- Recent Grades -->
                            <div class="mb-6">
                                <h4 class="text-sm font-semibold text-gray-700 mb-3">Nilai Terbaru</h4>
                                @if($childData['grades']->count() > 0)
                                    <div class="space-y-2">
                                        @foreach($childData['grades']->take(3) as $grade)
                                            <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                                <span class="text-xs text-gray-600">{{ $grade->program->name ?? 'Program' }}</span>
                                                <span class="text-sm font-bold text-green-600">{{ $grade->score }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500">Belum ada nilai</p>
                                @endif
                            </div>

                            <!-- Next Classes -->
                            @if($childData['next_classes']->count() > 0)
                                <div class="mb-6">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Kelas Berikutnya</h4>
                                    <div class="space-y-2">
                                        @foreach($childData['next_classes']->take(2) as $schedule)
                                            <div class="flex items-center p-2 bg-green-50 rounded">
                                                <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2a1 1 0 100 2v10a2 2 0 002 2h12a2 2 0 002-2V9a1 1 0 100-2V5a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h12a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                                </svg>
                                                <div class="flex-1">
                                                    <p class="text-xs font-medium text-gray-700">{{ $schedule->program->name }}</p>
                                                    <p class="text-xs text-gray-500">{{ $schedule->start_date->format('d M') }} {{ $schedule->start_time }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <a href="{{ route('sitra.child.academic', $childData['user']->id) }}" class="flex-1 py-2 px-3 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    Akademik
                                </a>
                                <a href="{{ route('sitra.child.payments', $childData['user']->id) }}" class="flex-1 py-2 px-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    Pembayaran
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl shadow-md p-12 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3.662a1.97 1.97 0 01-1.882-2.606l2.716-9.896A6 6 0 0115.75 6h.006c.04 0 .082 0 .122.001a6.001 6.001 0 015.45 9.588M9 7l6 6m0 0l6 6m-6-6l-6 6m6-6l6-6"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Anak Terdaftar</h3>
                        <p class="text-gray-600 mb-6">Anda belum memiliki anak yang terdaftar di sistem. Silakan lakukan pendaftaran untuk memulai.</p>
                        <a href="{{ route('registration.step1') }}" class="inline-block px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                            Daftar Anak
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 p-6 hover:shadow-xl transition-shadow duration-300">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path>
                        </svg>
                        Laporan Akademik
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">Lihat laporan lengkap perkembangan akademik anak Anda</p>
                    @if(isset($childrenData[0]))
                        <a href="{{ route('sitra.child.reports', $childrenData[0]['user']->id) }}" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                            Buka Laporan
                        </a>
                    @endif
                </div>

                <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 p-6 hover:shadow-xl transition-shadow duration-300">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        Pesan & Komunikasi
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">Berkomunikasi langsung dengan guru dan staf</p>
                    @if(isset($childrenData[0]))
                        <a href="{{ route('sitra.child.messages', $childrenData[0]['user']->id) }}" class="inline-block px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors">
                            Buka Pesan
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @else
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-8">
                        <h3 class="text-red-800 font-semibold text-lg mb-2">Akses Ditolak</h3>
                        <p class="text-red-600">Anda tidak memiliki izin untuk mengakses SITRA. Hanya orangtua/wali yang dapat mengakses portal transparansi akademik ini.</p>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8">
                    <p class="text-yellow-800">Silakan <a href="{{ route('login') }}" class="text-blue-600 underline font-semibold">login</a> terlebih dahulu untuk mengakses SITRA.</p>
                </div>
            </div>
        </div>
    @endauth
</x-app-layout>
