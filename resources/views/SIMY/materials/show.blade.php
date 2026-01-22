@extends('layouts.app')

@section('content')
@auth
    @if(in_array(auth()->user()->role, ['student', 'teacher']))
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <a href="{{ route('simy.materials.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Materi</a>
        </div>

        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="flex justify-between items-start mb-6">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-2">{{ $material->program->name }}</p>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $material->title }}</h1>
                    <p class="mt-3 text-gray-600">{{ $material->description }}</p>
                </div>
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-lg font-semibold">
                    {{ ucfirst($material->type) }}
                </span>
            </div>

            <!-- Meta Information -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 border-t pt-6">
                @if($material->duration)
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Durasi</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $material->duration }} menit</p>
                </div>
                @endif
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Kuis Terkait</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $material->quizzes->count() }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Catatan Anda</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $notes->count() }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase">Dipublikasikan</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $material->published_at?->format('d M Y') ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Material Content -->
                <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">📖 Konten Materi</h2>
                    <div class="prose prose-sm max-w-none">
                        {!! nl2br(e($material->content)) !!}
                    </div>

                    @if($material->media_url)
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">🎥 Media</h3>
                        @if(strpos($material->media_url, 'youtube') !== false || strpos($material->media_url, 'youtu.be') !== false)
                        <div class="aspect-video bg-black rounded-lg overflow-hidden">
                            <iframe class="w-full h-full" src="{{ $material->media_url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        @else
                        <a href="{{ $material->media_url }}" target="_blank" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                            📥 Buka Media
                        </a>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Related Quizzes -->
                @if($material->quizzes->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">📝 Kuis Terkait</h2>
                    <div class="space-y-3">
                        @foreach($material->quizzes as $quiz)
                        <div class="border rounded-lg p-4 hover:bg-blue-50 transition">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">{{ $quiz->title }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $quiz->questions_count ?? $quiz->questions->count() }} soal • Nilai: {{ $quiz->passing_score }}%
                                    </p>
                                </div>
                                <a href="{{ route('simy.quizzes.show', $quiz) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm font-medium transition">
                                    Mulai
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Assessments -->
                @if($material->assessments->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">✅ Penilaian</h2>
                    <div class="space-y-3">
                        @foreach($material->assessments as $assessment)
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold text-gray-900">{{ $assessment->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $assessment->description }}</p>
                            <p class="text-xs text-gray-500 mt-2">Tipe: {{ ucfirst($assessment->type) }} | Nilai: {{ $assessment->max_score }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Student Notes -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📝 Catatan Saya</h3>
                    @if($notes->count() > 0)
                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @foreach($notes as $note)
                        <div class="border rounded-lg p-3 bg-yellow-50">
                            <p class="text-sm font-medium text-gray-900">{{ $note->title }}</p>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-3">{{ $note->content }}</p>
                            <p class="text-xs text-gray-500 mt-2">{{ $note->created_at->diffForHumans() }}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-600 text-center py-4">Belum ada catatan untuk materi ini</p>
                    @endif

                    <!-- Add Note Form -->
                    <form action="{{ route('simy.notes.store') }}" method="POST" class="mt-4 pt-4 border-t">
                        @csrf
                        <input type="hidden" name="material_id" value="{{ $material->id }}">
                        <textarea name="content" placeholder="Tulis catatan Anda..." class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500" rows="3" required></textarea>
                        <button type="submit" class="mt-2 w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg text-sm transition">
                            💾 Simpan Catatan
                        </button>
                    </form>
                </div>

                <!-- Related Materials -->
                @if($relatedMaterials->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📚 Materi Terkait</h3>
                    <div class="space-y-3">
                        @foreach($relatedMaterials as $relatedMaterial)
                        <a href="{{ route('simy.materials.show', $relatedMaterial) }}" class="block border rounded-lg p-3 hover:bg-blue-50 transition">
                            <p class="font-medium text-gray-900 text-sm">{{ $relatedMaterial->title }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ ucfirst($relatedMaterial->type) }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
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
