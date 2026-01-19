<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Step 4: Pilih Layanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 40%"></div>
                    <div class="flex-1 ml-2 h-2 bg-gray-300 rounded-full" style="width: 60%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Step 4 dari 10</div>
            </div>

            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Pilih Layanan</h3>
                    <p class="text-gray-600 mb-8">Berdasarkan tingkat pendidikan <strong>{{ $educationLevel }}</strong>, layanan yang tersedia:</p>

                    <form method="POST" action="{{ route('registration.step4-submit') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="education_level" value="{{ $educationLevel }}">

                        <!-- Service Type Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">Layanan Tersedia</label>
                            <div class="space-y-3">
                                @foreach($serviceTypes as $serviceType)
                                    <label class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <input type="radio" name="service_type" value="{{ $serviceType }}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" required>
                                        <div class="ml-3">
                                            <span class="block text-sm font-medium text-gray-900 dark:text-white">{{ $serviceType }}</span>
                                            <span class="block text-xs text-gray-500 dark:text-gray-400">
                                                @if($serviceType === 'SIMY')
                                                    Layanan untuk anak-anak (TK/SD)
                                                @elseif($serviceType === 'SITRA')
                                                    Layanan untuk remaja (SMP/SMA)
                                                @elseif($serviceType === 'SINTAS')
                                                    Layanan untuk dewasa (Mahasiswa/Umum)
                                                @endif
                                            </span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('service_type') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex gap-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('registration.step3') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium">
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
</x-app-layout>
