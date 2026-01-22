@extends('layouts.app')

@section('content')
@auth
    @if(in_array(auth()->user()->role, ['student', 'teacher']))
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">📊 Progres Pembelajaran Detail</h1>
            <p class="mt-2 text-gray-600">Lihat analisis lengkap progres pembelajaran Anda</p>
        </div>

        <!-- Overall Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-md p-6 text-white">
                <p class="text-sm font-semibold opacity-90">Rata-rata Progres</p>
                <p class="text-4xl font-bold mt-2">{{ round($totalProgress, 0) }}%</p>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-md p-6 text-white">
                <p class="text-sm font-semibold opacity-90">Program Selesai</p>
                <p class="text-4xl font-bold mt-2">{{ $completedPrograms }}</p>
            </div>
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg shadow-md p-6 text-white">
                <p class="text-sm font-semibold opacity-90">On Track</p>
                <p class="text-4xl font-bold mt-2">{{ $onTrackPrograms }}</p>
            </div>
            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg shadow-md p-6 text-white">
                <p class="text-sm font-semibold opacity-90">Tertinggal</p>
                <p class="text-4xl font-bold mt-2">{{ $behindPrograms }}</p>
            </div>
        </div>

        <!-- Detailed Progress Per Program -->
        <div class="space-y-6">
            @forelse($detailed as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="p-6">
                    <!-- Program Header -->
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $item['program']->name }}</h2>
                            <p class="text-sm text-gray-600 mt-1">Total Progress: <span class="font-semibold">{{ round($item['progress']->overall_progress_percentage, 1) }}%</span></p>
                        </div>
                        @php
                        $statusClasses = match($item['progress']->status) {
                            'completed' => 'bg-green-100 text-green-800',
                            'on_track' => 'bg-blue-100 text-blue-800',
                            'ahead' => 'bg-purple-100 text-purple-800',
                            default => 'bg-red-100 text-red-800'
                        };
                        @endphp
                        <span class="inline-block px-4 py-2 rounded-lg font-semibold {{ $statusClasses }}">
                            {{ ucfirst($item['progress']->status) }}
                        </span>
                    </div>

                    <!-- Main Progress Bar -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-semibold text-gray-700">Overall Progress</span>
                            <span class="text-sm font-bold text-gray-900">{{ round($item['progress']->overall_progress_percentage, 1) }}%</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-blue-600 h-3 rounded-full transition-all duration-300" style="width: {{ $item['progress']->overall_progress_percentage }}%"></div>
                        </div>
                    </div>

                    <!-- Breakdown by Category -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Materials -->
                        <div class="border rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">📚 Materi Pembelajaran</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">Selesai</span>
                                    <span class="font-bold text-blue-600">{{ $item['progress']->completed_materials }}/{{ $item['progress']->total_materials }}</span>
                                </div>
                                <div class="bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $item['completionRate']['materials'] }}%"></div>
                                </div>
                                <p class="text-sm text-gray-600">{{ $item['completionRate']['materials'] }}% selesai</p>
                            </div>
                        </div>

                        <!-- Assignments -->
                        <div class="border rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">✅ Tugas & Pekerjaan</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">Selesai</span>
                                    <span class="font-bold text-green-600">{{ $item['progress']->completed_assignments }}/{{ $item['progress']->total_assignments }}</span>
                                </div>
                                <div class="bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $item['completionRate']['assignments'] }}%"></div>
                                </div>
                                <p class="text-sm text-gray-600">{{ $item['completionRate']['assignments'] }}% selesai</p>
                                @if($item['progress']->average_assignment_score)
                                <p class="text-sm font-medium text-gray-700">Rata-rata: {{ round($item['progress']->average_assignment_score, 1) }}%</p>
                                @endif
                            </div>
                        </div>

                        <!-- Quizzes -->
                        <div class="border rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">📝 Kuis & Tes</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">Selesai</span>
                                    <span class="font-bold text-purple-600">{{ $item['progress']->completed_quizzes }}/{{ $item['progress']->total_quizzes }}</span>
                                </div>
                                <div class="bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $item['completionRate']['quizzes'] }}%"></div>
                                </div>
                                <p class="text-sm text-gray-600">{{ $item['completionRate']['quizzes'] }}% selesai</p>
                                @if($item['progress']->average_quiz_score)
                                <p class="text-sm font-medium text-gray-700">Rata-rata: {{ round($item['progress']->average_quiz_score, 1) }}%</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Info -->
                    <div class="mt-6 pt-6 border-t grid grid-cols-1 md:grid-cols-3 gap-4">
                        @if($item['progress']->started_at)
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Mulai</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $item['progress']->started_at->format('d M Y') }}</p>
                        </div>
                        @endif
                        @if($item['progress']->completed_at)
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Selesai</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $item['progress']->completed_at->format('d M Y') }}</p>
                        </div>
                        @endif
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Status</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">
                                @if($item['progress']->status === 'completed')
                                ✅ Program Selesai
                                @elseif($item['progress']->status === 'on_track')
                                🎯 Sesuai Jadwal
                                @elseif($item['progress']->status === 'ahead')
                                🚀 Lebih Cepat
                                @else
                                ⏰ Tertinggal
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <p class="text-gray-600 text-lg">Belum ada data progres pembelajaran</p>
            </div>
            @endforelse
        </div>

        <!-- Overall Learning Statistics -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Learning Activity -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">📈 Aktivitas Pembelajaran</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b">
                        <span class="text-gray-700">Total Materi Dikerjakan</span>
                        <span class="text-lg font-bold text-blue-600">{{ $progressData->sum('completed_materials') }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b">
                        <span class="text-gray-700">Total Tugas Dikumpulkan</span>
                        <span class="text-lg font-bold text-green-600">{{ $progressData->sum('completed_assignments') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">Total Kuis Diselesaikan</span>
                        <span class="text-lg font-bold text-purple-600">{{ $progressData->sum('completed_quizzes') }}</span>
                    </div>
                </div>
            </div>

            <!-- Status Summary -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">🎯 Ringkasan Status</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-green-500 rounded-full mr-3"></span>
                            <span class="text-gray-700">Program Selesai</span>
                        </div>
                        <span class="font-bold text-gray-900">{{ $completedPrograms }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-blue-500 rounded-full mr-3"></span>
                            <span class="text-gray-700">Program On Track</span>
                        </div>
                        <span class="font-bold text-gray-900">{{ $onTrackPrograms }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-purple-500 rounded-full mr-3"></span>
                            <span class="text-gray-700">Program Ahead</span>
                        </div>
                        <span class="font-bold text-gray-900">{{ $aheadPrograms }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="w-3 h-3 bg-red-500 rounded-full mr-3"></span>
                            <span class="text-gray-700">Program Behind</span>
                        </div>
                        <span class="font-bold text-gray-900">{{ $behindPrograms }}</span>
                    </div>
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
@endsection
