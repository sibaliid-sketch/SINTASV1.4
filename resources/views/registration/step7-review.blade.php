<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Step 7: Tinjau Pendaftaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 70%"></div>
                    <div class="flex-1 ml-2 h-2 bg-gray-300 rounded-full" style="width: 30%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Step 7 dari 10</div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Review Order -->
                <div class="lg:col-span-2">
                    <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                        <div class="p-6">
                            <h3 class="text-2xl font-bold mb-6 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Tinjau Pesanan Anda</h3>

                            <form method="POST" action="{{ route('registration.step7-submit') }}" class="space-y-6">
                                @csrf
                                <input type="hidden" name="program_id" value="{{ $program->id }}">
                                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                                <input type="hidden" name="is_parent_register" value="{{ request('is_parent_register') }}">

                                <!-- Store all fields as hidden -->
                                @foreach(request()->all() as $key => $value)
                                    @if(!in_array($key, ['program_id', 'schedule_id', 'is_parent_register', '_token']))
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
                                            Durasi: {{ $program->duration_weeks }} minggu | Tipe: {{ $program->service_type }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Schedule Info -->
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">📅 Jadwal</h4>
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                        <p class="text-gray-900 dark:text-white font-medium">
                                            {{ $schedule->day_of_week }}
                                            @if($schedule->day_of_week !== 'Flexible')
                                                ({{ date('H:i', strtotime($schedule->start_time)) }} - {{ date('H:i', strtotime($schedule->end_time)) }})
                                            @endif
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            Ruang: {{ $schedule->room_id ?? 'TBD' }} | Peserta: {{ $schedule->current_students }}/{{ $schedule->max_students }}
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
                                    <label class="flex items-start gap-3 cursor-pointer">
                                        <input type="checkbox" name="agree_terms" value="1" class="mt-1 h-4 w-4 text-indigo-600 rounded" required>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">
                                            Saya menyetujui <a href="#" class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">syarat dan ketentuan</a> serta <a href="#" class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">kebijakan privasi</a>
                                        </span>
                                    </label>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="flex gap-4 pt-6 border-t border-gray-200">
                                    <a href="{{ route('registration.step6') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium">
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
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Diskon (0%)</span>
                                    <span class="font-semibold text-gray-900">Rp0</span>
                                </div>
                            </div>

                            <div class="flex justify-between mb-6">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span class="text-lg font-bold text-primary-600">Rp{{ number_format($program->price, 0, ',', '.') }}</span>
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

    <script>
        // Calculate student age
        const birthdateInput = document.querySelector('input[name="student_birthdate"]');
        if (birthdateInput) {
            const birthdate = new Date('{{ request("student_birthdate") }}');
            const today = new Date();
            const age = today.getFullYear() - birthdate.getFullYear();
            console.log('Student age:', age);
        }
    </script>
</x-app-layout>
