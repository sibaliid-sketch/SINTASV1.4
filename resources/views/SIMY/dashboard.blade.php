<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent leading-tight">
            {{ __('SIMY - Sistem Interaktif Manajemen Pembelajaran') }}
        </h2>
    </x-slot>

    @auth
        @if(in_array(auth()->user()->role, ['student', 'teacher']))
            <!-- Include SIMY Sidebar -->
            @include('SIMY.simy-sidebar')

            <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Welcome Card -->
        <div class="mb-8 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}! 📚</h1>
                        <p class="text-blue-100 text-lg">Pantau progres pembelajaran Anda dan capai kesuksesan bersama SIMY</p>
                    </div>
                    <div class="text-6xl opacity-20">📚</div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Program</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $progressData->count() ?? 0 }}</p>
                    </div>
                    <div class="text-4xl text-blue-500">📚</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Rata-rata Progres</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $progressData->avg('overall_progress_percentage') ?? 0 }}%</p>
                    </div>
                    <div class="text-4xl text-green-500">📈</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Tugas Tertunda</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $overdueAssignments->count() ?? 0 }}</p>
                    </div>
                    <div class="text-4xl text-red-500">⚠️</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Sertifikat Selesai</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\SIMY\StudentCertificate::where('student_id', auth()->id())->count() ?? 0 }}</p>
                    </div>
                    <div class="text-4xl">🏆</div>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Dashboard Pembelajaran</h2>
            <p class="mt-2 text-gray-600">Pantau progres pembelajaran Anda di semua program</p>
        </div>

        <!-- Overall Progress Card -->
        @if($progressData->count() > 0)
        <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">📊 Progress Keseluruhan</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @foreach($progressData as $progress)
                <div class="border rounded-lg p-4 hover:shadow-lg transition">
                    <p class="text-sm font-medium text-gray-600">{{ $progress->program->name }}</p>
                    <p class="text-2xl font-bold text-blue-600 mt-2">{{ round($progress->overall_progress_percentage, 0) }}%</p>
                    <div class="mt-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progress->overall_progress_percentage }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">
                        <span class="inline-block bg-gray-100 px-2 py-1 rounded">{{ $progress->status }}</span>
                    </p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Overdue Assignments -->
                @if($overdueAssignments->count() > 0)
                <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 p-6">
                    <h3 class="text-lg font-semibold text-red-600 mb-4">⚠️ Tugas Terlambat</h3>
                    <div class="space-y-3">
                        @foreach($overdueAssignments as $assignment)
                        <div class="border-l-4 border-red-500 pl-4 py-2">
                            <p class="font-medium text-gray-900">{{ $assignment->title }}</p>
                            <p class="text-sm text-gray-600">{{ $assignment->program->name }}</p>
                            <p class="text-xs text-red-600 mt-1">Deadline: {{ $assignment->due_date->format('d M Y, H:i') }}</p>
                            <a href="{{ route('simy.assignments.show', $assignment) }}" class="mt-2 inline-block text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Upcoming Assignments -->
                @if($upcomingAssignments->count() > 0)
                <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 p-6">
                    <h3 class="text-lg font-semibold text-yellow-600 mb-4">📅 Tugas Mendatang</h3>
                    <div class="space-y-3">
                        @foreach($upcomingAssignments as $assignment)
                        <div class="border rounded-lg p-3 hover:bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $assignment->title }}</p>
                                    <p class="text-sm text-gray-600">{{ $assignment->program->name }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Deadline: {{ $assignment->due_date->diffForHumans() }}</p>
                                </div>
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-semibold">
                                    {{ $assignment->due_date->format('d M') }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('simy.assignments.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800 font-medium">
                        Lihat Semua Tugas →
                    </a>
                </div>
                @endif

                <!-- Recent Announcements -->
                @if($announcements->count() > 0)
                <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📢 Pengumuman Terbaru</h3>
                    <div class="space-y-3">
                        @foreach($announcements as $announcement)
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $announcement->title }}</p>
                                    <p class="text-sm text-gray-600">{{ Str::limit($announcement->content, 100) }}</p>
                                    <div class="mt-2 flex items-center gap-2 text-xs text-gray-500">
                                        <span>{{ $announcement->teacher->name }}</span>
                                        <span>•</span>
                                        <span>{{ $announcement->published_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $announcement->type === 'urgent' ? 'bg-red-100 text-red-800' : ($announcement->type === 'update' ? 'bg-blue-100 text-blue-800' : ($announcement->type === 'reminder' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')) }}">
                                    {{ ucfirst($announcement->type) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Recent Achievements -->
                @if($achievements->count() > 0)
                <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">🏆 Pencapaian Terbaru</h3>
                    <div class="space-y-3">
                        @foreach($achievements as $achievement)
                        <div class="text-center">
                            @if($achievement->icon_url)
                            <img src="{{ $achievement->icon_url }}" alt="{{ $achievement->title }}" class="w-12 h-12 mx-auto mb-2">
                            @else
                            <div class="w-12 h-12 mx-auto mb-2 bg-yellow-100 rounded-full flex items-center justify-center">
                                <span class="text-lg">🏅</span>
                            </div>
                            @endif
                            <p class="font-medium text-gray-900 text-sm">{{ $achievement->title }}</p>
                            <p class="text-xs text-gray-500">{{ $achievement->earned_at->format('d M Y') }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Quick Links -->
                <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">⚡ Akses Cepat</h3>
                    <div class="space-y-2">
                        <a href="{{ route('simy.materials.index') }}" class="block px-4 py-2 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 font-medium transition">
                            📚 Materi Pembelajaran
                        </a>
                        <a href="{{ route('simy.assignments.index') }}" class="block px-4 py-2 rounded-lg bg-green-50 hover:bg-green-100 text-green-700 font-medium transition">
                            ✅ Tugas & Pekerjaan
                        </a>
                        <a href="{{ route('simy.quizzes.index') }}" class="block px-4 py-2 rounded-lg bg-purple-50 hover:bg-purple-100 text-purple-700 font-medium transition">
                            📝 Kuis & Tes
                        </a>
                        <a href="{{ route('simy.progress.index') }}" class="block px-4 py-2 rounded-lg bg-orange-50 hover:bg-orange-100 text-orange-700 font-medium transition">
                            📊 Detail Progres
                        </a>
                        <a href="{{ route('simy.certificates.index') }}" class="block px-4 py-2 rounded-lg bg-pink-50 hover:bg-pink-100 text-pink-700 font-medium transition">
                            🎓 Sertifikat
                        </a>
                        <a href="{{ route('simy.forum.index') }}" class="block px-4 py-2 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-medium transition">
                            💬 Forum Diskusi
                        </a>
                    </div>
                </div>

                <!-- Stats -->
                <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📈 Statistik</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-600">Total Program Aktif</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $programs->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Pengumuman</p>
                            <p class="text-2xl font-bold text-green-600">{{ $announcements->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Pencapaian</p>
                            <p class="text-2xl font-bold text-yellow-600">{{ $achievements->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-8">
                        <h3 class="text-red-800 font-semibold text-lg mb-2">Akses Ditolak</h3>
                        <p class="text-red-600">Anda tidak memiliki izin untuk mengakses SIMY. Hanya siswa dan guru yang dapat mengakses sistem pembelajaran ini.</p>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8">
                    <p class="text-yellow-800">Silakan <a href="{{ route('login') }}" class="text-blue-600 underline font-semibold">login</a> terlebih dahulu untuk mengakses SIMY.</p>
                </div>
            </div>
        </div>
    @endauth
</x-app-layout>
