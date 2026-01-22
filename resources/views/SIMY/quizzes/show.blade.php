@extends('layouts.app')

@section('content')
@auth
    @if(in_array(auth()->user()->role, ['student', 'teacher']))
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <a href="{{ route('simy.quizzes.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Kuis</a>
        </div>

        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <h1 class="text-3xl font-bold text-gray-900">{{ $quiz->title }}</h1>
            <p class="mt-3 text-gray-600">{{ $quiz->description }}</p>

            <!-- Meta Information -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 border-t pt-6 mt-6">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Total Soal</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $quiz->total_questions }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Nilai Lulus</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $quiz->passing_score }}%</p>
                </div>
                @if($quiz->time_limit)
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Waktu Limit</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $quiz->time_limit }} menit</p>
                </div>
                @endif
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Percobaan Anda</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">
                        @if($quiz->attempt_limit)
                        {{ $attempts->count() }}/{{ $quiz->attempt_limit }}
                        @else
                        {{ $attempts->count() }}/∞
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Nilai Terbaik</p>
                    <p class="mt-1 text-lg font-bold text-blue-600">{{ $bestScore ?? '-' }}%</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Start Quiz Button -->
                @if($canAttempt)
                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-900 mb-3">Mulai Kuis Baru</h2>
                    <p class="text-blue-700 mb-4">Klik tombol di bawah untuk memulai percobaan kuis yang baru</p>
                    <a href="{{ route('simy.quizzes.create-attempt', $quiz) }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        🚀 Mulai Kuis Sekarang
                    </a>
                </div>
                @else
                <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-red-900 mb-2">Percobaan Kuis Habis</h2>
                    <p class="text-red-700">Anda telah mencapai batas maksimal percobaan untuk kuis ini.</p>
                </div>
                @endif

                <!-- Quiz Instructions -->
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">📋 Instruksi Kuis</h2>
                    <div class="prose prose-sm max-w-none">
                        {!! nl2br(e($quiz->instruction ?? 'Ikuti instruksi di bawah saat mengerjakan kuis.')) !!}
                    </div>
                </div>

                <!-- Attempt History -->
                @if($attempts->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">📊 Riwayat Percobaan</h2>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">#</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">Waktu</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">Nilai</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">Persentase</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attempts as $attempt)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $attempt->completed_at?->format('d M Y, H:i') ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900">
                                        {{ $attempt->score ?? '-' }}/{{ $attempt->total_points ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @php
                                        $percentageClass = $attempt->percentage >= $quiz->passing_score ? 'text-green-600' : 'text-red-600';
                                        @endphp
                                        <span class="font-semibold {{ $percentageClass }}">
                                            {{ $attempt->percentage ?? '-' }}%
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if($attempt->passed)
                                        <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">✅ LULUS</span>
                                        @else
                                        <span class="inline-block px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-semibold">❌ TIDAK LULUS</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <p class="text-xs font-semibold text-blue-600 uppercase">Rata-rata Nilai</p>
                            <p class="text-2xl font-bold text-blue-900 mt-1">{{ round($averageScore, 2) }}%</p>
                        </div>
                        <div class="p-4 bg-green-50 rounded-lg">
                            <p class="text-xs font-semibold text-green-600 uppercase">Nilai Terbaik</p>
                            <p class="text-2xl font-bold text-green-900 mt-1">{{ $bestScore }}%</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quiz Info Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">ℹ️ Informasi Kuis</h3>
                    
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Tipe Soal</p>
                            <p class="text-sm text-gray-900 mt-1">
                                @if($quiz->shuffle_questions) ✅ @else ❌ @endif Soal Diacak
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Jawaban Benar</p>
                            <p class="text-sm text-gray-900 mt-1">
                                @if($quiz->show_correct_answers) ✅ Ditampilkan @else ❌ Tidak Ditampilkan @endif
                            </p>
                        </div>
                        <div class="pt-3 border-t">
                            <p class="text-xs font-semibold text-gray-500 uppercase">Status Lulus</p>
                            <p class="text-sm font-bold mt-2">
                                @if($bestScore && $bestScore >= $quiz->passing_score)
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded">✅ LULUS</span>
                                @elseif($bestScore)
                                <span class="inline-block px-3 py-1 bg-red-100 text-red-800 rounded">❌ BELUM LULUS</span>
                                @else
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded">⏳ BELUM DICOBA</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tips Card -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-yellow-900 mb-3">💡 Tips Mengerjakan</h3>
                    <ul class="text-sm text-yellow-800 space-y-2">
                        <li>✓ Baca soal dengan seksama</li>
                        <li>✓ Kelola waktu Anda dengan baik</li>
                        <li>✓ Jangan terburu-buru</li>
                        <li>✓ Periksa kembali jawaban Anda</li>
                    </ul>
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
