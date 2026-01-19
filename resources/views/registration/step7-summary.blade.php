<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Section 6: Ringkasan Pemesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 85%"></div>
                    <div class="flex-1 ml-2 h-2 bg-gray-300 rounded-full" style="width: 15%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Section 6 dari 7</div>
            </div>

            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Ringkasan Pemesanan</h3>
                    <p class="text-gray-600 mb-8">Mohon periksa kembali data pemesanan Anda sebelum melanjutkan</p>

                    <div class="space-y-6">
                        <!-- Program Info -->
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">📚 Program yang Dipilih</h4>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <p class="text-gray-900 dark:text-white font-medium">{{ $program->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $program->description }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                    Durasi: {{ $program->duration_weeks }} minggu | Layanan: {{ $program->service_type }}
                                </p>
                                <p class="text-lg font-bold text-primary-600 mt-2">Rp{{ number_format($program->price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <!-- Student Info -->
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">👤 Data Siswa</h4>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg space-y-2 text-sm">
                                <p><span class="text-gray-600 dark:text-gray-400">Nama Lengkap:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('student_name') }}</span></p>
                                <p><span class="text-gray-600 dark:text-gray-400">Tanggal Lahir:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('student_birthdate') }}</span></p>
                                <p><span class="text-gray-600 dark:text-gray-400">Jenis Kelamin:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('student_gender') === 'male' ? 'Laki-laki' : 'Perempuan' }}</span></p>
                                <p><span class="text-gray-600 dark:text-gray-400">No. Identitas:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('student_identity_number') }}</span></p>
                                <p><span class="text-gray-600 dark:text-gray-400">Alamat:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('student_province') }}, {{ request('student_regency') }}, {{ request('student_district') }}, {{ request('student_village') }}, {{ request('student_address_detail') }}</span></p>
                                <p><span class="text-gray-600 dark:text-gray-400">No. Whatsapp:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('student_phone') }}</span></p>
                                <p><span class="text-gray-600 dark:text-gray-400">Email:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('student_email') }}</span></p>
                                @if(request('student_job'))
                                    <p><span class="text-gray-600 dark:text-gray-400">Pekerjaan:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('student_job') }}</span></p>
                                @endif
                            </div>
                        </div>

                        <!-- Parent Info (if applicable) -->
                        @if(request('is_parent_register') === 'yes' || $studentAge < 18)
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">👨‍👩‍👧 Data Orang Tua/Wali</h4>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg space-y-2 text-sm">
                                <p><span class="text-gray-600 dark:text-gray-400">Nama Lengkap:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('parent_name') }}</span></p>
                                <p><span class="text-gray-600 dark:text-gray-400">Hubungan:</span> <span class="text-gray-900 dark:text-white font-medium">{{ ucfirst(request('parent_relationship')) }}</span></p>
                                <p><span class="text-gray-600 dark:text-gray-400">No. Identitas:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('parent_identity_number') }}</span></p>
                                <p><span class="text-gray-600 dark:text-gray-400">No. Telepon:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('parent_phone') }}</span></p>
                                <p><span class="text-gray-600 dark:text-gray-400">Email:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('parent_email') }}</span></p>
                                <p><span class="text-gray-600 dark:text-gray-400">Alamat:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('parent_address') }}</span></p>
                            </div>
                        </div>
                        @endif

                        <!-- Education Info -->
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">🎓 Tingkat Pendidikan</h4>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg space-y-2 text-sm">
                                <p><span class="text-gray-600 dark:text-gray-400">Jenjang:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('education_level') }}</span></p>
                                @if(request('class_level'))
                                    <p><span class="text-gray-600 dark:text-gray-400">Kelas/Semester:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('class_level') }}</span></p>
                                @endif
                            </div>
                        </div>

                        <!-- Payment Info -->
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">💳 Informasi Pembayaran</h4>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg space-y-2 text-sm">
                                <p><span class="text-gray-600 dark:text-gray-400">Pilihan Pembayaran:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('payment_choice') === 'pay_now' ? 'Bayar Sekarang' : 'Bayar Nanti' }}</span></p>
                                @if(request('promo_code'))
                                    <p><span class="text-gray-600 dark:text-gray-400">Kode Promo:</span> <span class="text-gray-900 dark:text-white font-medium">{{ request('promo_code') }}</span></p>
                                @endif
                            </div>
                        </div>

                        <!-- Total Summary -->
                        <div class="bg-primary-50 border border-primary-200 rounded-xl p-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-4">📊 Ringkasan Biaya</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Harga Program</span>
                                    <span class="font-semibold text-gray-900">Rp{{ number_format($program->price, 0, ',', '.') }}</span>
                                </div>
                                @if(request('promo_code'))
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Diskon Promo</span>
                                        <span class="font-semibold text-green-600">-Rp{{ number_format(0, 0, ',', '.') }}</span> <!-- TODO: Calculate actual discount -->
                                    </div>
                                @endif
                                <hr class="my-2 border-gray-300">
                                <div class="flex justify-between text-lg font-bold">
                                    <span class="text-gray-900">Total Pembayaran</span>
                                    <span class="text-primary-600">Rp{{ number_format($program->price, 0, ',', '.') }}</span> <!-- TODO: Calculate with discount -->
                                </div>
                            </div>
                        </div>

                        <!-- Warning Message -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <p class="text-yellow-800 text-sm">
                                <strong>⚠️ Perhatian:</strong> Pastikan semua data sudah benar. Setelah melanjutkan, Anda tidak dapat mengubah data pemesanan.
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('registration.step7-submit') }}" class="mt-8">
                        @csrf
                        <!-- Store all fields as hidden -->
                        @foreach(request()->all() as $key => $value)
                            @if(!in_array($key, ['_token']))
                                @if(is_array($value))
                                    @foreach($value as $item)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endif
                        @endforeach

                        <!-- Navigation Buttons -->
                        <div class="flex gap-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('registration.step5') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium">
                                ← Kembali
                            </a>
                            <button type="submit" class="ml-auto px-8 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                                Konfirmasi Pemesanan →
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
