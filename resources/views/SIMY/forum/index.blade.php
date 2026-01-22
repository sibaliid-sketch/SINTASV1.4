@extends('layouts.app')

@section('content')
@auth
    @if(in_array(auth()->user()->role, ['student', 'teacher']))
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">💬 Forum Diskusi Kelas</h1>
            <p class="mt-2 text-gray-600">Tanya jawab, diskusi, dan berbagi pengalaman dengan sesama pelajar</p>
        </div>

        <!-- New Message Form -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">✍️ Tulis Pertanyaan Baru</h2>
            
            <form action="{{ route('simy.messages.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Program</label>
                    <select name="program_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="">Pilih Program</option>
                        @foreach(auth()->user()->programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Pesan</label>
                    <select name="type" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        <option value="question">❓ Pertanyaan</option>
                        <option value="text">💬 Diskusi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pesan Anda</label>
                    <textarea name="message" placeholder="Tulis pertanyaan atau komentar Anda..." class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="4" required></textarea>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                    📤 Posting Pesan
                </button>
            </form>
        </div>

        <!-- Messages/Discussions List -->
        <div class="space-y-6">
            @forelse($messages as $message)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <!-- Message Header -->
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $message->message }}</h3>
                            @if($message->type === 'question')
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded">❓ PERTANYAAN</span>
                            @elseif($message->type === 'answer')
                            <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded">✅ JAWABAN</span>
                            @else
                            <span class="inline-block px-2 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded">💬 DISKUSI</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <span>👤 {{ $message->sender->name }}</span>
                            <span>📅 {{ $message->created_at->diffForHumans() }}</span>
                            <span>{{ $message->program->name }}</span>
                        </div>
                    </div>
                    @if($message->is_pinned)
                    <span class="text-lg">📌</span>
                    @endif
                </div>

                <!-- Message Content -->
                <p class="text-gray-700 mb-4 leading-relaxed">{{ $message->message }}</p>

                <!-- Message Reactions -->
                @if($message->reactions->count() > 0)
                <div class="mb-4 flex items-center gap-2 text-sm">
                    <span class="text-gray-600">Reaksi:</span>
                    @foreach($message->reactions->groupBy('reaction_type') as $type => $reactions)
                    <span class="px-2 py-1 bg-gray-100 rounded">
                        @php
                            $icons = [
                                'like' => '👍',
                                'love' => '❤️',
                                'wow' => '😮',
                                'thinking' => '🤔',
                                'sad' => '😢'
                            ];
                        @endphp
                        {{ $icons[$type] ?? $type }} {{ count($reactions) }}
                    </span>
                    @endforeach
                </div>
                @endif

                <!-- Reply Form -->
                <form action="{{ route('simy.messages.store') }}" method="POST" class="mb-4 p-4 bg-gray-50 rounded-lg">
                    @csrf
                    <input type="hidden" name="program_id" value="{{ $message->program_id }}">
                    <input type="hidden" name="parent_message_id" value="{{ $message->id }}">
                    <input type="hidden" name="type" value="answer">
                    <div class="flex gap-2">
                        <textarea name="message" placeholder="Tulis jawaban atau balasan..." class="flex-1 px-3 py-2 border rounded text-sm focus:ring-2 focus:ring-blue-500" rows="2" required></textarea>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm font-medium transition whitespace-nowrap">
                            Balas
                        </button>
                    </div>
                </form>

                <!-- Replies -->
                @if($message->replies->count() > 0)
                <div class="mt-4 space-y-3 border-t pt-4">
                    <p class="text-sm font-semibold text-gray-600">{{ $message->replies->count() }} Balasan</p>
                    @foreach($message->replies as $reply)
                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-blue-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium text-gray-900">{{ $reply->sender->name }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ $reply->message }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $reply->created_at->diffForHumans() }}</p>
                            </div>
                            @if($reply->reactions->count() > 0)
                            <div class="flex gap-1">
                                @foreach($reply->reactions->groupBy('reaction_type') as $type => $reactions)
                                <span class="text-xs">{{ $icons[$type] ?? $type }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @empty
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <p class="text-gray-600 text-lg">Belum ada diskusi</p>
                <p class="text-gray-500 mt-2">Jadilah yang pertama memulai diskusi atau tanya jawab</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($messages->hasPages())
        <div class="mt-8">
            {{ $messages->links() }}
        </div>
        @endif
    </div>
</div>
    @else
        <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-red-50 border border-red-200 rounded-lg p-8"><h3 class="text-red-800 font-semibold text-lg mb-2">Akses Ditolak</h3><p class="text-red-600">Anda tidak memiliki izin untuk mengakses halaman ini.</p></div></div></div>
    @endif
@else
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8"><p class="text-yellow-800">Silakan <a href="{{ route('login') }}" class="text-blue-600 underline font-semibold">login</a> terlebih dahulu.</p></div></div></div>
@endauth
@endsection
