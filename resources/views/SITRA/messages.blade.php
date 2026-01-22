<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $child->name }} - Pesan & Komunikasi
        </h2>
    </x-slot>

    @auth
        @if(auth()->user()->role === 'parent')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($unreadMessages > 0)
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg text-blue-800">
                    <p>Anda memiliki <strong>{{ $unreadMessages }} pesan baru</strong></p>
                </div>
            @endif

            <!-- Conversations List -->
            <div class="bg-white rounded-lg shadow">
                <h2 class="text-2xl font-bold text-gray-900 p-6 border-b border-gray-200">Riwayat Percakapan</h2>

                <div class="divide-y divide-gray-200">
                    @forelse($conversations as $conversation)
                        <div class="p-6 hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="font-semibold text-gray-900">{{ $conversation->sender->name ?? 'Unknown' }}</h3>
                                <span class="text-sm text-gray-500">{{ $conversation->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-3">{{ substr($conversation->message, 0, 100) }}...</p>
                            <a href="{{ route('sitra.child.conversation', [$child->id, $conversation->conversation_id]) }}" class="text-blue-600 hover:underline text-sm font-medium">
                                Buka Percakapan →
                            </a>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Pesan</h3>
                            <p class="text-gray-600">Mulai komunikasi dengan guru atau admin</p>
                        </div>
                    @endforelse
                </div>

                @if($conversations->hasPages())
                    <div class="p-6 border-t border-gray-200">
                        {{ $conversations->links() }}
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
