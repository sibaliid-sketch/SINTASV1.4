<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles & News - Sibali.id</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700|montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Candara:wght@400;700&family=Perpetua:wght@400;700&family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-display antialiased bg-gradient-to-br from-slate-50 via-white to-gray-100 min-h-screen">
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

    <main class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent mb-4">Articles & News</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary-500 to-secondary-500 mx-auto rounded-full"></div>
                <p class="text-xl text-gray-600 mt-4">Informasi terbaru, tips belajar, dan berita terkini dari Sibali.id</p>
            </div>

            <!-- Filter Tabs -->
            <div class="flex justify-center mb-12">
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-2 shadow-lg border border-gray-200/50">
                    <a href="{{ route('articles.index', ['type' => 'all']) }}" class="px-6 py-3 rounded-xl font-semibold transition-all duration-200 {{ request('type', 'all') === 'all' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white' : 'text-gray-600 hover:text-primary-600' }}">
                        Semua
                    </a>
                    <a href="{{ route('articles.index', ['type' => 'news']) }}" class="px-6 py-3 rounded-xl font-semibold transition-all duration-200 {{ request('type') === 'news' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white' : 'text-gray-600 hover:text-primary-600' }}">
                        Berita
                    </a>
                    <a href="{{ route('articles.index', ['type' => 'article']) }}" class="px-6 py-3 rounded-xl font-semibold transition-all duration-200 {{ request('type') === 'article' ? 'bg-gradient-to-r from-primary-500 to-secondary-500 text-white' : 'text-gray-600 hover:text-primary-600' }}">
                        Artikel
                    </a>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @forelse($articles as $article)
                    <article class="bg-white/80 backdrop-blur-sm rounded-2xl overflow-hidden shadow-lg border border-gray-200/50 hover:shadow-xl transition-shadow duration-300">
                        @if($article->image)
                            <div class="h-48 bg-gradient-to-r from-primary-400 to-secondary-400 relative overflow-hidden">
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-semibold text-gray-800">
                                        {{ ucfirst($article->type) }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-r from-primary-400 to-secondary-400 relative">
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-semibold text-gray-800">
                                        {{ ucfirst($article->type) }}
                                    </span>
                                </div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                                <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-primary-600 transition-colors duration-200">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                                    {{ $article->published_at->format('d M Y') }}
                                </time>
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-primary-600 hover:text-primary-800 font-semibold">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-2xl font-semibold text-gray-600 mb-2">Belum ada konten</h3>
                        <p class="text-gray-500">Konten akan segera ditambahkan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($articles->hasPages())
                <div class="flex justify-center">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </main>

    @include('components.admin-chat')

</body>
</html>
    <!-- Artistic Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white py-12 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-primary-500/10 to-secondary-500/10"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="space-y-4">
                    <h3 class="text-xl font-garamond font-bold bg-gradient-to-r from-primary-400 to-secondary-400 bg-clip-text text-transparent">Sibali.id</h3>
                    <p class="text-gray-300 leading-relaxed font-candara text-xs">Lembaga Penyedia Bimbingan Belajar dan Kursus Bahasa Inggris Terpercaya untuk Membangun Generasi Unggul.</p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-6 h-6 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-6 h-6 bg-gradient-to-r from-pink-500 to-pink-600 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.749.097.118.112.221.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.747-1.378 0 0-.599 2.282-.744 2.84-.282 1.084-1.064 2.456-1.549 3.235C9.584 23.815 10.77 24.001 12.017 24.001c6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001 12.017.001z"/></svg>
                        </a>
                        <a href="#" class="w-6 h-6 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/></svg>
                        </a>
                        <a href="#" class="w-6 h-6 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h4 class="text-base font-perpetua font-semibold text-white">Tautan Cepat</h4>
                    <ul class="space-y-2 font-candara text-xs">
                        <li><a href="/" class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Beranda</a></li>
                        <li><a href="/about" class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Tentang Kami</a></li>
                        <li><a href="/services" class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Layanan</a></li>
                        <li><a href="/articles" class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Artikel & Berita</a></li>
                        <li><a href="/contact" class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Kontak</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="space-y-4">
                    <h4 class="text-base font-perpetua font-semibold text-white">Layanan Kami</h4>
                    <ul class="space-y-2 font-candara text-xs">
                        <li><a href="/services#bimbel" class="text-gray-300 hover:text-secondary-400 transition-colors duration-300">Bimbingan Belajar</a></li>
                        <li><a href="/services#english" class="text-gray-300 hover:text-secondary-400 transition-colors duration-300">Kursus Bahasa Inggris</a></li>
                        <li><a href="/simy" class="text-gray-300 hover:text-secondary-400 transition-colors duration-300">SIMY</a></li>
                        <li><a href="/sitra" class="text-gray-300 hover:text-secondary-400 transition-colors duration-300">SITRA</a></li>
                        <li><a href="/sintas" class="text-gray-300 hover:text-secondary-400 transition-colors duration-300">SINTAS</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="space-y-4">
                    <h4 class="text-base font-perpetua font-semibold text-white">Hubungi Kami</h4>
                    <div class="space-y-3 font-candara text-gray-300 text-xs">
                        <div class="flex items-start space-x-2">
                            <svg class="w-4 h-4 text-primary-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Jl. Contoh No. 123, Kota, Indonesia</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>+62 123 4567 890</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-primary-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>info@sibali.id</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 mt-8 pt-6">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0">
                    <p class="text-gray-400 font-candara text-sm">&copy; 2024 PT. Siap Belajar Indonesia (Sibali.id). All rights reserved.</p>
                    <div class="flex space-x-4 text-xs font-candara">
                        <a href="/privacy" class="text-gray-400 hover:text-primary-400 transition-colors duration-300">Kebijakan Privasi</a>
                        <a href="/terms" class="text-gray-400 hover:text-primary-400 transition-colors duration-300">Syarat & Ketentuan</a>
                        <a href="/cookies" class="text-gray-400 hover:text-primary-400 transition-colors duration-300">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
