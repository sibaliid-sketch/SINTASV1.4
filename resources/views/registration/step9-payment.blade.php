<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Step 9: Bukti Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 90%"></div>
                    <div class="flex-1 ml-2 h-2 bg-gray-300 rounded-full" style="width: 10%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Step 9 dari 10</div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Payment Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-2 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Informasi Pembayaran</h3>
                            <p class="text-gray-600 mb-8">Unggah bukti pembayaran Anda di bawah ini</p>

                            <!-- Account Payment Instructions -->
                            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4 mb-8">
                                <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-3">💳 Rekening Pembayaran</h4>
                                <div class="space-y-2 text-sm text-blue-800 dark:text-blue-200">
                                    <div class="flex justify-between border-b border-blue-200 dark:border-blue-700 pb-2">
                                        <span>Bank BCA</span>
                                        <span class="font-mono font-semibold">1234567890</span>
                                    </div>
                                    <div class="flex justify-between border-b border-blue-200 dark:border-blue-700 pb-2">
                                        <span>Bank Mandiri</span>
                                        <span class="font-mono font-semibold">9876543210</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Bank Transfer (e-wallet)</span>
                                        <span class="font-mono font-semibold">081234567890</span>
                                    </div>
                                </div>
                                <p class="text-xs text-blue-700 dark:text-blue-300 mt-3">
                                    ℹ️ Pastikan Anda transfer sesuai dengan jumlah di bawah. Simpan bukti transfer untuk tahap berikutnya.
                                </p>
                            </div>

                            <form method="POST" action="{{ route('registration.step9-submit', ['registration' => $registration->id]) }}" enctype="multipart/form-data" class="space-y-6">
                                @csrf

                                <!-- Bank Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bank Pengirim *</label>
                                    <select name="bank_name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                                        <option value="">-- Pilih Bank --</option>
                                        <option value="BCA">BCA</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BNI">BNI</option>
                                        <option value="BTN">BTN</option>
                                        <option value="CIMB">CIMB</option>
                                        <option value="OVO">OVO</option>
                                        <option value="GoPay">GoPay</option>
                                        <option value="DANA">DANA</option>
                                    </select>
                                    @error('bank_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Sender Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Pengirim *</label>
                                    <input type="text" name="sender_name" value="{{ old('sender_name') }}" 
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                        placeholder="Nama sesuai rekening pengirim" required>
                                    @error('sender_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Transfer Amount -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jumlah Transfer *</label>
                                    <input type="number" name="amount" value="{{ old('amount', $registration->total_amount ?? $registration->program->price) }}" 
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                        placeholder="0" required>
                                    @error('amount') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Transfer Date -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Transfer *</label>
                                    <input type="datetime-local" name="transfer_date" value="{{ old('transfer_date') }}" 
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                        required>
                                    @error('transfer_date') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- File Upload -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Unggah Bukti Transfer (JPG/PNG/PDF) *</label>
                                    <div class="relative">
                                        <input type="file" name="proof_file" id="proof_file" accept=".jpg,.jpeg,.png,.pdf" 
                                            class="hidden" required>
                                        <label for="proof_file" class="flex items-center justify-center w-full px-4 py-8 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:border-indigo-500 dark:hover:border-indigo-400 transition bg-gray-50 dark:bg-gray-700">
                                            <div class="text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-8-12v12m0 0l-3-3m3 3l3-3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <p class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Klik atau drag file di sini</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">JPG, PNG atau PDF (Max 5MB)</p>
                                            </div>
                                        </label>
                                    </div>
                                    <p id="file-name" class="mt-2 text-sm text-gray-600 dark:text-gray-400"></p>
                                    @error('proof_file') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Additional Notes -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Catatan Tambahan</label>
                                    <textarea name="notes" rows="3" value="{{ old('notes') }}" 
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                        placeholder="Tambahkan catatan jika diperlukan">{{ old('notes') }}</textarea>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="flex gap-4 pt-6 border-t border-gray-200">
                                    <a href="{{ route('registration.step8') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium">
                                        ← Kembali
                                    </a>
                                    <button type="submit" class="ml-auto px-8 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                                        Lanjutkan →
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="h-fit">
                    <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl sticky top-4">
                        <div class="p-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-4">📊 Ringkasan Pesanan</h4>

                            <div class="space-y-3 mb-6 pb-6 border-b border-gray-200 text-sm">
                                <div>
                                    <p class="text-gray-600 text-xs">Program</p>
                                    <p class="text-gray-900 font-semibold">{{ $registration->program->name }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs">Jadwal</p>
                                    <p class="text-gray-900 font-semibold">{{ $registration->schedule->day_of_week }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs">Invoice ID</p>
                                    <p class="text-gray-900 font-mono text-xs font-semibold">{{ $registration->invoice_id }}</p>
                                </div>
                            </div>

                            <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Harga</span>
                                    <span class="text-gray-900 font-medium">Rp{{ number_format($registration->program->price, 0, ',', '.') }}</span>
                                </div>
                                @if($registration->discount_amount > 0)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Diskon</span>
                                    <span class="text-green-600 font-medium">-Rp{{ number_format($registration->discount_amount, 0, ',', '.') }}</span>
                                </div>
                                @endif
                            </div>

                            <div class="flex justify-between mb-4">
                                <span class="font-bold text-gray-900">Total</span>
                                <span class="text-xl font-bold text-primary-600">
                                    Rp{{ number_format($registration->total_amount ?? $registration->program->price, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="bg-accent-50 border border-accent-200 rounded-xl p-3 text-sm text-accent-800">
                                <p>✓ Transfer ke rekening yang tertera di atas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('proof_file');
        const fileName = document.getElementById('file-name');

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                fileName.textContent = `✓ ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            }
        });
    </script>
</x-app-layout>
