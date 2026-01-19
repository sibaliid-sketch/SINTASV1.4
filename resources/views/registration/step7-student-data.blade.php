<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Section 3: Masukkan Data Pribadi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 42%"></div>
                    <div class="flex-1 ml-2 h-2 bg-gray-300 rounded-full" style="width: 58%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Section 3 dari 7</div>
            </div>

            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Informasi Pribadi</h3>
                    <p class="text-gray-600 mb-8">Isi data siswa dan orang tua dengan lengkap</p>

                    <form method="POST" action="{{ route('registration.step7-submit') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="program_id" value="{{ request('program_id') }}">
                        <input type="hidden" name="schedule_id" value="{{ request('schedule_id') }}">
                        <input type="hidden" name="is_parent_register" value="{{ request('is_parent_register') }}">
                        <input type="hidden" name="education_level" value="{{ request('education_level') }}">
                        <input type="hidden" name="class_level" value="{{ request('class_level') }}">
                        <input type="hidden" name="service_type" value="{{ request('service_type') }}">

                        <!-- Data Siswa Section -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">📋 @if(request('is_parent_register') === 'yes') Masukkan Data Anak Anda @else Masukkan Data diri Anda @endif</h4>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap @if(request('is_parent_register') === 'yes') Anak @endif *</label>
                                    <input type="text" name="student_name" value="{{ old('student_name') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Masukkan nama lengkap" required>
                                    @error('student_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Lahir *</label>
                                    <input type="date" name="student_birthdate" value="{{ old('student_birthdate') }}" id="student_birthdate"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                        required>
                                    @error('student_birthdate') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">No. Identitas (NIK/Passport) *</label>
                                    <input type="text" name="student_identity_number" value="{{ old('student_identity_number') }}"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                        placeholder="Cth: 1234567890123456" required>
                                    @error('student_identity_number') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Kelamin *</label>
                                    <select name="student_gender" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="male" {{ old('student_gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="female" {{ old('student_gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('student_gender') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <!-- Detailed Address -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Provinsi *</label>
                                    <input type="text" name="student_province" value="{{ old('student_province') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Provinsi" required>
                                    @error('student_province') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kabupaten *</label>
                                    <input type="text" name="student_regency" value="{{ old('student_regency') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Kabupaten" required>
                                    @error('student_regency') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kecamatan *</label>
                                    <input type="text" name="student_district" value="{{ old('student_district') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Kecamatan" required>
                                    @error('student_district') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kelurahan *</label>
                                    <input type="text" name="student_village" value="{{ old('student_village') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Kelurahan" required>
                                    @error('student_village') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alamat Lengkap *</label>
                                    <textarea name="student_address_detail" rows="2"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                        placeholder="Jl. Contoh No. 123" required>{{ old('student_address_detail') }}</textarea>
                                    @error('student_address_detail') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">@if(request('is_parent_register') === 'yes') Nomor Whatsapp Anak @else Nomor Whatsapp @endif</label>
                                    <input type="tel" name="student_phone" value="{{ old('student_phone') }}"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                        placeholder="Cth: 081234567890">
                                    @error('student_phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">@if(request('is_parent_register') === 'yes') Email Anak @else Email @endif</label>
                                    <input type="email" name="student_email" value="{{ old('student_email') }}"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                        placeholder="nama@email.com">
                                    @error('student_email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                @if(request('is_parent_register') !== 'yes')
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pekerjaan *</label>
                                    <input type="text" name="student_job" value="{{ old('student_job') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Masukkan pekerjaan" required>
                                    @error('student_job') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Data Orang Tua Section (conditional) -->
                        <div id="parent-data-section" class="border-t border-gray-200 dark:border-gray-700 pt-6 @if(request('is_parent_register') !== 'yes') hidden @endif">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">👨‍👩‍👧 Data Orang Tua/Wali</h4>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap Orang Tua *</label>
                                    <input type="text" name="parent_name" value="{{ old('parent_name') }}"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                        placeholder="Masukkan nama lengkap">
                                    @error('parent_name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">No. Identitas Orang Tua *</label>
                                    <input type="text" name="parent_identity_number" value="{{ old('parent_identity_number') }}"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                        placeholder="Cth: 1234567890123456">
                                    @error('parent_identity_number') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Hubungan dengan Siswa *</label>
                                    <select name="parent_relationship" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                        <option value="">-- Pilih --</option>
                                        <option value="father" {{ old('parent_relationship') == 'father' ? 'selected' : '' }}>Ayah</option>
                                        <option value="mother" {{ old('parent_relationship') == 'mother' ? 'selected' : '' }}>Ibu</option>
                                        <option value="guardian" {{ old('parent_relationship') == 'guardian' ? 'selected' : '' }}>Wali</option>
                                    </select>
                                    @error('parent_relationship') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">No. Telepon Orang Tua *</label>
                                    <input type="tel" name="parent_phone" value="{{ old('parent_phone') }}"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                        placeholder="Cth: 081234567890">
                                    @error('parent_phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alamat Orang Tua *</label>
                                    <textarea name="parent_address" rows="2" value="{{ old('parent_address') }}"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                        placeholder="Jl. Contoh No. 123, Kelurahan, Kecamatan">{{ old('parent_address') }}</textarea>
                                    @error('parent_address') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Orang Tua</label>
                                    <input type="email" name="parent_email" value="{{ old('parent_email') }}"
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                        placeholder="nama@email.com">
                                    @error('parent_email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
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
    </div>

    <script>
        // Toggle parent data section based on registration type
        const isParentRegisterRadios = document.querySelectorAll('input[name="is_parent_register"]');
        const parentDataSection = document.getElementById('parent-data-section');

        function toggleParentData() {
            const selectedValue = document.querySelector('input[name="is_parent_register"]:checked')?.value;
            if (selectedValue === 'yes') {
                parentDataSection.classList.remove('hidden');
            } else {
                parentDataSection.classList.add('hidden');
            }
        }

        isParentRegisterRadios.forEach(radio => {
            radio.addEventListener('change', toggleParentData);
        });
    </script>
</x-app-layout>
