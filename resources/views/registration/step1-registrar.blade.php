<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Step 1: Pilih Tipe Pendaftar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 11%"></div>
                    <div class="flex-1 ml-2 h-2 bg-gray-300 rounded-full" style="width: 89%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Section 1 dari 9</div>
            </div>

            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                <div class="py-4 px-6 text-center">
                    <div class="text-5xl mb-4">👤</div>
                    <h3 class="text-3xl font-bold mb-6 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Siapa yang Memesan?</h3>
                    <p class="text-gray-600 mb-8 text-lg">Pilih opsi yang sesuai untuk melanjutkan</p>

                    <form method="POST" action="{{ route('registration.step1-submit') }}" class="space-y-6">
                        @csrf

                        <!-- Option 1: Self Register -->
                        <label class="relative block p-8 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-primary-500 hover:shadow-lg transition-all duration-200 bg-primary-50/50" for="self_register">
                            <input type="radio" name="is_parent_register" value="no" id="self_register" class="absolute top-6 right-6 h-5 w-5 text-primary-600" required>
                            <div class="flex items-center justify-center flex-col">
                                <div class="text-4xl mb-4">🎓</div>
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Untuk Diri Sendiri</h4>
                                <p class="text-gray-600 text-center">Saya siswa yang ingin belajar</p>
                            </div>
                        </label>

                        <!-- Option 2: Parent Register -->
                        <label class="relative block p-8 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-primary-500 hover:shadow-lg transition-all duration-200 bg-secondary-50/50" for="parent_register">
                            <input type="radio" name="is_parent_register" value="yes" id="parent_register" class="absolute top-6 right-6 h-5 w-5 text-primary-600" required>
                            <div class="flex items-center justify-center flex-col">
                                <div class="text-4xl mb-4">👨‍👩‍👧‍👦</div>
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Untuk Anak Saya</h4>
                                <p class="text-gray-600 text-center">Saya orang tua yang mendaftarkan anak</p>
                            </div>
                        </label>

                        <!-- Navigation Buttons -->
                        <div class="flex gap-4 pt-8 justify-center">
                            <a href="/" class="px-8 py-4 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-semibold">
                                ← Kembali
                            </a>
                            <button type="submit" class="px-8 py-4 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-semibold">
                                Lanjutkan →
                            </button>
                        </div>
                    </form>

                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-800 font-semibold">Masuk di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
