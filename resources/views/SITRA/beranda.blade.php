@extends('layouts.app')

@section('title', 'Beranda - SITRA')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Beranda</h1>
                <div class="flex items-center space-x-4">
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
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
                        <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1">
                            <input type="text" placeholder="Bagikan pengalaman anak Anda hari ini..." class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-green-600 transition-colors">
                            <i class="fas fa-camera text-blue-500"></i>
                            <span>Foto Anak</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-green-600 transition-colors">
                            <i class="fas fa-graduation-cap text-purple-500"></i>
                            <span>Prestasi</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-green-600 transition-colors">
                            <i class="fas fa-heart text-red-500"></i>
                            <span>Motivasi</span>
                        </button>
                    </div>
                </div>

                <!-- Posts Feed -->
                @for($i = 1; $i <= 5; $i++)
                <div class="bg-white rounded-lg shadow-sm">
                    <!-- Post Header -->
                    <div class="p-6 pb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">{{ chr(64 + $i) }}</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">Orang Tua {{ $i }}</h3>
                                <p class="text-sm text-gray-500">{{ $i }} jam yang lalu</p>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="px-6 pb-4">
                        <p class="text-gray-800">Anak saya hari ini mendapat nilai bagus di matematika! Sangat bangga dengan perkembangannya. Terima kasih kepada guru yang telah membimbing dengan baik. #Pembelajaran #PrestasiAnak</p>
                    </div>

                    <!-- Post Image -->
                    <div class="px-6 pb-4">
                        <div class="bg-gradient-to-r from-green-400 to-teal-500 h-48 rounded-lg flex items-center justify-center">
                            <span class="text-white text-lg font-semibold">Foto Prestasi Anak {{ $i }}</span>
                        </div>
                    </div>

                    <!-- Post Actions -->
                    <div class="px-6 pb-4">
                        <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-100 pt-4">
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center space-x-1 hover:text-green-600 transition-colors">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span>{{ rand(10, 50) }}</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-green-600 transition-colors">
                                    <i class="fas fa-comment"></i>
                                    <span>{{ rand(5, 20) }}</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-green-600 transition-colors">
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
                                    <p class="text-sm text-gray-800">Selamat! Anak Anda memang hebat. Teruslah mendukung perkembangannya.</p>
                                </div>
                            </div>
                            @endfor
                        </div>

                        <!-- Add Comment -->
                        <div class="flex items-center space-x-3 mt-4">
                            <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <input type="text" placeholder="Tulis komentar..." class="flex-1 px-3 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
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
                        <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-xl">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
                            <p class="text-sm text-gray-500">Orang Tua</p>
                        </div>
                    </div>
                </div>

                <!-- Children Overview -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Anak-Anak Saya</h3>
                    <div class="space-y-3">
                        @for($i = 1; $i <= 2; $i++)
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-bold">{{ chr(64 + $i) }}</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Anak {{ $i }}</p>
                                <p class="text-xs text-gray-500">Kelas {{ rand(1, 6) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-green-600 font-medium">{{ rand(85, 95) }}%</p>
                                <p class="text-xs text-gray-400">Kehadiran</p>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h3>
                    <div class="space-y-3">
                        @for($i = 1; $i <= 4; $i++)
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-star text-green-600 text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">Anak mendapat nilai sempurna</p>
                                <p class="text-xs text-gray-500">{{ $i }} jam yang lalu</p>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Tautan Cepat</h3>
                    <div class="space-y-2">
                        <a href="#" class="block text-sm text-gray-600 hover:text-green-600 transition-colors">
                            <i class="fas fa-calendar-alt mr-2"></i>Jadwal Sekolah
                        </a>
                        <a href="#" class="block text-sm text-gray-600 hover:text-green-600 transition-colors">
                            <i class="fas fa-chart-line mr-2"></i>Rapor Online
                        </a>
                        <a href="#" class="block text-sm text-gray-600 hover:text-green-600 transition-colors">
                            <i class="fas fa-envelope mr-2"></i>Pesan Guru
                        </a>
                        <a href="#" class="block text-sm text-gray-600 hover:text-green-600 transition-colors">
                            <i class="fas fa-credit-card mr-2"></i>Pembayaran SPP
                        </a>
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
            this.classList.toggle('text-green-600');
        });
    });

    // Comment input focus
    const commentInputs = document.querySelectorAll('input[placeholder*="komentar"]');
    commentInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-green-500');
        });
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-green-500');
        });
    });
});
</script>
@endpush
