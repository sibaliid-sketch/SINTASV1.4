<!-- Floating Admin Chat Toggle -->
<div class="fixed bottom-4 right-4 z-50">
    <button id="admin-chat-toggle" class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white rounded-full p-4 shadow-2xl transition-all duration-300 animate-pulse hover:animate-none hover:scale-110 relative" title="Chat Admin AI">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            <circle cx="9" cy="7" r="1"></circle>
            <circle cx="15" cy="7" r="1"></circle>
        </svg>
    </button>
</div>

<!-- Admin Chat Window -->
<div id="admin-chat-window" class="fixed bottom-20 right-4 w-80 h-96 bg-white rounded-2xl shadow-2xl border border-gray-200/50 z-40 flex flex-col transform transition-all duration-300 ease-in-out scale-95 opacity-0">
    <div class="bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 text-white p-4 rounded-t-2xl flex justify-between items-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20 animate-pulse"></div>
        <div class="relative flex items-center space-x-2">
            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
            <span class="font-semibold text-sm">Chat Admin AI</span>
        </div>
        <div class="flex items-center space-x-1">
            <!-- Minimize Button -->
            <button id="admin-chat-minimize" class="relative text-white/80 hover:text-white transition-colors p-1 rounded-full hover:bg-white/10" title="Minimize">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                </svg>
            </button>
            <!-- Close Button -->
            <button id="admin-chat-close" class="relative text-white/80 hover:text-white transition-colors p-1 rounded-full hover:bg-white/10" title="Close">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    <div id="chat-messages" class="flex-1 p-4 overflow-y-auto space-y-3 bg-gradient-to-b from-gray-50 to-white">
        <!-- Messages will be added here -->
        <div class="text-center text-gray-500 text-xs py-4">
            Selamat datang! Bagaimana saya bisa membantu Anda hari ini?
        </div>
    </div>

    <!-- Typing Indicator -->
    <div id="typing-indicator" class="px-4 py-2 text-xs text-gray-500 flex items-center space-x-2">
        <div class="flex space-x-1">
            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
        </div>
        <span>Admin sedang mengetik...</span>
    </div>

    <div id="chat-input-area" class="p-4 border-t border-gray-200/50 bg-gray-50/50">
        <div class="flex space-x-2">
            <input id="chat-input" type="text" class="flex-1 px-4 py-3 border border-gray-300/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-400 bg-white/80 backdrop-blur-sm transition-all duration-200 text-sm" placeholder="Ketik pesan Anda...">
            <button id="chat-send" class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white px-4 py-3 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </button>
        </div>
        <div class="text-xs text-gray-400 mt-2 text-center">
            Pesan Anda akan dijawab segera
        </div>
    </div>
</div>

