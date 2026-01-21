<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent leading-tight">
            {{ __('Admin - Kelola Absensi Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filter Section -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter Data Absensi</h3>
                    
                    <form method="GET" action="{{ route('attendance.admin.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                            <input type="date" name="date" value="{{ request('date', today()->format('Y-m-d')) }}" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                            <select name="department" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="">Semua Departemen</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                        {{ ucfirst($dept) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="">Semua Status</option>
                                <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Hadir</option>
                                <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Terlambat</option>
                                <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Tidak Hadir</option>
                                <option value="leave" {{ request('status') == 'leave' ? 'selected' : '' }}>Cuti</option>
                                <option value="sick" {{ request('status') == 'sick' ? 'selected' : '' }}>Sakit</option>
                                <option value="permission" {{ request('status') == 'permission' ? 'selected' : '' }}>Izin</option>
                            </select>
                        </div>
                        
                        <div class="flex items-end gap-2">
                            <button type="submit" class="flex-1 bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('attendance.admin.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition duration-300">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                @php
                    $totalPresent = $attendances->where('status', 'present')->count();
                    $totalLate = $attendances->where('status', 'late')->count();
                    $totalAbsent = $attendances->where('status', 'absent')->count();
                    $totalLeave = $attendances->whereIn('status', ['leave', 'sick', 'permission'])->count();
                @endphp
                
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Hadir</p>
                            <p class="text-3xl font-bold text-green-600">{{ $totalPresent }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 border border-orange-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Terlambat</p>
                            <p class="text-3xl font-bold text-orange-600">{{ $totalLate }}</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 border border-red-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Tidak Hadir</p>
                            <p class="text-3xl font-bold text-red-600">{{ $totalAbsent }}</p>
                        </div>
                        <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Izin/Cuti</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $totalLeave }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Daftar Absensi - {{ request('date') ? \Carbon\Carbon::parse(request('date'))->isoFormat('D MMMM YYYY') : 'Hari Ini' }}
                        </h3>
                        <a href="{{ route('attendance.admin.export') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export
                        </a>
                    </div>

                    @if($attendances->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Karyawan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departemen</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($attendances as $attendance)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        @if($attendance->user->avatar)
                                                            <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $attendance->user->avatar) }}" alt="">
                                                        @else
                                                            <div class="h-10 w-10 rounded-full bg-purple-500 flex items-center justify-center text-white font-semibold">
                                                                {{ strtoupper(substr($attendance->user->name, 0, 1)) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $attendance->user->name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $attendance->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ ucfirst($attendance->user->department ?? '-') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($attendance->check_in)
                                                    <div>{{ $attendance->check_in->format('H:i') }}</div>
                                                    @if($attendance->is_late)
                                                        <span class="text-xs text-orange-600">⚠️ Terlambat</span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $attendance->location ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $attendance->notes ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $attendances->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
                            <p class="mt-1 text-sm text-gray-500">Tidak ada data absensi untuk filter yang dipilih.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
