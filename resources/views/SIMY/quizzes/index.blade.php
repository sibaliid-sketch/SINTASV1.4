@extends('layouts.app')

@section('content')
@auth
    @if(in_array(auth()->user()->role, ['student', 'teacher']))
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">📝 Kuis & Tes Praktik</h1>
            <p class="mt-2 text-gray-600">Kuji pemahaman Anda melalui berbagai kuis dan tes</p>
        </div>

        <!-- Quizzes List -->
        <div class="space-y-4">
            @forelse($quizzes as $quiz)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="mb-3">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $quiz->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $quiz->material->title ?? $quiz->program->name }}</p>
                        </div>

                        <p class="text-gray-700 mb-4 line-clamp-2">{{ $quiz->description }}</p>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Soal</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">{{ $quiz->total_questions }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Nilai Lulus</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">{{ $quiz->passing_score }}%</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Percobaan</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">
                                    @if($quiz->attempt_limit)
                                    {{ count($quiz->attempts) }}/{{ $quiz->attempt_limit }}
                                    @else
                                    Unlimited
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 uppercase">Nilai Terbaik</p>
                                @php
                                $scoreClass = count($quiz->attempts) > 0 ? 'text-blue-600' : 'text-gray-500';
                                @endphp
                                <p class="text-lg font-bold {{ $scoreClass }} mt-1">
                                    {{ count($quiz->attempts) > 0 ? max($quiz->attempts->pluck('percentage')->toArray()) . '%' : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($quiz->attempt_limit && count($quiz->attempts) >= $quiz->attempt_limit)
                    <button disabled class="ml-4 px-6 py-3 bg-gray-300 text-gray-700 font-medium rounded-lg cursor-not-allowed whitespace-nowrap">
                        ✓ Percobaan Habis
                    </button>
                    @else
                    <a href="{{ route('simy.quizzes.show', $quiz) }}" class="ml-4 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition whitespace-nowrap">
                        Mulai Kuis
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <p class="text-gray-600 text-lg">Tidak ada kuis yang tersedia</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($quizzes->hasPages())
        <div class="mt-8">
            {{ $quizzes->links() }}
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
