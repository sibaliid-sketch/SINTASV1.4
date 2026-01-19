<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pendaftaran Layanan & Program') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex justify-between items-center">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full"></div>
                    <span class="ml-4 text-sm font-semibold text-gray-600">Step 1 dari 10</span>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                <div class="p-8 text-gray-900 text-center">
                    <div class="text-6xl mb-4">🎓</div>
                    <h3 class="text-3xl font-bold mb-6 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Selamat Datang!</h3>
                    <p class="mb-6 text-lg max-w-2xl mx-auto">Bergabunglah dengan program pembelajaran berkualitas untuk masa depan yang lebih cerah.</p>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                        <div class="bg-primary-50 p-4 rounded-xl border border-primary-200">
                            <div class="text-2xl mb-2">📚</div>
                            <div class="text-sm font-semibold text-primary-800">ECLAIR</div>
                        </div>
                        <div class="bg-secondary-50 p-4 rounded-xl border border-secondary-200">
                            <div class="text-2xl mb-2">🏆</div>
                            <div class="text-sm font-semibold text-secondary-800">Champion</div>
                        </div>
                        <div class="bg-accent-50 p-4 rounded-xl border border-accent-200">
                            <div class="text-2xl mb-2">🌟</div>
                            <div class="text-sm font-semibold text-accent-800">Regular</div>
                        </div>
                        <div class="bg-primary-50 p-4 rounded-xl border border-primary-200">
                            <div class="text-2xl mb-2">👨‍🏫</div>
                            <div class="text-sm font-semibold text-primary-800">Private</div>
                        </div>
                        <div class="bg-secondary-50 p-4 rounded-xl border border-secondary-200">
                            <div class="text-2xl mb-2">🏠</div>
                            <div class="text-sm font-semibold text-secondary-800">Rumah Belajar</div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('registration.step1') }}" class="px-8 py-4 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-semibold text-lg">
                            🚀 Mulai Pendaftaran
                        </a>
                        <a href="/" class="px-8 py-4 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-semibold">
                            🏠 Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-6 bg-accent-50 border border-accent-200 rounded-xl p-4">
                <p class="text-sm text-accent-800">
                    <strong>Hubungi kami:</strong> Jika Anda memiliki pertanyaan, silakan hubungi admin kami melalui WhatsApp atau email. Kami siap membantu!
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
