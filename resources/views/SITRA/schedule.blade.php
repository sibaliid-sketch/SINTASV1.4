<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $child->name }} - Jadwal Kelas
        </h2>
    </x-slot>

    @auth
        @if(auth()->user()->role === 'parent')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Jadwal Kelas Mendatang</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($upcomingClasses as $schedule)
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $schedule->program->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $schedule->program->code }}</p>
                                </div>
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                    Mendatang
                                </span>
                            </div>

                            <div class="space-y-3 mb-4">
                                <div class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2a1 1 0 100 2v10a2 2 0 002 2h12a2 2 0 002-2V9a1 1 0 100-2V5a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h12a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>{{ $schedule->date->format('d MMMM Y') }}</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00-.293.707l-2.828 2.829a1 1 0 101.415 1.415L9 10.414V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>{{ $schedule->date->format('H:i') }} WIB</span>
                                </div>
                            </div>

                            <a href="#" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded transition-colors">
                                Detail Kelas
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500">Belum ada jadwal kelas mendatang</p>
                        </div>
                    @endforelse
                </div>

                @if($upcomingClasses->hasPages())
                    <div class="mt-8">
                        {{ $upcomingClasses->links() }}
                    </div>
                @endif
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ route('sitra.dashboard') }}" class="inline-block px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                    Kembali
                </a>
            </div>
        </div>
    </div>
        @else
            <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-red-50 border border-red-200 rounded-lg p-8"><h3 class="text-red-800 font-semibold text-lg mb-2">Akses Ditolak</h3><p class="text-red-600">Anda tidak memiliki izin untuk mengakses halaman ini.</p></div></div></div>
        @endif
    @else
        <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8"><p class="text-yellow-800">Silakan <a href="{{ route('login') }}" class="text-blue-600 underline font-semibold">login</a> terlebih dahulu.</p></div></div></div>
    @endauth
</x-app-layout>
