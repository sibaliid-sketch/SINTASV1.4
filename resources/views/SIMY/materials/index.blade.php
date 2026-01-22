@extends('layouts.app')

@section('content')
@auth
    @if(in_array(auth()->user()->role, ['student', 'teacher']))
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">📚 Materi Pembelajaran</h1>
                <p class="mt-2 text-gray-600">Akses semua materi pembelajaran yang tersedia</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filter Program</label>
                    <select id="programFilter" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Program</option>
                        @foreach($filterPrograms as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Materi</label>
                    <select id="typeFilter" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Jenis</option>
                        @foreach($types as $type)
                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                    <input type="text" id="searchInput" placeholder="Cari materi..." class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- Materials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse($materials as $material)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="relative bg-gradient-to-r from-blue-500 to-purple-600 h-40">
                    @if($material->thumbnail_url)
                    <img src="{{ $material->thumbnail_url }}" alt="{{ $material->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="text-4xl">📄</span>
                    </div>
                    @endif
                    <div class="absolute top-2 right-2">
                        <span class="inline-block px-3 py-1 bg-white text-gray-900 text-xs font-semibold rounded-full">
                            {{ ucfirst($material->type) }}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-xs text-gray-500 mb-2">{{ $material->program->name }}</p>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $material->title }}</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $material->description }}</p>
                    
                    <div class="space-y-3">
                        @if($material->duration)
                        <div class="flex items-center text-xs text-gray-600">
                            <span class="mr-2">⏱️</span>
                            <span>{{ $material->duration }} menit</span>
                        </div>
                        @endif
                        
                        <div class="flex items-center gap-2 text-xs text-gray-600">
                            <span>📝</span>
                            <span>{{ $material->notes->count() }} catatan</span>
                            <span>•</span>
                            <span>{{ $material->quizzes->count() }} kuis</span>
                        </div>
                    </div>

                    <a href="{{ route('simy.materials.show', $material) }}" class="mt-4 block w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg text-center transition">
                        Buka Materi
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600 text-lg">Tidak ada materi pembelajaran yang tersedia</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($materials->hasPages())
        <div class="mt-8">
            {{ $materials->links() }}
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
