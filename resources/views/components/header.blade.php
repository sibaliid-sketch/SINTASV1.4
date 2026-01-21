<header class="glass-effect premium-shadow border-b border-white/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Sibali.id</h1>
            </div>
            <nav class="flex space-x-8">
                <a href="/" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Kenalan Yuk!</a>
                <a href="/about" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Tentang kami</a>
                <a href="/services" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Layanan kami</a>
                <a href="/articles" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Pustaka</a>
                <a href="/contact" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Hubungi Kami</a>

                <!-- Info Lainnya Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = ! open" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium flex items-center">
                        Info Lainnya
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                        <div class="py-1">
                            <a href="/sibalion-karyawan-kami" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sibalion! Karyawan kami!</a>
                            <a href="/kurikulum-sibali-id" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Kurikulum Sibali.id</a>
                            <a href="/event" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Event</a>
                            <a href="/investing-for-investor" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Investing for Investor!</a>
                        </div>
                    </div>
                </div>

                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Login</a>
                @endauth
            </nav>
        </div>
    </div>
</header>
