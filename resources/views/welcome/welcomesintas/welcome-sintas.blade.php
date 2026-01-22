<x-app-layout>
    @include('components.department-header')

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <!-- Logo/Icon -->
                    <div class="mx-auto w-24 h-24 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center mb-8 shadow-lg">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>

                    <!-- Welcome Message -->
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                        Selamat Datang di
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            SINTAS
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto">
                        Sistem Informasi Terintegrasi PT. Siap Belajar Indonesia
                    </p>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
                <!-- About SINTAS -->
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-8 shadow-lg border border-gray-200/50">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900">Tentang SINTAS</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        SINTAS adalah platform terintegrasi yang dirancang khusus untuk mendukung operasional PT. Siap Belajar Indonesia.
                        Sistem ini menyediakan berbagai fitur untuk mengelola data karyawan, departemen, dan aktivitas perusahaan secara efisien.
                    </p>
                </div>

                <!-- About Company -->
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-8 shadow-lg border border-gray-200/50">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900">PT. Siap Belajar Indonesia</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Perusahaan pendidikan terkemuka yang berkomitmen untuk memberikan pengalaman belajar terbaik melalui inovasi teknologi
                        dan pendekatan pembelajaran yang modern untuk mendukung perkembangan siswa di era digital.
                    </p>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="bg-white/70 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-gray-200/50 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Aturan & SOP</h4>
                    <p class="text-gray-600 text-sm">
                        Panduan lengkap mengenai peraturan perusahaan dan standar operasional prosedur yang berlaku.
                    </p>
                </div>

                <div class="bg-white/70 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-gray-200/50 text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Dashboard Analytics</h4>
                    <p class="text-gray-600 text-sm">
                        Monitoring performa departemen dan individu dengan data real-time yang akurat.
                    </p>
                </div>

                <div class="bg-white/70 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-gray-200/50 text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Kolaborasi Tim</h4>
                    <p class="text-gray-600 text-sm">
                        Fitur komunikasi dan kolaborasi yang memudahkan koordinasi antar departemen.
                    </p>
                </div>
            </div>

            <!-- Continue Button -->
            <div class="text-center">
                <button id="continueBtn" class="inline-flex items-center px-12 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold text-lg rounded-2xl shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200">
                    <span>Mulai Eksplorasi SINTAS</span>
                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @auth
    <script>
        // Get user data from PHP
        const userRole = '{{ auth()->user()->role }}';
        const userDepartment = '{{ auth()->user()->department ?? "operations" }}';

        // Determine redirect URL based on user role and department
        let intendedRedirect = '';
        switch (userRole) {
            case 'superadmin':
                intendedRedirect = '/sintas';
                break;
            case 'admin':
                intendedRedirect = '/departments/operations';
                break;
            case 'admin_operational':
                intendedRedirect = '/departments/operations';
                break;
            case 'karyawan':
            case 'employee':
                intendedRedirect = '/departments/' + userDepartment;
                break;
            default:
                intendedRedirect = '/sintas';
        }

        console.log('==== SINTAS Welcome Page Debug ====');
        console.log('User Role:', userRole);
        console.log('User Department:', userDepartment);
        console.log('Calculated Redirect:', intendedRedirect);
        console.log('=====================================');

        // Handle button click
        document.addEventListener('DOMContentLoaded', function() {
            const continueBtn = document.getElementById('continueBtn');

            if (continueBtn) {
                continueBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Continue button clicked - redirecting to:', intendedRedirect);

                    if (intendedRedirect) {
                        window.location.href = intendedRedirect;
                    } else {
                        console.log('No intendedRedirect available - using fallback');
                        window.location.href = '/sintas';
                    }
                });
            }
        });
    </script>
    @endauth
</x-app-layout>
