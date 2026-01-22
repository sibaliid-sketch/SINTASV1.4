<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $child->name }} - Laporan Akademik
        </h2>
    </x-slot>

    @auth
        @if(auth()->user()->role === 'parent')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Laporan Akademik Bulanan</h2>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Bulan</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Tugas Selesai</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Nilai Rata-rata</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Kehadiran</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($monthlyStats as $stat)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $stat['month'] }}</td>
                                    <td class="py-3 px-4 font-medium">{{ $stat['assignments_completed'] }}</td>
                                    <td class="py-3 px-4"><span class="font-bold text-blue-600">{{ $stat['average_grade'] }}</span></td>
                                    <td class="py-3 px-4"><span class="font-bold text-green-600">{{ $stat['attendance_rate'] }}%</span></td>
                                    <td class="py-3 px-4">
                                        <a href="{{ route('sitra.child.reports.download', [$child->id, 'academic']) }}" class="text-blue-600 hover:underline text-xs">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-500">Belum ada laporan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Progress by Program -->
            <div class="bg-white rounded-lg shadow p-6 mt-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Progres Per Program</h2>
                <div class="space-y-6">
                    @forelse($progressData as $progress)
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="font-semibold text-gray-900">{{ $progress->program->name }}</h3>
                                <span class="text-sm font-bold text-green-600">{{ $progress->overall_progress_percentage }}%</span>
                            </div>
                            <div class="w-full h-3 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" style="width: {{ $progress->overall_progress_percentage }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada data progres</p>
                    @endforelse
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ route('sitra.dashboard') }}" class="inline-block px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                    Kembali
                </a>
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
