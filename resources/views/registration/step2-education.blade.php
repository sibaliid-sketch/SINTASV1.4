<x-registration-layout>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 22%"></div>
                    <div class="flex-1 ml-2 h-2 bg-gray-300 rounded-full" style="width: 78%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Section 2 dari 9</div>
            </div>

            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                <div class="py-4 px-6 text-center">
                    <div class="text-5xl mb-4">🎒</div>
                    <h3 class="text-3xl font-bold mb-6 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Tingkat Pendidikan</h3>
                    <p class="text-gray-600 mb-8 text-lg">Pilih yang sesuai dengan jenjang Anda</p>

                    <form method="POST" action="{{ route('registration.step2-submit') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="is_parent_register" value="{{ session('is_parent_register') }}">

                        <!-- Education Levels Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @if(session('is_parent_register') === 'yes')
                                @foreach(['TK', 'SD', 'SMP', 'SMA'] as $level)
                                    <label class="relative block p-6 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-primary-500 hover:shadow-lg transition-all duration-200 bg-gradient-to-br from-white to-gray-50">
                                        <input type="radio" name="education_level" value="{{ $level }}" class="absolute top-4 right-4 h-4 w-4 text-primary-600" required>
                                        <div class="text-center">
                                            <div class="text-3xl mb-3">
                                                @switch($level)
                                                    @case('TK')
                                                        🧸
                                                        @break
                                                    @case('SD')
                                                        📚
                                                        @break
                                                    @case('SMP')
                                                        🏫
                                                        @break
                                                    @case('SMA')
                                                        🎓
                                                        @break
                                                @endswitch
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $level }}</h4>
                                            <p class="text-sm text-gray-500">
                                                @switch($level)
                                                    @case('TK')
                                                        Usia 3-6 tahun
                                                        @break
                                                    @case('SD')
                                                        Usia 6-12 tahun
                                                        @break
                                                    @case('SMP')
                                                        Usia 12-15 tahun
                                                        @break
                                                    @case('SMA')
                                                        Usia 15-18 tahun
                                                        @break
                                                @endswitch
                                            </p>
                                        </div>
                                    </label>
                                @endforeach
                            @else
                                @foreach(['Mahasiswa', 'Umum'] as $level)
                                    <label class="relative block p-6 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-primary-500 hover:shadow-lg transition-all duration-200 bg-gradient-to-br from-white to-gray-50">
                                        <input type="radio" name="education_level" value="{{ $level }}" class="absolute top-4 right-4 h-4 w-4 text-primary-600" required>
                                        <div class="text-center">
                                            <div class="text-3xl mb-3">
                                                @switch($level)
                                                    @case('Mahasiswa')
                                                        🎓
                                                        @break
                                                    @case('Umum')
                                                        🌍
                                                        @break
                                                @endswitch
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $level }}</h4>
                                            <p class="text-sm text-gray-500">
                                                @switch($level)
                                                    @case('Mahasiswa')
                                                        Usia 18+ tahun
                                                        @break
                                                    @case('Umum')
                                                        Semua usia
                                                        @break
                                                @endswitch
                                            </p>
                                        </div>
                                    </label>
                                @endforeach
                            @endif
                        </div>

                        <!-- Class/Semester (conditional) -->
                        <div id="class-level-group" class="mb-6 hidden text-center">
                            <label id="class-label" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kelas</label>
                            <select name="class_level" class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                                <option value="">-- Pilih --</option>
                            </select>
                            <input type="text" id="custom-class" name="custom_class_level" placeholder="Masukkan kelas/semester lainnya" class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-900 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 mt-2 hidden">
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex gap-4 pt-6">
                            <a href="{{ route('registration.step1') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-medium">
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
        const educationRadios = document.querySelectorAll('input[name="education_level"]');
        const classLevelGroup = document.getElementById('class-level-group');
        const classLabel = document.getElementById('class-label');
        const classSelect = document.querySelector('select[name="class_level"]');
        const customClassInput = document.getElementById('custom-class');

        function populateClassOptions(level) {
            classSelect.innerHTML = '<option value="">-- Pilih --</option>';
            let options = [];

            if (level === 'TK') {
                classLabel.textContent = 'Pilih Kelas';
                options = ['TK A', 'TK B'];
            } else if (level === 'SD') {
                classLabel.textContent = 'Pilih Kelas';
                options = ['1', '2', '3', '4', '5', '6'];
            } else if (level === 'SMP') {
                classLabel.textContent = 'Pilih Kelas';
                options = ['7', '8', '9'];
            } else if (level === 'SMA') {
                classLabel.textContent = 'Pilih Kelas';
                options = ['10', '11', '12'];
            } else if (level === 'Mahasiswa') {
                classLabel.textContent = 'Pilih Semester';
                options = ['1', '2', '3', '4', '5', '6', '7', '8', '9', 'Lainnya'];
            }

            options.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option;
                opt.textContent = level === 'Mahasiswa' ? `Semester ${option}` : (level === 'TK' ? option : `Kelas ${option}`);
                classSelect.appendChild(opt);
            });
        }

        educationRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                const level = radio.value;
                const needsClass = ['TK', 'SD', 'SMP', 'SMA', 'Mahasiswa'].includes(level);
                if (needsClass) {
                    classLevelGroup.classList.remove('hidden');
                    populateClassOptions(level);
                } else {
                    classLevelGroup.classList.add('hidden');
                }
            });
        });

        classSelect.addEventListener('change', () => {
            if (classSelect.value === 'Lainnya') {
                customClassInput.classList.remove('hidden');
            } else {
                customClassInput.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
