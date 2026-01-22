@extends('layouts.app')

@section('content')
@auth
    @if(in_array(auth()->user()->role, ['student', 'teacher']))
<div class="py-12">>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <a href="{{ route('simy.assignments.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Daftar Tugas</a>
        </div>

        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="flex justify-between items-start mb-6">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $assignment->title }}</h1>
                    <p class="mt-3 text-gray-600">{{ $assignment->description }}</p>
                </div>
                @if($isOverdue && !$submission)
                <span class="inline-block px-4 py-2 bg-red-100 text-red-800 font-semibold rounded-lg">TERLAMBAT</span>
                @elseif($submission)
                <span class="inline-block px-4 py-2 bg-green-100 text-green-800 font-semibold rounded-lg">SUDAH DIKUMPULKAN</span>
                @else
                <span class="inline-block px-4 py-2 bg-yellow-100 text-yellow-800 font-semibold rounded-lg">BELUM DIKUMPULKAN</span>
                @endif
            </div>

            <!-- Meta Information -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 border-t pt-6">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Pengajar</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $assignment->teacher->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Program</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $assignment->program->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Deadline</p>
                    <p class="mt-1 text-lg font-bold {{ $isOverdue ? 'text-red-600' : 'text-gray-900' }}">
                        {{ $assignment->due_date->format('d M Y') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">{{ $assignment->due_date->diffForHumans() }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Nilai Maksimal</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $assignment->max_score }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Instructions -->
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">📋 Instruksi</h2>
                    <div class="prose prose-sm max-w-none">
                        {!! nl2br(e($assignment->instructions)) !!}
                    </div>

                    @if($assignment->attachment_url)
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <p class="text-sm font-medium text-blue-900 mb-2">📎 File Lampiran</p>
                        <a href="{{ $assignment->attachment_url }}" target="_blank" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm font-medium transition">
                            📥 Download Lampiran
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Submission Form -->
                @if(!$isOverdue || $assignment->allow_late_submission)
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">📤 Pengumpulan</h2>

                    @if($submission)
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm font-medium text-green-900">✅ Anda sudah mengumpulkan tugas ini</p>
                        <p class="text-sm text-green-700 mt-1">Dikumpulkan: {{ $submission->submitted_at->format('d M Y, H:i') }}</p>
                        @if($submission->is_late)
                        <p class="text-sm text-yellow-700 mt-1">⚠️ Pengumpulan Terlambat</p>
                        @endif
                        @if($submission->isGraded())
                        <p class="text-sm font-semibold text-green-900 mt-2">Nilai: {{ $submission->score }}/{{ $assignment->max_score }}</p>
                        @endif
                    </div>
                    @endif

                    <form action="{{ route('simy.submissions.store', $assignment) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teks Jawaban</label>
                            <textarea name="submission_text" placeholder="Masukkan jawaban Anda atau deskripsi pengumpulan..." class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="6">{{ $submission->submission_text ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload File (Opsional)</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition cursor-pointer">
                                <input type="file" name="submission_file" class="hidden" id="fileInput">
                                <label for="fileInput" class="cursor-pointer">
                                    <p class="text-gray-600 font-medium">Klik atau drag file ke sini</p>
                                    <p class="text-sm text-gray-500 mt-1">Ukuran maksimal: 10 MB</p>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                            📤 Kumpulkan Tugas
                        </button>
                    </form>

                    @if($isOverdue && $assignment->allow_late_submission)
                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-sm text-yellow-800">⚠️ Pengumpulan ini akan ditandai sebagai terlambat</p>
                    </div>
                    @endif
                </div>
                @else
                <div class="bg-white rounded-lg shadow-md p-8 border-l-4 border-red-500">
                    <h2 class="text-2xl font-semibold text-red-600 mb-2">❌ Pengumpulan Ditutup</h2>
                    <p class="text-gray-600">Deadline untuk tugas ini telah berlalu dan pengumpulan terlambat tidak diizinkan.</p>
                </div>
                @endif

                <!-- Submission History -->
                @if($submission)
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">📝 Riwayat Pengumpulan</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-semibold text-gray-600 uppercase">Waktu Pengumpulan</p>
                            <p class="text-lg text-gray-900 mt-1">{{ $submission->submitted_at->format('d M Y, H:i:s') }}</p>
                        </div>

                        @if($submission->submission_text)
                        <div>
                            <p class="text-sm font-semibold text-gray-600 uppercase">Jawaban</p>
                            <div class="mt-2 p-4 bg-gray-50 rounded-lg border">
                                {{ nl2br(e($submission->submission_text)) }}
                            </div>
                        </div>
                        @endif

                        @if($submission->submission_file_url)
                        <div>
                            <p class="text-sm font-semibold text-gray-600 uppercase">File Pengumpulan</p>
                            <a href="{{ $submission->submission_file_url }}" target="_blank" class="mt-2 inline-block px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded font-medium transition">
                                📥 Download File
                            </a>
                        </div>
                        @endif

                        @if($submission->isGraded())
                        <div class="border-t pt-4">
                            <p class="text-sm font-semibold text-gray-600 uppercase mb-3">Penilaian</p>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-600">Nilai</p>
                                    <p class="text-2xl font-bold text-blue-600 mt-1">{{ $submission->score }}/{{ $assignment->max_score }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600">Persentase</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $submission->getPercentage() }}%</p>
                                </div>
                            </div>

                            @if($submission->feedback)
                            <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                <p class="text-sm font-medium text-blue-900 mb-2">Feedback dari Pengajar</p>
                                <p class="text-gray-700">{{ $submission->feedback }}</p>
                            </div>
                            @endif

                            <p class="text-xs text-gray-500 mt-3">Dinilai: {{ $submission->graded_at->format('d M Y, H:i') }}</p>
                        </div>
                        @else
                        <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                            <p class="text-sm font-medium text-yellow-900">⏳ Menunggu Penilaian</p>
                            <p class="text-sm text-yellow-700 mt-1">Pengajar belum memberikan penilaian untuk pengumpulan Anda</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Info -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">ℹ️ Informasi</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Status Pengumpulan</p>
                            <p class="mt-1 text-lg font-bold">
                                @if($submission)
                                <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded text-sm">✅ Dikumpulkan</span>
                                @else
                                <span class="inline-block px-2 py-1 bg-red-100 text-red-800 rounded text-sm">❌ Belum Dikumpulkan</span>
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Hari Tersisa</p>
                            <p class="mt-1 text-lg font-bold {{ $daysLeft < 0 ? 'text-red-600' : ($daysLeft < 3 ? 'text-yellow-600' : 'text-green-600') }}">
                                @if($daysLeft > 0)
                                {{ $daysLeft }} hari
                                @elseif($daysLeft == 0)
                                Hari ini
                                @else
                                {{ abs($daysLeft) }} hari lalu
                                @endif
                            </p>
                        </div>
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
