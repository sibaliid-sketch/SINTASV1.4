@extends('layouts.app')

@section('content')
@auth
    @if(in_array(auth()->user()->role, ['student', 'teacher']))
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">✅ Tugas & Pekerjaan</h1>
            <p class="mt-2 text-gray-600">Kelola semua tugas dan pekerjaan rumah Anda</p>
        </div>

        <!-- Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <p class="text-sm font-semibold text-green-700 uppercase">Selesai</p>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $completed }}</p>
            </div>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <p class="text-sm font-semibold text-yellow-700 uppercase">Tertunda</p>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pending }}</p>
            </div>
            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                <p class="text-sm font-semibold text-red-700 uppercase">Terlambat</p>
                <p class="text-3xl font-bold text-red-600 mt-2">{{ $overdue }}</p>
            </div>
        </div>

        <!-- Assignments List -->
        <div class="space-y-4">
            @forelse($assignments as $assignment)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $assignment->title }}</h3>
                            @if($assignment->isOverdue() && !$assignment->submissions->first())
                            <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">
                                TERLAMBAT
                            </span>
                            @elseif($assignment->submissions->first())
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                SUDAH DIKUMPULKAN
                            </span>
                            @else
                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">
                                BELUM DIKUMPULKAN
                            </span>
                            @endif
                        </div>

                        <p class="text-sm text-gray-600 mb-3">{{ $assignment->program->name }}</p>
                        <p class="text-gray-700 mb-4 line-clamp-2">{{ $assignment->description }}</p>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Pengajar</p>
                                <p class="text-sm font-medium text-gray-900 mt-1">{{ $assignment->teacher->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Deadline</p>
                                <p class="text-sm font-medium @if($assignment->isOverdue()) text-red-600 @endif mt-1">
                                    {{ $assignment->due_date->format('d M Y, H:i') }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">{{ $assignment->due_date->diffForHumans() }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Nilai Maksimal</p>
                                <p class="text-sm font-medium text-gray-900 mt-1">{{ $assignment->max_score }}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('simy.assignments.show', $assignment) }}" class="ml-4 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition whitespace-nowrap">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <p class="text-gray-600 text-lg">Tidak ada tugas yang tersedia</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($assignments->hasPages())
        <div class="mt-8">
            {{ $assignments->links() }}
        </div>
        @endif
    </div>
</div>
    @else
        <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-red-50 border border-red-200 rounded-lg p-8"><h3 class="text-red-800 font-semibold text-lg mb-2">Akses Ditolak</h3><p class="text-red-600">Anda tidak memiliki izin untuk mengakses halaman ini.</p></div></div></div>
    @endif
@else
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8"><p class="text-yellow-800">Silakan <a href="{{ route('login') }}" class="text-blue-600 underline font-semibold">login</a> terlebih dahulu.</p></div></div></div>
@endauth
@endsection
