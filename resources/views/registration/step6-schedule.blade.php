<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Step 6: Pilih Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 60%"></div>
                    <div class="flex-1 ml-2 h-2 bg-gray-300 rounded-full" style="width: 40%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Step 6 dari 10</div>
            </div>

            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Pilih Jadwal Kelas</h3>
                    <p class="text-gray-600 mb-8">Program: <span class="font-semibold">{{ $program->name }}</span></p>

                    <form method="POST" action="{{ route('registration.step6-submit') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="program_id" value="{{ $program->id }}">
                        <input type="hidden" name="is_parent_register" value="{{ request('is_parent_register') }}">
                        <input type="hidden" name="education_level" value="{{ request('education_level') }}">
                        <input type="hidden" name="class_level" value="{{ request('class_level') }}">
                        <input type="hidden" name="service_type" value="{{ request('service_type') }}">

                        @if($schedules->isEmpty())
                            <div class="bg-yellow-50 dark:bg-yellow-900 border border-yellow-200 dark:border-yellow-700 rounded-lg p-4">
                                <p class="text-yellow-800 dark:text-yellow-200">Tidak ada jadwal tersedia untuk program ini. Hubungi kami untuk info lebih lanjut.</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($schedules as $schedule)
                                    <label class="relative block p-6 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-primary-500 hover:shadow-md transition-all duration-200" @if(!$schedule->isAvailable()) disabled @endif>
                                        <input type="radio" name="schedule_id" value="{{ $schedule->id }}" class="absolute top-6 right-6 h-5 w-5 text-primary-600" required @if(!$schedule->isAvailable()) disabled @endif>
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                                    {{ $schedule->day_of_week }}
                                                    @if($schedule->day_of_week !== 'Flexible')
                                                        {{ date('H:i', strtotime($schedule->start_time)) }} - {{ date('H:i', strtotime($schedule->end_time)) }}
                                                    @else
                                                        (Fleksibel)
                                                    @endif
                                                </h4>
                                                <p class="text-gray-600 text-sm">
                                                    <span class="flex items-center gap-1">📍 Ruang: {{ $schedule->room_id ?? 'TBD' }}</span>
                                                    <span class="flex items-center gap-1">📅 Mulai: {{ $schedule->start_date->format('d M Y') }}</span>
                                                </p>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-sm font-medium">
                                                    <span style="color: @if($schedule->isAvailable()) #16a34a @else #dc2626 @endif">
                                                        {{ $schedule->current_students }}/{{ $schedule->max_students }} peserta
                                                    </span>
                                                </div>
                                                @if(!$schedule->isAvailable())
                                                    <p class="text-xs text-red-600 mt-2">❌ Penuh</p>
                                                @else
                                                    <p class="text-xs text-accent-600 mt-2">✓ Tersedia</p>
                                                @endif
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @endif

                        <!-- Navigation Buttons -->
                        <div class="flex gap-4 pt-6">
                            <a href="{{ route('registration.step5') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium">
                                ← Kembali
                            </a>
                            <button type="submit" class="ml-auto px-8 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium disabled:opacity-50 disabled:cursor-not-allowed" @if($schedules->isEmpty()) disabled @endif>
                                Lanjutkan →
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
