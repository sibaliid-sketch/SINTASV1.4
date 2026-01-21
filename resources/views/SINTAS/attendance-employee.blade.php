<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent leading-tight">
            {{ __('Absensi Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Today's Attendance Card -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Absensi Hari Ini</h3>
                            <p class="text-gray-600">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-blue-600">{{ now()->format('H:i') }}</div>
                            <div class="text-sm text-gray-500">Waktu Sekarang</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Check In Card -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-semibold text-gray-900">Check In</h4>
                                @if($todayAttendance && $todayAttendance->check_in)
                                    <span class="px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-full">
                                        Sudah Check In
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-gray-300 text-gray-700 text-xs font-semibold rounded-full">
                                        Belum Check In
                                    </span>
                                @endif
                            </div>

                            @if($todayAttendance && $todayAttendance->check_in)
                                <div class="text-center py-4">
                                    <div class="text-4xl font-bold text-green-600 mb-2">
                                        {{ $todayAttendance->check_in->format('H:i') }}
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        {{ $todayAttendance->check_in->format('d/m/Y') }}
                                    </div>
                                    @if($todayAttendance->is_late)
                                        <div class="mt-3 text-orange-600 text-sm font-semibold">
                                            ⚠️ Terlambat
                                        </div>
                                    @else
                                        <div class="mt-3 text-green-600 text-sm font-semibold">
                                            ✓ Tepat Waktu
                                        </div>
                                    @endif
                                </div>
                            @else
                                <form action="{{ route('attendance.check-in') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="location" value="Office">
                                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 px-6 rounded-xl transition duration-300 transform hover:scale-105">
                                        <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Check In Sekarang
                                    </button>
                                </form>
                                <p class="text-xs text-gray-500 mt-3 text-center">
                                    Jam kerja standar: 09:00 WIB
                                </p>
                            @endif
                        </div>

                        <!-- Check Out Card -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-semibold text-gray-900">Check Out</h4>
                                @if($todayAttendance && $todayAttendance->check_out)
                                    <span class="px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded-full">
                                        Sudah Check Out
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-gray-300 text-gray-700 text-xs font-semibold rounded-full">
                                        Belum Check Out
                                    </span>
                                @endif
                            </div>

                            @if($todayAttendance && $todayAttendance->check_out)
                                <div class="text-center py-4">
                                    <div class="text-4xl font-bold text-blue-600 mb-2">
                                        {{ $todayAttendance->check_out->format('H:i') }}
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        {{ $todayAttendance->check_out->format('d/m/Y') }}
                                    </div>
                                    <div class="mt-3 text-blue-600 text-sm font-semibold">
                                        Durasi: {{ $todayAttendance->working_hours }} jam
                                    </div>
                                </div>
                            @elseif($todayAttendance && $todayAttendance->check_in)
                                <form action="{{ route('attendance.check-out') }}" method="POST" class="mt-4">
                                    @csrf
                                    <textarea name="notes" rows="2" placeholder="Catatan (opsional)" class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 px-6 rounded-xl transition duration-300 transform hover:scale-105">
                                        <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Check Out Sekarang
                                    </button>
                                </form>
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <svg class="w-16 h-16 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <p>Silakan check in terlebih dahulu</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Statistics -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Statistik Bulan Ini</h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 border border-purple-200 text-center">
                            <div class="text-3xl font-bold text-purple-600">{{ $stats['total_days'] }}</div>
                            <div class="text-sm text-gray-600 mt-1">Total Hari</div>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 border border-green-200 text-center">
                            <div class="text-3xl font-bold text-green-600">{{ $stats['present_days'] }}</div>
                            <div class="text-sm text-gray-600 mt-1">Hadir</div>
                        </div>
                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-4 border border-orange-200 text-center">
                            <div class="text-3xl font-bold text-orange-600">{{ $stats['late_days'] }}</div>
                            <div class="text-sm text-gray-600 mt-1">Terlambat</div>
                        </div>
                        <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-4 border border-red-200 text-center">
                            <div class="text-3xl font-bold text-red-600">{{ $stats['absent_days'] }}</div>
                            <div class="text-sm text-gray-600 mt-1">Tidak Hadir</div>
                        </div>
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200 text-center">
                            <div class="text-3xl font-bold text-blue-600">{{ $stats['leave_days'] }}</div>
                            <div class="text-sm text-gray-600 mt-1">Izin/Cuti</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Attendance History -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">Riwayat Absensi Bulan Ini</h3>
                        <a href="{{ route('attendance.history') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                            Lihat Semua →
                        </a>
                    </div>

                    @if($monthlyAttendances->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($monthlyAttendances->take(10) as $attendance)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $attendance->date->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $attendance->check_in ? $attendance->check_in->format('H:i') : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $attendance->check_out ? $attendance->check_out->format('H:i') : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $attendance->working_hours > 0 ? $attendance->working_hours . ' jam' : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusColors = [
                                                        'present' => 'bg-green-100 text-green-800',
                                                        'late' => 'bg-orange-100 text-orange-800',
                                                        'absent' => 'bg-red-100 text-red-800',
                                                        'leave' => 'bg-blue-100 text-blue-800',
                                                        'sick' => 'bg-purple-100 text-purple-800',
                                                        'permission' => 'bg-yellow-100 text-yellow-800',
                                                    ];
                                                    $statusLabels = [
                                                        'present' => 'Hadir',
                                                        'late' => 'Terlambat',
                                                        'absent' => 'Tidak Hadir',
                                                        'leave' => 'Cuti',
                                                        'sick' => 'Sakit',
                                                        'permission' => 'Izin',
                                                    ];
                                                @endphp
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$attendance->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ $statusLabels[$attendance->status] ?? ucfirst($attendance->status) }}
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
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada riwayat absensi</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan melakukan check-in hari ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
