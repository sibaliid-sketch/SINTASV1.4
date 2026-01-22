<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $child->name }} - Sertifikat
        </h2>
    </x-slot>

    @auth
        @if(auth()->user()->role === 'parent')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($certificates as $cert)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <!-- Certificate Header -->
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 text-white">
                            <h3 class="text-xl font-bold mb-2">{{ $cert->program->name }}</h3>
                            <p class="text-sm text-blue-100">Dikeluarkan: {{ $cert->issued_at->format('d M Y') }}</p>
                        </div>

                        <!-- Certificate Details -->
                        <div class="p-6">
                            <div class="mb-6">
                                <p class="text-xs text-gray-600 mb-2">Nomor Sertifikat</p>
                                <p class="font-mono text-sm text-gray-900">{{ $cert->certificate_number }}</p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <a href="#" class="flex-1 py-2 px-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded transition-colors text-center">
                                    Buka
                                </a>
                                <a href="#" class="flex-1 py-2 px-3 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded transition-colors text-center">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Sertifikat</h3>
                        <p class="text-gray-600">Sertifikat akan tersedia setelah anak menyelesaikan program</p>
                    </div>
                @endforelse
            </div>

            @if($certificates->hasPages())
                <div class="mt-8">
                    {{ $certificates->links() }}
                </div>
            @endif

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
