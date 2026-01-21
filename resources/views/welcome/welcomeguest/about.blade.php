<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About - Sibali.id</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700|montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Candara:wght@400;700&family=Perpetua:wght@400;700&family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes pulseSlow {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .animate-fade-in { animation: fadeIn 0.8s ease-out forwards; opacity: 0; }
        .animate-slide-in-left { animation: slideInLeft 0.8s ease-out forwards; opacity: 0; }
        .animate-slide-in-right { animation: slideInRight 0.8s ease-out forwards; opacity: 0; }
        .animate-pulse-slow { animation: pulseSlow 2s infinite; }
        .animation-delay-100 { animation-delay: 0.1s; }
        .animation-delay-200 { animation-delay: 0.2s; }
        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-400 { animation-delay: 0.4s; }
        .animation-delay-500 { animation-delay: 0.5s; }
        .animation-delay-600 { animation-delay: 0.6s; }
        .animation-delay-700 { animation-delay: 0.7s; }
        .animation-delay-800 { animation-delay: 0.8s; }
        .animation-delay-900 { animation-delay: 0.9s; }
        .animation-delay-1100 { animation-delay: 1.1s; }
        .glow-on-hover:hover { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
        .quote-reveal { opacity: 0; transition: opacity 0.5s ease; }
        .vision-container:hover .quote-reveal { opacity: 1; }
    </style>
</head>
<body class="font-display antialiased bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
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

    <main class="py-16">
        <!-- Hero Section -->
        <section class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-5xl font-serif font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent mb-6 float">Tentang Kami</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Membangun Generasi Unggul Melalui Pendidikan Berkualitas</p>
                </div>

                <!-- Hero Image -->
                <div class="relative mb-20">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl p-1 shadow-2xl">
                        <div class="bg-white rounded-3xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1200&h=600&fit=crop&crop=center" alt="Learning Community" class="w-full h-96 object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Story Section -->
        <section class="py-16 bg-white/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-3xl font-serif font-bold text-gray-900 mb-6">Perjalanan Kami</h3>
                        <div class="space-y-6">
                            <div class="timeline-item flex items-start space-x-4">
                                <div class="w-20 h-20 bg-gradient-to-r float from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-xl">2020</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Awal Mula</h4>
                                    <p class="text-base text-gray-600 leading-relaxed">Dialect.Act dan Lembaga Sahabat Belajar lahir sebagai pionir pendidikan modern di Indonesia.</p>
                                </div>
                            </div>

                            <div class="timeline-item flex items-start space-x-4">
                                <div class="w-20 h-20 bg-gradient-to-r float from-green-500 to-teal-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-xl">2023</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Transformasi</h4>
                                    <p class="text-base text-gray-600 leading-relaxed">Bergabung menjadi PT. Siap Belajar Indonesia dengan ekosistem pendidikan komprehensif.</p>
                                </div>
                            </div>

                            <div class="timeline-item flex items-start space-x-4">
                                <div class="w-20 h-20 bg-gradient-to-r float from-orange-500 to-red-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-bold text-xl">2024</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Masa Kini</h4>
                                    <p class="text-base text-gray-600 leading-relaxed">Institusi pendidikan terdepan yang memimpin inovasi pembelajaran di Indonesia.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="bg-gradient-to-r from-green-400 to-blue-500 rounded-3xl p-1 shadow-2xl">
                            <div class="bg-white rounded-3xl overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=400&fit=crop&crop=center" alt="Team Collaboration" class="w-full h-80 object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision & Mission Section -->
        <section class="py-16 bg-gradient-to-r from-gray-900 to-gray-800 text-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Vision -->
                    <div class="text-center lg:text-left">
                        <h3 class="text-3xl font-serif font-bold mb-6">Visi Kami</h3>
                        <p class="text-xl leading-relaxed mb-8">
                            Menjadi pionir nasional dalam pemberdayaan sumber daya manusia melalui pendidikan, pelatihan, dan kemitraan digital yang inklusif — menghasilkan lulusan siap kerja dan sejahtera.
                        </p>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                            <p class="text-lg italic">
                                "Pendidikan adalah senjata paling ampuh yang dapat digunakan untuk mengubah dunia." - Nelson Mandela
                            </p>
                        </div>
                    </div>

                    <!-- Mission -->
                    <div>
                        <h3 class="text-3xl font-serif font-bold mb-6 text-center lg:text-left animate-fade-in animation-delay-100">Misi Kami</h3>
                        <div class="space-y-4">
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                                <p class="text-lg">Menyediakan bimbingan belajar dan pelatihan kompetensi yang terukur, relevan industri, dan mudah diakses.</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                                <p class="text-lg">Mengembangkan ekosistem digital-learning dan layanan pendukung untuk mempercepat transisi ke dunia kerja.</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                                <p class="text-lg">Membangun kemitraan strategis untuk menciptakan jalur pembelajaran-ke-kerja berkelanjutan.</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                                <p class="text-lg">Mengukur dan melaporkan hasil program secara transparan melalui metrik employability dan kesejahteraan.</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                                <p class="text-lg">Memelihara inklusivitas dan keberlanjutan untuk menjangkau kelompok rentan dan wilayah terpinggirkan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h3 class="text-3xl font-serif font-bold text-gray-900 mb-4 animate-fade-in">Leadership Team</h3>
                    <p class="text-xl text-gray-600">Tim eksekutif yang memimpin inovasi pendidikan</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 text-center hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl font-bold text-white">MMB</span>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Mulky Mukramyn Bangsawan</h4>
                        <p class="text-primary-600 font-medium">Chief Executive Officer</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 text-center hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl font-bold text-white">AJQY</span>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Aaron Jia Qing Yapp</h4>
                        <p class="text-primary-600 font-medium">Chief Finance Officer</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 text-center hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl font-bold text-white">Z</span>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Zam'ah</h4>
                        <p class="text-primary-600 font-medium">Chief Marketing Officer</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 text-center hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl font-bold text-white">AMA</span>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">A. Meidin Anugerah</h4>
                        <p class="text-primary-600 font-medium">Chief of Digital Marketing</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 text-center hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl font-bold text-white">MN</span>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Muhammad Nurjayadin</h4>
                        <p class="text-primary-600 font-medium">Chief Human Resource Officer</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 text-center hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl font-bold text-white">MW</span>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Muhammad Wais</h4>
                        <p class="text-primary-600 font-medium">Chief of Operation</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 text-center hover:shadow-xl transition-all duration-500 hover:scale-105 md:col-span-2 lg:col-span-1">
                        <div class="w-20 h-20 bg-gradient-to-r from-rose-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-3xl font-bold text-white">RR</span>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-2">Riny Reskiananda</h4>
                        <p class="text-primary-600 font-medium">Chief of Business & Product</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-r float from-blue-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl font-bold text-white" data-counter="1000">0</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Siswa Aktif</h4>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-r float from-green-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl font-bold text-white" data-counter="50">0</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Pengajar</h4>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-r float from-orange-500 to-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl font-bold text-white" data-counter="10">0</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Program</h4>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-r float from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-3xl font-bold text-white" data-counter="4.9">0</span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Rating</h4>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="py-16 bg-gradient-to-r from-blue-50 to-purple-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h3 class="text-3xl font-serif font-bold text-gray-900 mb-4">Nilai Kami</h3>
                    <p class="text-xl text-gray-600">Prinsip yang membimbing setiap langkah kami</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 text-center hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-blue-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Inovasi</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Selalu berinovasi dalam metode pembelajaran dan teknologi pendidikan.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 text-center hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-green-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Komunitas</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Membangun komunitas pembelajar yang saling mendukung dan berkembang.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 text-center hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-orange-500 to-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Kualitas</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Komitmen terhadap standar tertinggi dalam setiap aspek pendidikan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Service Pillars Section -->
        <section class="py-16 bg-gradient-to-r from-indigo-50 to-purple-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h3 class="text-3xl font-serif font-bold text-gray-900 mb-4">Pilar Pelayanan Sibali.id</h3>
                    <p class="text-xl text-gray-600">Fondasi yang menjadikan layanan kami unggul dan berdampak</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Kualitas Berbasis Kompetensi</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Program bimbingan dengan kurikulum terukur dan sertifikasi kompetensi untuk kesiapan kerja.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-green-500 to-teal-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Kemitraan & Integrasi Lintas Sektor</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Kolaborasi aktif dengan industri, pendidikan, dan komunitas untuk program relevan dan peluang kerja nyata.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Digital-First & Inovasi Pembelajaran</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Teknologi untuk pengalaman belajar adaptif, akses 24/7, dan pelacakan hasil berbasis data.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Inklusivitas & Kontekstualitas Lokal</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Program sensitif budaya dan kontekstual terhadap kebutuhan lokal, menjembatani akar daerah dengan skala luas.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105 md:col-span-2 lg:col-span-1">
                        <div class="w-20 h-20 bg-gradient-to-r float from-indigo-500 to-blue-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Hasil, Akuntabilitas & Pelayanan Berorientasi Dampak</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Target outcome jelas (keterampilan, penempatan, kesejahteraan) dengan mekanisme evaluasi untuk perbaikan berkelanjutan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Employee Pillars Section -->
        <section class="py-16 bg-gradient-to-r from-emerald-50 to-teal-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h3 class="text-3xl font-serif font-bold text-gray-900 mb-4">Pilar Karyawan Sibali.id</h3>
                    <p class="text-xl text-gray-600">Nilai-nilai yang menjadi landasan perilaku karyawan kami</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Profesionalisme & Kompetensi Teknis</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Bekerja dengan standar tinggi, menguasai materi, dan menjaga kualitas layanan.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-cyan-500 to-blue-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Kolaborasi & Kepemilikan</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Bekerja lintas-tim dan mitra; setiap karyawan merasa pemilik hasil dan bertanggung jawab pada keberhasilan peserta.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Energi, Proaktivitas & Ketekunan</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Bersikap inisiatif, bersemangat, dan gigih dalam mencari solusi serta menghadapi tantangan.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-rose-500 to-pink-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Empati & Inklusifitas</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Memahami keberagaman peserta, berkomunikasi dengan hangat, dan menyesuaikan pendekatan pembelajaran sesuai kebutuhan individu.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105 md:col-span-2 lg:col-span-1">
                        <div class="w-20 h-20 bg-gradient-to-r float from-violet-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Pembelajaran Berkelanjutan & Adaptabilitas Digital</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Terus mengembangkan skill termasuk literasi digital untuk mengoperasikan metodologi dan alat pembelajaran terkini.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Integrity Pillars Section -->
        <section class="py-16 bg-gradient-to-r from-slate-50 to-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h3 class="text-3xl font-serif font-bold text-gray-900 mb-4">Pilar Integritas Sibali.id</h3>
                    <p class="text-xl text-gray-600">Komitmen etika dan tanggung jawab yang menjadi landasan kepercayaan</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-slate-500 to-gray-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Transparansi & Akuntabilitas</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Melaporkan kinerja, penggunaan dana, dan hasil program secara jelas dan dapat diaudit; menerima umpan balik untuk perbaikan proses.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-emerald-500 to-green-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Etika Profesional & Anti-Korupsi</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Menjunjung tinggi kode etik, menolak praktik curang, dan memastikan keputusan berdasar kepentingan peserta dan mitra.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Perlindungan Data & Privasi</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Menjaga kerahasiaan data peserta dan mitra sesuai standar keamanan, khususnya dalam implementasi platform digital.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105">
                        <div class="w-20 h-20 bg-gradient-to-r float from-amber-500 to-yellow-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Keandalan Layanan & Pemenuhan Janji</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Menepati komitmen mutu, waktu, dan outcome kepada peserta, klien, dan mitra; segera tanggap dengan solusi jika terjadi gangguan.</p>
                    </div>

                    <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-8 shadow-lg border border-gray-200/50 hover:shadow-xl transition-all duration-500 hover:scale-105 md:col-span-2 lg:col-span-1">
                        <div class="w-20 h-20 bg-gradient-to-r float from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-serif font-semibold text-gray-900 mb-4">Tanggung Jawab Sosial & Keberlanjutan</h4>
                        <p class="text-base text-gray-600 leading-relaxed">Memprioritaskan program yang memberi manfaat sosial jangka panjang dan mempertimbangkan dampak lingkungan serta kebaikan komunitas lokal.</p>
                    </div>
                </div>
            </div>
        </section>


    </main>

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
    <div id="admin-chat-window" class="fixed bottom-20 right-4 w-80 h-96 bg-white rounded-lg shadow-2xl border border-gray-200 z-40 hidden">
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

    <script>
        // Counter animation for stats
        function animateCounters() {
            const counters = document.querySelectorAll('[data-counter]');
            counters.forEach(counter => {
                const target = parseFloat(counter.getAttribute('data-counter'));
                const duration = 2000; // 2 seconds
                const step = target / (duration / 16); // 60fps
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current);
                }, 16);
            });
        }

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.animate-fade-in, .animate-slide-in-left, .animate-slide-in-right').forEach(el => {
            observer.observe(el);
        });

        // Animate counters when stats section is visible
        const statsSection = document.querySelector('.py-16 .grid.grid-cols-2.md\\:grid-cols-4');
        if (statsSection) {
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        statsObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            statsObserver.observe(statsSection);
        }

        // Add glow effect on hover for team cards
        document.querySelectorAll('.team-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('glow-on-hover');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('glow-on-hover');
            });
        });

        // Admin Chat Toggle
        const chatToggle = document.getElementById('admin-chat-toggle');
        const chatWindow = document.getElementById('admin-chat-window');
        const chatClose = document.getElementById('admin-chat-close');

        if (chatToggle && chatWindow && chatClose) {
            chatToggle.addEventListener('click', () => {
                chatWindow.classList.remove('hidden');
                chatWindow.classList.add('flex', 'flex-col');
            });

            chatClose.addEventListener('click', () => {
                chatWindow.classList.add('hidden');
                chatWindow.classList.remove('flex', 'flex-col');
            });
        }
    </script>

</body>
</html>
