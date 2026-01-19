<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Section 5: Tinjau & Promo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 71%"></div>
                    <div class="flex-1 ml-2 h-2 bg-gray-300 rounded-full" style="width: 29%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Section 5 dari 7</div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Review Order -->
                <div class="lg:col-span-2">
                    <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-6 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Tinjau Pesanan Anda</h3>

                            <form method="POST" action="{{ route('registration.step6-submit') }}" class="space-y-6">
                                @csrf
                                <input type="hidden" name="program_id" value="{{ $program->id }}">
                                <input type="hidden" name="is_parent_register" value="{{ request('is_parent_register') }}">

                                <!-- Store all fields as hidden -->
                                @foreach(request()->all() as $key => $value)
                                    @if(!in_array($key, ['program_id', 'is_parent_register', '_token']))
                                        @if(is_array($value))
                                            @foreach($value as $item)
                                                <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                                            @endforeach
                                        @else
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endif
                                    @endif
                                @endforeach

                                <!-- Program Info -->
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">📚 Program</h4>
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <p class="text-gray-900 dark:text-white font-medium">{{ $program->name }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $program->description }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                            Durasi: {{ $program->duration_weeks }} minggu | Layanan: {{ $program->service_type }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Student Info -->
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">👤 Data Siswa</h4>
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg space-y-2 text-sm">
                                        <p><span class="text-gray-600 dark:text-gray-400">Nama:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('student_name') }}</span></p>
                                        <p><span class="text-gray-600 dark:text-gray-400">Tanggal Lahir:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('student_birthdate') }}</span></p>
                                        <p><span class="text-gray-600 dark:text-gray-400">NIK:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('student_identity_number') }}</span></p>
                                        @if(request('is_parent_register') === 'yes')
                                            <hr class="my-2 border-gray-300 dark:border-gray-600">
                                            <p class="font-medium text-gray-900 dark:text-white">Orang Tua/Wali:</p>
                                            <p><span class="text-gray-600 dark:text-gray-400">Nama:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('parent_name') }}</span></p>
                                            <p><span class="text-gray-600 dark:text-gray-400">Hubungan:</span> <span class="text-gray-900 dark:text-white font-medium">{{ ucfirst(request('parent_relationship')) }}</span></p>
                                            <p><span class="text-gray-600 dark:text-gray-400">No. Telepon:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('parent_phone') }}</span></p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Promo Code Section -->
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">🎫 Kode Promo (Opsional)</h4>
                                    <div class="flex gap-3">
                                        <input type="text" name="promo_code" id="promo_code" value="{{ old('promo_code') }}"
                                            class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent uppercase"
                                            placeholder="Cth: PROMO2024" maxlength="20">
                                        <button type="button" id="validate-promo-btn" class="px-6 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                                            Validasi
                                        </button>
                                    </div>
                                    <div id="promo-status" class="mt-2"></div>
                                    @error('promo_code') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Payment Choice -->
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">💳 Pilihan Pembayaran</h4>
                                    <div class="space-y-3">
                                        <label class="flex items-center p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:border-primary-500 hover:shadow-md transition-colors">
                                            <input type="radio" name="payment_choice" value="pay_now" class="h-4 w-4 text-primary-600 focus:ring-primary-500" required>
                                            <div class="ml-3">
                                                <span class="block text-sm font-medium text-gray-900 dark:text-white">Bayar Sekarang</span>
                                                <span class="block text-xs text-gray-500 dark:text-gray-400">Lanjut ke upload bukti pembayaran</span>
                                            </div>
                                        </label>
                                        <label class="flex items-center p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:border-primary-500 hover:shadow-md transition-colors">
                                            <input type="radio" name="payment_choice" value="pay_later" class="h-4 w-4 text-primary-600 focus:ring-primary-500" required>
                                            <div class="ml-3">
                                                <span class="block text-sm font-medium text-gray-900 dark:text-white">Bayar Nanti</span>
                                                <span class="block text-xs text-gray-500 dark:text-gray-400">Admin akan follow-up untuk pembayaran</span>
                                            </div>
                                        </label>
                                    </div>
                                    @error('payment_choice') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Verification Message -->
                                @if($studentAge < 18 && request('is_parent_register') === 'no')
                                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-lg p-4">
                                        <p class="text-yellow-800 dark:text-yellow-200 text-sm">
                                            <strong>⚠️ Perhatian:</strong> Siswa berusia di bawah 18 tahun memerlukan persetujuan orang tua/wali. Anda akan diminta mengunggah surat izin orang tua di langkah pembayaran.
                                        </p>
                                    </div>
                                @endif

                                <!-- Agreement -->
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                                    <div class="space-y-3">
                                        <label class="flex items-start gap-3 cursor-pointer">
                                            <input type="checkbox" name="agree_terms" value="1" class="mt-1 h-4 w-4 text-indigo-600 rounded" required>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">
                                                Saya menyetujui <a href="#" onclick="showTerms()" class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 underline">syarat dan ketentuan</a> layanan
                                            </span>
                                        </label>
                                        <label class="flex items-start gap-3 cursor-pointer">
                                            <input type="checkbox" name="agree_contract" value="1" class="mt-1 h-4 w-4 text-indigo-600 rounded" required>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">
                                                Saya bersedia menandatangani <a href="#" onclick="showContract()" class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 underline">Kontrak Belajar</a> PT. Siap Belajar Indonesia
                                            </span>
                                        </label>
                                    </div>
                                    @error('agree_terms') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    @error('agree_contract') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="flex gap-4 pt-6 border-t border-gray-200">
                                    <a href="{{ route('registration.step4') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium">
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

                            <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Harga Program</span>
                                    <span class="font-semibold text-gray-900">Rp{{ number_format($program->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between" id="discount-row" style="display: none;">
                                    <span class="text-gray-600">Diskon</span>
                                    <span class="font-semibold text-green-600" id="discount-amount">-Rp0</span>
                                </div>
                            </div>

                            <div class="flex justify-between mb-6">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span class="text-lg font-bold text-primary-600" id="total-price">Rp{{ number_format($program->price, 0, ',', '.') }}</span>
                            </div>

                            <div class="bg-accent-50 border border-accent-200 rounded-xl p-3 text-sm text-accent-800">
                                <p>✓ Harga sudah termasuk semua biaya administrasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Terms -->
    <div id="terms-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Syarat dan Ketentuan Layanan</h3>
                <div class="text-sm text-gray-600 max-h-96 overflow-y-auto">
                    <p>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <p>2. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p>3. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                    <!-- Add more terms content -->
                </div>
                <div class="flex justify-end mt-4">
                    <button onclick="closeModal('terms-modal')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Contract -->
    <div id="contract-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Kontrak Belajar PT. Siap Belajar Indonesia</h3>
                <div class="text-sm text-gray-600 max-h-96 overflow-y-auto">
                    <p>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <p>2. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <p>3. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                    <!-- Add more contract content -->
                </div>
                <div class="flex justify-end mt-4">
                    <button onclick="closeModal('contract-modal')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Calculate student age
        const birthdateInput = document.querySelector('input[name="student_birthdate"]');
        if (birthdateInput) {
            const birthdate = new Date('{{ request("student_birthdate") }}');
            const today = new Date();
            const age = today.getFullYear() - birthdate.getFullYear();
            console.log('Student age:', age);
        }

        // Promo validation
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

        function showTerms() {
            document.getElementById('terms-modal').classList.remove('hidden');
        }

        function showContract() {
            document.getElementById('contract-modal').classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</x-app-layout>
