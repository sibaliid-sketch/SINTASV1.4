import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Carousel functionality
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('carousel');
    const dots = document.querySelectorAll('.carousel-dot');
    let currentIndex = 0;
    const totalSlides = 5;
    let autoSlideInterval;

    function updateCarousel() {
        if (carousel) {
            carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
            dots.forEach((dot, index) => {
                dot.classList.toggle('bg-white', index === currentIndex);
                dot.classList.toggle('bg-white/50', index !== currentIndex);
            });
        }
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateCarousel();
    }

    function goToSlide(index) {
        currentIndex = index;
        updateCarousel();
    }

    // Auto slide every 4 seconds
    autoSlideInterval = setInterval(nextSlide, 4000);

    // Dot navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            goToSlide(index);
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(nextSlide, 4000);
        });
    });

    // Pause on hover
    if (carousel) {
        carousel.parentElement.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });
        carousel.parentElement.addEventListener('mouseleave', () => {
            autoSlideInterval = setInterval(nextSlide, 4000);
        });
    }
});
// Counter animation for stats
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('[data-counter]');
    const speed = 200; // The lower the slower

    const animateCounter = (counter) => {
        const target = +counter.getAttribute('data-counter');
        const count = +counter.innerText;
        const inc = target / speed;

        if (count < target) {
            counter.innerText = Math.ceil(count + inc);
            setTimeout(() => animateCounter(counter), 1);
        } else {
            counter.innerText = target;
        }
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => {
        observer.observe(counter);
    });
});

// Timeline animation for story
document.addEventListener('DOMContentLoaded', function() {
    const timelineItems = document.querySelectorAll('.timeline-item');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
            }
        });
    }, { threshold: 0.5 });

    timelineItems.forEach(item => {
        observer.observe(item);
    });
});

// Chat functionality
document.addEventListener('DOMContentLoaded', function() {
    const chatToggle = document.getElementById('admin-chat-toggle');
    const chatWindow = document.getElementById('admin-chat-window');
    const chatClose = document.getElementById('admin-chat-close');
    const chatInput = document.getElementById('chat-input');
    const chatSend = document.getElementById('chat-send');
    const chatMessages = document.getElementById('chat-messages');

    if (chatToggle && chatWindow) {
        // Toggle chat window with animation
        chatToggle.addEventListener('click', function() {
            if (chatWindow.classList.contains('hidden')) {
                chatWindow.classList.remove('hidden');
                setTimeout(() => {
                    chatWindow.classList.remove('scale-95', 'opacity-0');
                    chatWindow.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                chatWindow.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    chatWindow.classList.add('hidden');
                    chatWindow.classList.remove('scale-100', 'opacity-100');
                }, 300);
            }
        });

        // Close chat window
        if (chatClose) {
            chatClose.addEventListener('click', function() {
                chatWindow.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    chatWindow.classList.add('hidden');
                    chatWindow.classList.remove('scale-100', 'opacity-100');
                }, 300);
            });
        }

        // Get current time
        function getCurrentTime() {
            const now = new Date();
            return now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        }

        let lastMessageId = 0;

        // Function to add message to UI
        function addMessageToUI(messageData) {
            const messageDiv = document.createElement('div');
            if (messageData.is_mine) {
                messageDiv.className = 'flex justify-end animate-slide-in-right';
                messageDiv.innerHTML = `
                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 text-white p-3 rounded-2xl max-w-xs shadow-lg">
                        <div class="text-xs text-blue-100 mb-1">Anda</div>
                        <div class="text-sm">${messageData.message}</div>
                        <div class="text-xs text-blue-200 mt-1 text-right">${messageData.created_at}</div>
                    </div>
                `;
            } else {
                const senderLabel = messageData.sender_type === 'ai' ? 'AI Assistant' : 'Admin';
                const senderColor = messageData.sender_type === 'ai' ? 'green' : 'purple';
                messageDiv.className = 'flex justify-start animate-slide-in-left';
                messageDiv.innerHTML = `
                    <div class="bg-white border border-gray-200 p-3 rounded-2xl max-w-xs shadow-lg">
                        <div class="text-xs text-gray-500 mb-1 flex items-center">
                            <div class="w-2 h-2 bg-${senderColor}-400 rounded-full mr-1"></div>
                            ${senderLabel}
                        </div>
                        <div class="text-sm text-gray-800">${messageData.message}</div>
                        <div class="text-xs text-gray-400 mt-1">${messageData.created_at}</div>
                    </div>
                `;
            }
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Function to fetch new messages
        function fetchNewMessages() {
            fetch(`/chat/messages?last_id=${lastMessageId}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                data.messages.forEach(message => {
                    addMessageToUI(message);
                    lastMessageId = Math.max(lastMessageId, message.id);
                });
            })
            .catch(error => console.error('Error fetching messages:', error));
        }

        // Send message function
        function sendMessage() {
            const message = chatInput.value.trim();
            if (message) {
                // Clear input
                chatInput.value = '';
                chatSend.disabled = true;

                // Send to server
                fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Fetch new messages to update UI
                        fetchNewMessages();
                        chatSend.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    chatSend.disabled = false;
                });
            }
        }

        // Start polling for new messages
        setInterval(fetchNewMessages, 3000); // Poll every 3 seconds

        // Enable/disable send button based on input
        if (chatInput) {
            chatInput.addEventListener('input', function() {
                chatSend.disabled = !this.value.trim();
            });
        }

        // Send on button click
        if (chatSend) {
            chatSend.addEventListener('click', sendMessage);
        }

        // Send on enter key
        if (chatInput) {
            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });
        }
    }
});
