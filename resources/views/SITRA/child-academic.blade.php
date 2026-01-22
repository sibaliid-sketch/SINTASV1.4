<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $child->name }} - Informasi Akademik
        </h2>
    </x-slot>

    @auth
        @if(auth()->user()->role === 'parent')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6 text-sm text-gray-600">
                <a href="{{ route('sitra.dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a>
                <span class="mx-2">/</span>
                <span>Akademik</span>
            </div>

            <!-- Progress Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @foreach($progressData as $progress)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $progress->program->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4">Status: <span class="font-medium text-green-600">{{ $progress->status }}</span></p>
                        
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs font-medium text-gray-600">Progress</span>
                                <span class="text-sm font-bold text-green-600">{{ $progress->overall_progress_percentage }}%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" style="width: {{ $progress->overall_progress_percentage }}%"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-2 text-xs">
                            <div>
                                <p class="text-gray-600">Materi</p>
                                <p class="font-bold text-gray-900">{{ $progress->completed_materials }}/{{ $progress->total_materials }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Tugas</p>
                                <p class="font-bold text-gray-900">{{ $progress->completed_assignments }}/{{ $progress->total_assignments }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Kuis</p>
                                <p class="font-bold text-gray-900">{{ $progress->completed_quizzes }}/{{ $progress->total_quizzes }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Achievements -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Pencapaian & Prestasi</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @forelse($achievements as $achievement)
                        <div class="text-center p-4 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-lg">
                            <div class="text-4xl mb-2">🏆</div>
                            <h3 class="text-sm font-semibold text-gray-900">{{ $achievement->title }}</h3>
                            <p class="text-xs text-gray-600 mt-1">{{ $achievement->earned_at->format('d M Y') }}</p>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-500 py-8">Belum ada pencapaian</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Grades -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Nilai Terbaru</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Program</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Mata Pelajaran</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Nilai</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentGrades as $grade)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $grade->program->name ?? '-' }}</td>
                                    <td class="py-3 px-4">{{ $grade->subject ?? '-' }}</td>
                                    <td class="py-3 px-4"><span class="font-bold text-green-600">{{ $grade->value }}</span></td>
                                    <td class="py-3 px-4 text-gray-600">{{ $grade->created_at->format('d M Y') }}</td>
                                    <td class="py-3 px-4 text-gray-600 text-xs">{{ $grade->note ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-500">Belum ada nilai</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
