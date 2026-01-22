<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $child->name }} - Pembayaran & Tagihan
        </h2>
    </x-slot>

    @auth
        @if(auth()->user()->role === 'parent')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Payment Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-green-50 rounded-lg shadow p-6 border-l-4 border-green-500">
                    <h3 class="text-gray-600 text-sm font-medium mb-2">Sudah Dibayar</h3>
                    <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalPaid, 0, ',', '.') }}</p>
                </div>
                <div class="bg-yellow-50 rounded-lg shadow p-6 border-l-4 border-yellow-500">
                    <h3 class="text-gray-600 text-sm font-medium mb-2">Menunggu Verifikasi</h3>
                    <p class="text-3xl font-bold text-yellow-600">Rp {{ number_format($totalPending, 0, ',', '.') }}</p>
                </div>
                <div class="bg-red-50 rounded-lg shadow p-6 border-l-4 border-red-500">
                    <h3 class="text-gray-600 text-sm font-medium mb-2">Belum Lunas</h3>
                    <p class="text-3xl font-bold text-red-600">Rp {{ number_format($totalOverdue, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Payment History -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Riwayat Pembayaran</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Program</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Jumlah</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paymentHistory as $payment)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $payment->created_at->format('d M Y') }}</td>
                                    <td class="py-3 px-4">{{ $payment->registration->program->name ?? '-' }}</td>
                                    <td class="py-3 px-4 font-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4">
                                        @php
                                            $statusClass = match($payment->status) {
                                                'verified' => 'bg-green-100 text-green-800',
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                default => 'bg-red-100 text-red-800',
                                            };
                                        @endphp
                                        <span class="px-2 py-1 rounded text-xs font-medium {{ $statusClass }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-500">Belum ada pembayaran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($paymentHistory->hasPages())
                    <div class="mt-6">
                        {{ $paymentHistory->links() }}
                    </div>
                @endif
            </div>

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
