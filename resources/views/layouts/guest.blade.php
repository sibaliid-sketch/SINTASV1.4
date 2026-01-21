<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-primary-600" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-4 px-6 py-3 bg-white/80 backdrop-blur-md shadow-lg border border-gray-200/50 overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>

        <!-- Floating Admin Chat Toggle -->
        <div class="fixed bottom-4 right-4 z-50">
            <button id="admin-chat-toggle" class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white rounded-full p-4 shadow-2xl transition-all duration-300 animate-pulse hover:animate-none hover:scale-110" title="Chat Admin AI">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    <circle cx="9" cy="7" r="1"></circle>
                    <circle cx="15" cy="7" r="1"></circle>
                </svg>
            </button>
        </div>

        <!-- Admin Chat Window -->
        <div id="admin-chat-window" class="fixed bottom-20 right-4 w-80 h-96 bg-white rounded-lg shadow-2xl border border-gray-200 z-40 flex flex-col">
            <div class="bg-gradient-to-r from-blue-500 to-purple-500 text-white p-3 rounded-t-lg flex justify-between items-center">
                <span class="font-semibold">Chat Admin AI</span>
                <button id="admin-chat-close" class="text-white hover:text-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="chat-messages" class="flex-1 p-3 overflow-y-auto space-y-2">
                <!-- Messages will be added here -->
            </div>
            <div class="p-3 border-t border-gray-200">
                <div class="flex space-x-2">
                    <input id="chat-input" type="text" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ketik pesan...">
                    <button id="chat-send" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                        Kirim
                    </button>
                </div>
            </div>
        </div>
    </body>
</html>
