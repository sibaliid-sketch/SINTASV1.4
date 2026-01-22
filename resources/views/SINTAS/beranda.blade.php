@extends('layouts.app')

@section('title', 'Beranda - SINTAS')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Beranda</h1>
                <div class="flex items-center space-x-4">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Buat Postingan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Feed -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Create Post -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1">
                            <input type="text" placeholder="Apa yang Anda pikirkan hari ini?" class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fas fa-images text-green-500"></i>
                            <span>Foto/Video</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fas fa-user-tag text-blue-500"></i>
                            <span>Tag Teman</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fas fa-map-marker-alt text-red-500"></i>
                            <span>Lokasi</span>
                        </button>
                    </div>
                </div>

                <!-- Posts Feed -->
                @for($i = 1; $i <= 5; $i++)
                <div class="bg-white rounded-lg shadow-sm">
                    <!-- Post Header -->
                    <div class="p-6 pb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">{{ chr(64 + $i) }}</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">User {{ $i }}</h3>
                                <p class="text-sm text-gray-500">{{ $i }} jam yang lalu</p>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="px-6 pb-4">
                        <p class="text-gray-800">Ini adalah contoh postingan di beranda SINTAS. Konten ini menampilkan berbagai informasi dan pembaruan dari komunitas kami. #SINTAS #Beranda</p>
                    </div>

                    <!-- Post Image -->
                    <div class="px-6 pb-4">
                        <div class="bg-gradient-to-r from-blue-400 to-purple-500 h-48 rounded-lg flex items-center justify-center">
                            <span class="text-white text-lg font-semibold">Gambar Postingan {{ $i }}</span>
                        </div>
                    </div>

                    <!-- Post Actions -->
                    <div class="px-6 pb-4">
                        <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-100 pt-4">
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center space-x-1 hover:text-blue-600 transition-colors">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span>{{ rand(10, 50) }}</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-blue-600 transition-colors">
                                    <i class="fas fa-comment"></i>
                                    <span>{{ rand(5, 20) }}</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-blue-600 transition-colors">
                                    <i class="fas fa-share"></i>
                                    <span>{{ rand(1, 10) }}</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="px-6 pb-6">
                        <div class="space-y-3">
                            @for($j = 1; $j <= rand(1, 3); $j++)
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-gray-600">{{ chr(96 + $j) }}</span>
                                </div>
                                <div class="flex-1 bg-gray-100 rounded-lg px-3 py-2">
                                    <p class="text-sm text-gray-800">Komentar yang bagus! Terima kasih atas informasinya.</p>
                                </div>
                            </div>
                            @endfor
                        </div>

                        <!-- Add Comment -->
                        <div class="flex items-center space-x-3 mt-4">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <input type="text" placeholder="Tulis komentar..." class="flex-1 px-3 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        </div>
                    </div>
                </div>
                @endfor
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-xl">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
                            <p class="text-sm text-gray-500">{{ ucfirst(auth()->user()->department ?? 'Department') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Statistik Cepat</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Tugas Selesai</span>
                            <span class="font-semibold text-green-600">{{ rand(15, 25) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Proyek Aktif</span>
                            <span class="font-semibold text-blue-600">{{ rand(3, 8) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Kolaborator</span>
                            <span class="font-semibold text-purple-600">{{ rand(10, 20) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h3>
                    <div class="space-y-3">
                        @for($i = 1; $i <= 4; $i++)
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-blue-600 text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">Menyelesaikan tugas {{ $i }}</p>
                                <p class="text-xs text-gray-500">{{ $i }} jam yang lalu</p>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Custom styles for Facebook-like layout */
.post-image {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.comment-input:focus {
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
}
</style>
@endpush

@push('scripts')
<script>
// Simple interaction handlers
document.addEventListener('DOMContentLoaded', function() {
    // Like button interactions
    const likeButtons = document.querySelectorAll('.fa-thumbs-up');
    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('text-blue-600');
        });
    });

    // Comment input focus
    const commentInputs = document.querySelectorAll('input[placeholder*="komentar"]');
    commentInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-blue-500');
        });
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-blue-500');
        });
    });
});
</script>
@endpush
