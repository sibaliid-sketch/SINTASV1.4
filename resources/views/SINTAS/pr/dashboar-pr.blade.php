<x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent leading-tight">
                    {{ __('SINTAS - Sistem Internal (PR)') }}
                </h2>
            </x-slot>

    <!-- Include Department Sidebar -->
    @include('SINTAS.pr.pr-sidebar')

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Selamat Datang di SINTAS (PR)</h3>
                            <p class="text-gray-600">Kelola komunikasi publik, media relations, dan branding perusahaan.</p>
                        </div>
                    </div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        Departemen Public Relations bertanggung jawab atas pengelolaan citra perusahaan, komunikasi dengan media, pengembangan strategi branding, dan pengelolaan krisis komunikasi.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Media Relations</h4>
                    <p class="text-gray-600 mb-4">Kelola hubungan dengan media dan distribusi berita perusahaan.</p>
                    <a href="#" class="text-purple-600 hover:text-purple-700 font-medium">Kelola Media →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-9 0V1m10 3V1m0 3l1 1v16a2 2 0 01-2 2H6a2 2 0 01-2-2V5l1-1z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Press Releases</h4>
                    <p class="text-gray-600 mb-4">Buat dan distribusikan press release untuk komunikasi perusahaan.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Buat Press Release →</a>
                </div>

                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Brand Management</h4>
                    <p class="text-gray-600 mb-4">Kelola identitas merek dan strategi branding perusahaan.</p>
                    <a href="#" class="text-green-600 hover:text-green-700 font-medium">Kelola Brand →</a>
                </div>
            </div>

            <!-- Attendance Data Section -->
            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-gray-200/50">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-semibold text-gray-900">Data Absensi Tim PR</h3>
                    <a href="{{ route('departments.overview.pr') }}" class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-lg hover:from-purple-600 hover:to-pink-600 transition-colors">
                        Lihat Overview Lengkap →
                    </a>
                </div>

                @if($attendances->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PIN</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Device</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($attendances as $attendance)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $attendance->pin }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $attendance->date_time->format('d/m/Y H:i:s') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $attendance->device_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Check-in
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data absensi</h3>
                        <p class="mt-1 text-sm text-gray-500">Data absensi akan muncul setelah sistem Fingerspot terintegrasi.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
