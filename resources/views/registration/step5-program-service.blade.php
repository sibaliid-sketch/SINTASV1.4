<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Section 4: Pilih Program & Layanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 57%"></div>
                    <div class="flex-1 ml-2 h-2 bg-gray-300 rounded-full" style="width: 43%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Section 4 dari 7</div>
            </div>

            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Pilih Program & Layanan</h3>
                    <p class="text-gray-600 mb-8">Pilih program pembelajaran yang sesuai dengan kebutuhan Anda untuk tingkat {{ $educationLevel }}</p>

                    <form method="POST" action="{{ route('registration.step5-submit') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="is_parent_register" value="{{ request('is_parent_register') }}">
                        <input type="hidden" name="education_level" value="{{ request('education_level') }}">
                        <input type="hidden" name="class_level" value="{{ request('class_level') }}">

                        @if($programs->isEmpty())
                            <div class="text-center py-8">
                                <p class="text-gray-600 dark:text-gray-400">Tidak ada program tersedia untuk level pendidikan ini</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($programs as $program)
                                    <label class="relative block p-6 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-primary-500 hover:shadow-md transition-all duration-200">
                                        <input type="radio" name="program_id" value="{{ $program->id }}" class="absolute top-6 right-6 h-5 w-5 text-primary-600" required>
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $program->name }}</h4>
                                                <p class="text-gray-600 text-sm mb-3">{{ $program->description }}</p>
                                                <div class="flex gap-4 text-sm text-gray-500">
                                                    <span class="flex items-center gap-1">📚 {{ $program->duration_weeks }} minggu</span>
                                                    <span class="flex items-center gap-1">👥 Maks {{ $program->max_students }} siswa</span>
                                                    <span class="flex items-center gap-1">🎯 {{ $program->service_type }}</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-2xl font-bold text-primary-600">
                                                    Rp{{ number_format($program->price, 0, ',', '.') }}
                                                </p>
                                                <p class="text-xs text-gray-500 mt-1">per program</p>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @endif

                        <!-- Navigation Buttons -->
                        <div class="flex gap-4 pt-6">
                            <a href="{{ route('registration.step3') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium">
                                ← Kembali
                            </a>
                            <button type="submit" class="ml-auto px-8 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium disabled:opacity-50 disabled:cursor-not-allowed" @if($programs->isEmpty()) disabled @endif>
                                Lanjutkan →
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
