<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Step 8: Kode Promo (Opsional)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 80%"></div>
                    <div class="flex-1 ml-2 h-2 bg-gray-300 rounded-full" style="width: 20%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Step 8 dari 10</div>
            </div>

            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Punya Kode Promo?</h3>
                    <p class="text-gray-600 mb-8">Masukkan kode promo Anda untuk mendapatkan diskon (opsional)</p>

                    <form method="POST" action="{{ route('registration.step8-submit') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="program_id" value="{{ request('program_id') }}">
                        <input type="hidden" name="schedule_id" value="{{ request('schedule_id') }}">
                        <input type="hidden" name="student_name" value="{{ request('student_name') }}">
                        <input type="hidden" name="student_birthdate" value="{{ request('student_birthdate') }}">
                        <input type="hidden" name="student_identity_number" value="{{ request('student_identity_number') }}">
                        <input type="hidden" name="student_gender" value="{{ request('student_gender') }}">
                        <input type="hidden" name="student_address" value="{{ request('student_address') }}">
                        <input type="hidden" name="student_phone" value="{{ request('student_phone') }}">
                        <input type="hidden" name="student_email" value="{{ request('student_email') }}">
                        <input type="hidden" name="is_parent_register" value="{{ request('is_parent_register') }}">
                        <input type="hidden" name="parent_name" value="{{ request('parent_name') }}">
                        <input type="hidden" name="parent_identity_number" value="{{ request('parent_identity_number') }}">
                        <input type="hidden" name="parent_phone" value="{{ request('parent_phone') }}">
                        <input type="hidden" name="parent_email" value="{{ request('parent_email') }}">
                        <input type="hidden" name="parent_relationship" value="{{ request('parent_relationship') }}">
                        <input type="hidden" name="parent_address" value="{{ request('parent_address') }}">

                        <!-- Promo Code Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kode Promo</label>
                            <div class="flex gap-3">
                                <input type="text" name="promo_code" id="promo_code" value="{{ old('promo_code') }}" 
                                    class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent uppercase" 
                                    placeholder="Cth: PROMO2024" maxlength="20">
                                <button type="button" id="validate-promo-btn" class="px-6 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                                    Validasi
                                </button>
                            </div>
                            @error('promo_code') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Promo Status Message -->
                        <div id="promo-status" class="hidden"></div>

                        <!-- Current Order Summary -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">📊 Ringkasan Pesanan</h4>
                            
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg space-y-2 mb-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Program</span>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $program->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Nama Siswa</span>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ request('student_name') }}</span>
                                </div>
                                <hr class="border-gray-300 dark:border-gray-600 my-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Harga</span>
                                    <span class="text-gray-900 dark:text-white font-medium">Rp{{ number_format($program->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between" id="discount-row" style="display: none;">
                                    <span class="text-gray-600 dark:text-gray-400">Diskon</span>
                                    <span class="text-green-600 dark:text-green-400 font-medium" id="discount-amount">-Rp0</span>
                                </div>
                                <hr class="border-gray-300 dark:border-gray-600 my-2">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold text-gray-900 dark:text-white">Total</span>
                                    <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400" id="total-price">Rp{{ number_format($program->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Skip Promo Button -->
                        <div class="text-center mb-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Tidak punya kode promo?</p>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex gap-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('registration.step7') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium">
                                ← Kembali
                            </a>
                            <button type="submit" class="ml-auto px-8 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                                Lanjut ke Pembayaran →
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const validatePromoBtn = document.getElementById('validate-promo-btn');
        const promoInput = document.getElementById('promo_code');
        const promoStatus = document.getElementById('promo-status');
        const basePrice = {{ $program->price }};
        const totalPriceElement = document.getElementById('total-price');
        const discountRow = document.getElementById('discount-row');
        const discountAmount = document.getElementById('discount-amount');

        validatePromoBtn.addEventListener('click', async () => {
            const promoCode = promoInput.value.trim();
            
            if (!promoCode) {
                showPromoStatus('Masukkan kode promo', 'error');
                return;
            }

            try {
                const response = await fetch(`/api/validate-promo`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ promo_code: promoCode })
                });

                const data = await response.json();

                if (data.valid) {
                    showPromoStatus(`✓ Promo berhasil! Diskon ${data.discount_value}${data.discount_type === 'percentage' ? '%' : ''}`, 'success');
                    
                    // Calculate discount
                    let discountValue = 0;
                    if (data.discount_type === 'percentage') {
                        discountValue = Math.floor((basePrice * data.discount_value) / 100);
                    } else {
                        discountValue = data.discount_value;
                    }

                    const finalPrice = basePrice - discountValue;
                    discountRow.style.display = 'flex';
                    discountAmount.textContent = `-Rp${new Intl.NumberFormat('id-ID').format(discountValue)}`;
                    totalPriceElement.textContent = `Rp${new Intl.NumberFormat('id-ID').format(finalPrice)}`;
                } else {
                    showPromoStatus(data.message || 'Kode promo tidak valid', 'error');
                }
            } catch (error) {
                showPromoStatus('Gagal validasi kode promo', 'error');
            }
        });

        function showPromoStatus(message, type) {
            promoStatus.innerHTML = `<div class="p-3 rounded-lg ${
                type === 'success' 
                    ? 'bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-200' 
                    : 'bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-200'
            }">
                ${message}
            </div>`;
            promoStatus.classList.remove('hidden');
        }
    </script>
</x-app-layout>
