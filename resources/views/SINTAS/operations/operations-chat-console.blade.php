<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Chat Console - Operations Department') }}
        </h2>
    </x-slot>

    @include('SINTAS.operations.operations-sidebar')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <h3 class="ml-2 text-lg font-medium text-gray-900">
                            Chat Console - Operations Department
                        </h3>
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8">
                    <!-- Active Chats List -->
                    <div class="md:col-span-1">
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <h4 class="text-md font-semibold text-gray-900 mb-4">Active Chats</h4>
                            <div class="space-y-2" id="active-chats">
                                @forelse($activeChats as $chat)
                                <div class="flex items-center p-3 bg-blue-50 rounded-lg cursor-pointer hover:bg-blue-100 transition-colors chat-user" data-user-id="{{ $chat['user']->id }}">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                        {{ substr($chat['user']->name, 0, 2) }}
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $chat['user']->name }}</p>
                                        <p class="text-xs text-gray-500">{{ Str::limit($chat['last_message']->message, 20) }}</p>
                                    </div>
                                    <div class="text-xs text-gray-400">{{ $chat['last_message']->created_at->diffForHumans() }}</div>
                                    @if($chat['unread_count'] > 0)
                                    <div class="ml-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                        {{ $chat['unread_count'] }}
                                    </div>
                                    @endif
                                </div>
                                @empty
                                <div class="text-center py-4">
                                    <p class="text-sm text-gray-500">No active chats</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Chat Window -->
                    <div class="md:col-span-2">
                        <div class="bg-white rounded-lg shadow-md h-96 flex flex-col">
                            <!-- Chat Header -->
                            <div class="p-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-t-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h5 class="text-sm font-medium">John Doe</h5>
                                        <p class="text-xs opacity-75">Operations Department</p>
                                    </div>
                                    <div class="ml-auto flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                        <span class="text-xs">Online</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Messages Area -->
                            <div id="admin-chat-messages" class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50">
                                <!-- Sample messages -->
                                <div class="flex justify-start">
                                    <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
                                        <div class="text-xs text-gray-500 mb-1">John Doe • 10:30 AM</div>
                                        <div class="text-sm text-gray-800">Halo, saya butuh bantuan dengan task operations.</div>
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <div class="bg-blue-500 text-white p-3 rounded-lg shadow-sm max-w-xs">
                                        <div class="text-xs text-blue-100 mb-1">Admin • 10:32 AM</div>
                                        <div class="text-sm">Baik, saya akan bantu. Apa masalahnya?</div>
                                    </div>
                                </div>

                                <div class="flex justify-start">
                                    <div class="bg-white p-3 rounded-lg shadow-sm max-w-xs">
                                        <div class="text-xs text-gray-500 mb-1">John Doe • 10:33 AM</div>
                                        <div class="text-sm text-gray-800">Task deadline sudah dekat tapi belum selesai.</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Message Input -->
                            <div class="p-4 border-t border-gray-200 bg-white">
                                <form id="admin-chat-form" class="flex space-x-2">
                                    <input type="hidden" name="user_id" value="1"> <!-- Sample user ID -->
                                    <input type="text" id="admin-message-input" name="message"
                                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="Ketik pesan Anda...">
                                    <button type="submit"
                                            class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white px-6 py-2 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                        Kirim
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('admin-chat-form');
            const input = document.getElementById('admin-message-input');
            const messages = document.getElementById('admin-chat-messages');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const message = input.value.trim();
                if (message) {
                    // Add admin message to chat
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'flex justify-end animate-slide-in-right';
                    messageDiv.innerHTML = `
                        <div class="bg-blue-500 text-white p-3 rounded-lg shadow-sm max-w-xs">
                            <div class="text-xs text-blue-100 mb-1">Admin • ${new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</div>
                            <div class="text-sm">${message}</div>
                        </div>
                    `;
                    messages.appendChild(messageDiv);
                    messages.scrollTop = messages.scrollHeight;

                    // Clear input
                    input.value = '';

                    // Send to server
                    fetch('/admin/chat/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            message: message,
                            user_id: document.querySelector('input[name="user_id"]').value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Message sent:', data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });
    </script>
</x-app-layout>
