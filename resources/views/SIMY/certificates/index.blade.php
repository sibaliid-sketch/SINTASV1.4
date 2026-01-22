@extends('layouts.app')

@section('content')
@auth
    @if(in_array(auth()->user()->role, ['student', 'teacher']))
<div class="py-12">>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">🎓 Sertifikat Pembelajaran</h1>
            <p class="mt-2 text-gray-600">Kelola dan download sertifikat penyelesaian program Anda</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <p class="text-sm font-semibold text-blue-700 uppercase">Total Sertifikat</p>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalCertificates }}</p>
            </div>
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <p class="text-sm font-semibold text-green-700 uppercase">Sertifikat Berlaku</p>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $validCertificates }}</p>
            </div>
        </div>

        <!-- Certificates List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($certificates as $certificate)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <!-- Certificate Preview -->
                <div class="bg-gradient-to-br from-amber-50 to-yellow-100 h-40 flex items-center justify-center border-b-4 border-amber-300">
                    <div class="text-center">
                        <div class="text-5xl mb-2">🎓</div>
                        <p class="text-sm font-semibold text-amber-900">Sertifikat</p>
                    </div>
                </div>

                <!-- Certificate Info -->
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900">{{ $certificate->program->name }}</h3>
                    
                    <div class="mt-4 space-y-3 text-sm">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Nomor Sertifikat</p>
                            <p class="text-gray-900 font-mono mt-1">{{ $certificate->certificate_number }}</p>
                        </div>
                        
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Tanggal Terbit</p>
                            <p class="text-gray-900 mt-1">{{ $certificate->issue_date->format('d M Y') }}</p>
                        </div>

                        @if($certificate->expiry_date)
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Berlaku Sampai</p>
                            <p class="text-gray-900 mt-1">
                                @if($certificate->isExpired())
                                <span class="text-red-600 font-medium">❌ Sudah Kadaluarsa ({{ $certificate->expiry_date->format('d M Y') }})</span>
                                @else
                                <span class="text-green-600 font-medium">✅ {{ $certificate->expiry_date->format('d M Y') }}</span>
                                @endif
                            </p>
                        </div>
                        @else
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase">Status</p>
                            <p class="text-green-600 font-medium mt-1">✅ Berlaku Selamanya</p>
                        </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 space-y-2">
                        <a href="{{ route('simy.certificates.show', $certificate) }}" class="block w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-center font-medium transition">
                            Lihat Detail
                        </a>
                        @if($certificate->certificate_url)
                        <a href="{{ $certificate->certificate_url }}" target="_blank" class="block w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-center font-medium transition">
                            📥 Download PDF
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <div class="text-5xl mb-4">📋</div>
                    <p class="text-gray-600 text-lg">Belum ada sertifikat</p>
                    <p class="text-gray-500 mt-2">Selesaikan program pembelajaran untuk mendapatkan sertifikat</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($certificates->hasPages())
        <div class="mt-8">
            {{ $certificates->links() }}
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
