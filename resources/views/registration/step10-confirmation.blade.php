<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Step 10: Konfirmasi Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar (Complete) -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 100%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Step 10 dari 10 ✓ Selesai</div>
            </div>

            <!-- Success Message -->
            <div class="bg-accent-50 border-2 border-accent-200 rounded-2xl p-8 mb-8 text-center">
                <div class="text-5xl mb-4">🎉</div>
                <h3 class="text-2xl font-bold text-accent-900 mb-2 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Pemesanan Berhasil!</h3>
                <p class="text-accent-800">Terima kasih telah memesan. Kami akan memproses pemesanan Anda dalam waktu 1-2 hari kerja.</p>
            </div>

            <!-- Invoice Card -->
            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl mb-6">
                <div class="p-8">
                    <div class="text-center mb-8 pb-8 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">📋 Invoice Pemesanan</h3>
                        <p class="text-gray-600 dark:text-gray-400">Nomor Invoice: <span class="font-mono font-semibold text-indigo-600 dark:text-indigo-400">{{ $registration->invoice_id }}</span></p>
                    </div>

                    <!-- Registration Details -->
                    <div class="space-y-6">
                        <!-- Program Info -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Program</h4>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $registration->program->name }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $registration->program->description }}</p>
                        </div>

                        <!-- Student Info -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Nama Siswa</h4>
                                <p class="text-gray-900 dark:text-white font-medium">{{ $registration->student_name }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">ID Siswa</h4>
                                <p class="text-gray-900 dark:text-white font-mono font-semibold text-indigo-600 dark:text-indigo-400">{{ $registration->student_id }}</p>
                            </div>
                        </div>

                        <!-- Schedule Info -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Jadwal Kelas</h4>
                                <p class="text-gray-900 dark:text-white font-medium">{{ $registration->schedule->day_of_week }}</p>
                                @if($registration->schedule->day_of_week !== 'Flexible')
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ date('H:i', strtotime($registration->schedule->start_time)) }} - {{ date('H:i', strtotime($registration->schedule->end_time)) }}
                                    </p>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Lokasi Kelas</h4>
                                <p class="text-gray-900 dark:text-white font-medium">{{ $registration->schedule->room_id ?? 'TBD' }}</p>
                            </div>
                        </div>

                        <!-- Order ID -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Nomor Pesanan</h4>
                            <p class="text-gray-900 dark:text-white font-mono font-semibold">{{ $registration->order_id }}</p>
                        </div>

                        <!-- Cost Summary -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Harga Program</span>
                                    <span class="text-gray-900 dark:text-white font-medium">Rp{{ number_format($registration->program->price, 0, ',', '.') }}</span>
                                </div>
                                @if($registration->discount_amount > 0)
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Diskon</span>
                                    <span class="text-green-600 dark:text-green-400 font-medium">-Rp{{ number_format($registration->discount_amount, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                <hr class="border-gray-300 dark:border-gray-600">
                                <div class="flex justify-between">
                                    <span class="font-bold text-gray-900 dark:text-white">Total</span>
                                    <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">
                                        Rp{{ number_format($registration->total_amount ?? $registration->program->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide mb-2">Status</h4>
                            <div class="inline-block">
                                @if($registration->status === 'active')
                                    <span class="px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 rounded-full text-sm font-semibold">✓ Aktif</span>
                                @elif($registration->status === 'pending_payment')
                                    <span class="px-4 py-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200 rounded-full text-sm font-semibold">⏳ Menunggu Verifikasi</span>
                                @else
                                    <span class="px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 rounded-full text-sm font-semibold">📝 {{ ucfirst($registration->status) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="my-8 border-t border-gray-200 dark:border-gray-700"></div>

                    <!-- Important Notes -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4 mb-6">
                        <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-3">ℹ️ Informasi Penting</h4>
                        <ul class="space-y-2 text-sm text-blue-800 dark:text-blue-200">
                            <li class="flex gap-2">
                                <span>✓</span>
                                <span>Invoice ini telah dikirim ke email Anda. Silahkan cek folder spam jika tidak ditemukan.</span>
                            </li>
                            <li class="flex gap-2">
                                <span>✓</span>
                                <span>Kami akan memverifikasi pembayaran Anda dalam waktu 1-2 hari kerja.</span>
                            </li>
                            <li class="flex gap-2">
                                <span>✓</span>
                                <span>Akun siswa Anda akan dibuat otomatis setelah verifikasi pembayaran selesai.</span>
                            </li>
                            <li class="flex gap-2">
                                <span>✓</span>
                                <span>Hubungi kami di <strong>support@sintasku.id</strong> jika ada pertanyaan.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Download Invoice -->
                    <div class="text-center mb-6">
                        <button onclick="window.print()" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium text-sm">
                            📥 Simpan/Print Invoice
                        </button>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <a href="{{ route('dashboard') }}" class="block text-center px-8 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('registration.index') }}" class="block text-center px-8 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium">
                    Pesan Program Lain
                </a>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body { background: white; }
            .py-12 { padding: 0 !important; }
            a, button:not([onclick*="print"]) { display: none !important; }
        }
    </style>
</x-app-layout>
