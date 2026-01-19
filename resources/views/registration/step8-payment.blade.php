<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Section 7: Invoice & Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 100%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Section 7 dari 7</div>
            </div>

            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Invoice Pemesanan</h3>
                    <p class="text-gray-600 mb-8">Pemesanan berhasil dibuat. Silakan lakukan pembayaran sesuai instruksi di bawah.</p>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Invoice Details -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">📄 Detail Invoice</h4>
                            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Order ID</span>
                                    <span class="font-mono text-gray-900">#ORDER123456</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Invoice ID</span>
                                    <span class="font-mono text-gray-900">#INV123456</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal Pemesanan</span>
                                    <span class="text-gray-900">{{ date('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Program</span>
                                    <span class="text-gray-900">{{ $program->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Layanan</span>
                                    <span class="text-gray-900">{{ $program->service_type }}</span>
                                </div>
                                <hr class="border-gray-300">
                                <div class="flex justify-between font-bold">
                                    <span class="text-gray-900">Total Pembayaran</span>
                                    <span class="text-primary-600">Rp{{ number_format($program->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Options -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">💳 Pilihan Pembayaran</h4>
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-primary-500 hover:shadow-md transition-all">
                                    <input type="radio" name="payment_method" value="pay_now" class="h-4 w-4 text-primary-600" checked>
                                    <div class="ml-3">
                                        <span class="block text-sm font-medium text-gray-900">Bayar Sekarang</span>
                                        <span class="block text-xs text-gray-500">Upload bukti pembayaran</span>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-primary-500 hover:shadow-md transition-all">
                                    <input type="radio" name="payment_method" value="pay_later" class="h-4 w-4 text-primary-600">
                                    <div class="ml-3">
                                        <span class="block text-sm font-medium text-gray-900">Bayar Nanti</span>
                                        <span class="block text-xs text-gray-500">Paling lambat 2 hari sebelum kelas dimulai</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Instructions -->
                    <div id="pay-now-section" class="mt-8">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">🏦 Instruksi Pembayaran</h4>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h5 class="font-medium text-blue-900 mb-2">Transfer ke Rekening:</h5>
                                    <p class="text-blue-800">Bank BCA<br>
                                    No. Rekening: 1234567890<br>
                                    Atas Nama: PT. Siap Belajar Indonesia</p>
                                </div>
                                <div>
                                    <h5 class="font-medium text-blue-900 mb-2">QR Code:</h5>
                                    <div class="bg-white p-4 rounded border">
                                        <!-- Placeholder for QR Code -->
                                        <div class="w-32 h-32 bg-gray-300 flex items-center justify-center text-gray-600 text-sm">
                                            QR Code
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('registration.step8-submit') }}" enctype="multipart/form-data" class="mt-6 space-y-4">
                            @csrf
                            <input type="hidden" name="payment_choice" value="pay_now">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti Transfer *</label>
                                    <input type="file" name="proof_file" accept="image/*,.pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent" required>
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF. Maksimal 5MB</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Bank Pengirim *</label>
                                    <input type="text" name="bank_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="Contoh: BCA" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pengirim *</label>
                                    <input type="text" name="sender_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="Nama sesuai rekening" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Transfer *</label>
                                    <input type="number" name="amount" value="{{ $program->price }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent" required>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal & Waktu Transfer *</label>
                                    <input type="datetime-local" name="transfer_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent" required>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                                    <textarea name="notes" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="Tambahkan catatan jika diperlukan"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="w-full px-8 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                                Upload Bukti Pembayaran
                            </button>
                        </form>
                    </div>

                    <!-- Pay Later Message -->
                    <div id="pay-later-section" class="mt-8 hidden">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                            <div class="text-4xl mb-4">✅</div>
                            <h4 class="text-lg font-semibold text-green-900 mb-2">Pemesanan Berhasil!</h4>
                            <p class="text-green-800 mb-4">Anda akan dihubungi oleh Tim Sibali.id untuk proses selanjutnya.</p>
                            <p class="text-sm text-green-700">Pembayaran dapat dilakukan paling lambat 2 hari sebelum kelas dimulai.</p>
                        </div>
                    </div>

                    <!-- Account Creation Notice -->
                    <div class="mt-8 bg-purple-50 border border-purple-200 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-purple-900 mb-2">🎉 Akun Otomatis Dibuat</h4>
                        <p class="text-purple-800 mb-4">Setelah pembayaran diverifikasi, akun akan diaktifkan:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div class="bg-white p-3 rounded border">
                                <strong>SITRA</strong> (untuk Orang Tua)<br>
                                Status: Belum Aktif<br>
                                <a href="#" class="text-purple-600 hover:underline">Bergabung Komunitas</a>
                            </div>
                            <div class="bg-white p-3 rounded border">
                                <strong>SIMY</strong> (untuk Siswa)<br>
                                Status: Belum Aktif<br>
                                <a href="#" class="text-purple-600 hover:underline">Bergabung Komunitas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle payment sections
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const payNowSection = document.getElementById('pay-now-section');
        const payLaterSection = document.getElementById('pay-later-section');

        paymentMethods.forEach(method => {
            method.addEventListener('change', () => {
                if (method.value === 'pay_now') {
                    payNowSection.classList.remove('hidden');
                    payLaterSection.classList.add('hidden');
                } else {
                    payNowSection.classList.add('hidden');
                    payLaterSection.classList.remove('hidden');
                }
            });
        });
    </script>
</x-app-layout>