<script>
    // Advanced Admin Chat Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('admin-chat-toggle');
        const chatWindow = document.getElementById('admin-chat-window');
        const closeButton = document.getElementById('admin-chat-close');
        const minimizeButton = document.getElementById('admin-chat-minimize');
        const chatInput = document.getElementById('chat-input');
        const sendButton = document.getElementById('chat-send');
        const messagesContainer = document.getElementById('chat-messages');
        const typingIndicator = document.getElementById('typing-indicator');
        const inputArea = document.getElementById('chat-input-area');

        let isOpen = false;
        let isMinimized = false;
        let lastMessageId = 0;
        let pollInterval;

        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Initialize chat
        initializeChat();

        function initializeChat() {
            // Load existing messages
            loadMessages();

            // Start polling for new messages
            startPolling();

            // Load chat state from localStorage
            loadChatState();
        }

        function toggleChat() {
            isOpen = !isOpen;
            if (isOpen) {
                chatWindow.classList.remove('scale-95', 'opacity-0');
                chatWindow.classList.add('scale-100', 'opacity-100');
                chatInput.focus();
            } else {
                chatWindow.classList.remove('scale-100', 'opacity-100');
                chatWindow.classList.add('scale-95', 'opacity-0');
            }
            saveChatState();
        }

        function toggleMinimize() {
            isMinimized = !isMinimized;
            if (isMinimized) {
                chatWindow.style.height = '60px'; // Header height
                messagesContainer.style.maxHeight = '0px';
                messagesContainer.style.overflow = 'hidden';
                typingIndicator.classList.add('hidden');
                inputArea.classList.add('hidden');
            } else {
                chatWindow.style.height = '';
                messagesContainer.style.maxHeight = '';
                messagesContainer.style.overflow = '';
                inputArea.classList.remove('hidden');
                chatInput.focus();
            }
            saveChatState();
        }

        function getSource() {
            const path = window.location.pathname;
            if (path === '/' || path.startsWith('/?')) return 'welcome';
            if (path.startsWith('/simy')) return 'simy';
            if (path.startsWith('/sitra')) return 'sitra';
            if (path.startsWith('/sintas')) return 'sintas';
            return 'welcome'; // default
        }

        function sendMessage() {
            const message = chatInput.value.trim();
            if (!message || !csrfToken) return;

            // Disable input while sending
            chatInput.disabled = true;
            sendButton.disabled = true;

            // Add user message immediately
            addMessage(message, 'user');

            // Clear input
            chatInput.value = '';

            // Send to server
            fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: message, source: getSource() })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Show typing indicator
                    showTypingIndicator();

                    // Simulate AI response delay
                    setTimeout(() => {
                        hideTypingIndicator();
                        // The polling will pick up the AI response
                    }, 1500);
                }
            })
            .catch(error => {
                console.error('Error sending message:', error);
                addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'error');
            })
            .finally(() => {
                chatInput.disabled = false;
                sendButton.disabled = false;
                chatInput.focus();
            });
        }

        function loadMessages() {
            if (!csrfToken) return;

            fetch('/chat/messages', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.messages) {
                    data.messages.forEach(msg => {
                        addMessage(msg.message, msg.is_mine ? 'user' : 'ai', msg.created_at);
                        lastMessageId = Math.max(lastMessageId, msg.id);
                    });
                    scrollToBottom();
                }
            })
            .catch(error => {
                console.error('Error loading messages:', error);
            });
        }

        function startPolling() {
            pollInterval = setInterval(() => {
                if (!csrfToken) return;

                fetch(`/chat/messages?last_id=${lastMessageId}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.messages && data.messages.length > 0) {
                        let newMessageCount = 0;
                        data.messages.forEach(msg => {
                            if (!msg.is_mine) {
                                addMessage(msg.message, 'ai', msg.created_at);
                                newMessageCount++;
                            }
                            lastMessageId = Math.max(lastMessageId, msg.id);
                        });



                        scrollToBottom();
                    }
                })
                .catch(error => {
                    console.error('Error polling messages:', error);
                });
            }, 3000); // Poll every 3 seconds
        }

        function addMessage(message, type, timestamp = null) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex ${type === 'user' ? 'justify-end' : 'justify-start'} animate-fade-in`;

            const timeString = timestamp || new Date().toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });

            if (type === 'user') {
                messageDiv.innerHTML = `
                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 text-white p-3 rounded-2xl shadow-lg max-w-xs relative">
                        <div class="text-sm">${message}</div>
                        <div class="text-xs text-blue-100 mt-1 opacity-75">${timeString}</div>
                        <div class="absolute -bottom-1 right-2 w-0 h-0 border-l-4 border-l-transparent border-r-4 border-r-transparent border-t-4 border-t-blue-500"></div>
                    </div>
                `;
            } else if (type === 'ai') {
                messageDiv.innerHTML = `
                    <div class="bg-white text-gray-800 p-3 rounded-2xl shadow-lg max-w-xs border border-gray-200 relative">
                        <div class="text-sm">${message}</div>
                        <div class="text-xs text-gray-500 mt-1">${timeString}</div>
                        <div class="absolute -bottom-1 left-2 w-0 h-0 border-l-4 border-l-transparent border-r-4 border-r-transparent border-t-4 border-t-white"></div>
                    </div>
                `;
            } else if (type === 'error') {
                messageDiv.innerHTML = `
                    <div class="bg-red-100 text-red-800 p-3 rounded-2xl shadow-lg max-w-xs border border-red-200">
                        <div class="text-sm">${message}</div>
                        <div class="text-xs text-red-600 mt-1">${timeString}</div>
                    </div>
                `;
            }

            messagesContainer.appendChild(messageDiv);
            scrollToBottom();
        }

        function showTypingIndicator() {
            typingIndicator.classList.remove('hidden');
            scrollToBottom();
        }

        function hideTypingIndicator() {
            typingIndicator.classList.add('hidden');
        }

        function scrollToBottom() {
            setTimeout(() => {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }, 100);
        }



        function saveChatState() {
            localStorage.setItem('adminChatState', JSON.stringify({
                isOpen,
                isMinimized
            }));
        }

        function loadChatState() {
            const state = localStorage.getItem('adminChatState');
            if (state) {
                const { isOpen: savedIsOpen, isMinimized: savedIsMinimized } = JSON.parse(state);
                if (savedIsOpen) {
                    toggleChat();
                }
                if (savedIsMinimized) {
                    toggleMinimize();
                }
            }
        }

        // Event Listeners
        toggleButton.addEventListener('click', toggleChat);
        closeButton.addEventListener('click', () => {
            isOpen = false;
            chatWindow.classList.remove('scale-100', 'opacity-100');
            chatWindow.classList.add('scale-95', 'opacity-0');
            saveChatState();
        });
        minimizeButton.addEventListener('click', toggleMinimize);

        sendButton.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        chatInput.addEventListener('input', function() {
            sendButton.disabled = !this.value.trim();
        });

        // Auto-resize chat window based on content
        const resizeObserver = new ResizeObserver(() => {
            if (!isMinimized) {
                const maxHeight = window.innerHeight * 0.6; // Max 60% of screen height
                chatWindow.style.maxHeight = `${maxHeight}px`;
            }
        });
        resizeObserver.observe(messagesContainer);

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (pollInterval) {
                clearInterval(pollInterval);
            }
        });

        // Handle visibility change (pause polling when tab is hidden)
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                if (pollInterval) {
                    clearInterval(pollInterval);
                    pollInterval = null;
                }
            } else {
                if (!pollInterval) {
                    startPolling();
                }
            }
        });

        // Add some CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fade-in {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fade-in 0.3s ease-out;
            }
            .animate-slide-in-right {
                animation: slideInRight 0.3s ease-out;
            }
            @keyframes slideInRight {
                from { opacity: 0; transform: translateX(20px); }
                to { opacity: 1; transform: translateX(0); }
            }
        `;
        document.head.appendChild(style);
    });
</script>
