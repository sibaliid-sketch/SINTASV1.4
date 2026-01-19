<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Konfirmasi Pemesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex-1 h-2 bg-gradient-to-r from-primary-600 to-secondary-600 rounded-full" style="width: 100%"></div>
                </div>
                <div class="text-right text-sm font-semibold text-gray-600">Section 7 dari 7 - Selesai</div>
            </div>

            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-lg border border-gray-200/50 sm:rounded-2xl">
                <div class="p-8 text-center">
                    <div class="text-6xl mb-6">🎉</div>
                    <h3 class="text-3xl font-bold mb-4 text-gray-900 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Pemesanan Berhasil!</h3>
                    <p class="text-gray-600 mb-8 text-lg">Terima kasih telah mendaftar di platform kami. Pembayaran Anda akan segera diverifikasi.</p>

                    <!-- Order Details -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">📄 Detail Pemesanan</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-600">Order ID</p>
                                <p class="font-mono text-gray-900">#ORDER123456</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Invoice ID</p>
                                <p class="font-mono text-gray-900">#INV123456</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Program</p>
                                <p class="text-gray-900">{{ $registration->program->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Layanan</p>
                                <p class="text-gray-900">{{ $registration->program->service_type }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Status Pembayaran</p>
                                <p class="text-gray-900">{{ $registration->payment_status === 'pending' ? 'Menunggu Verifikasi' : 'Belum Dibayar' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Total</p>
                                <p class="font-bold text-primary-600">Rp{{ number_format($registration->total_amount ?? $registration->program->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Next Steps -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                        <h4 class="text-lg font-semibold text-blue-900 mb-4">📋 Langkah Selanjutnya</h4>
                        <div class="text-left space-y-3 text-blue-800">
                            <div class="flex items-start gap-3">
                                <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">1</span>
                                <div>
                                    <p class="font-medium">Verifikasi Pembayaran</p>
                                    <p class="text-sm">Tim kami akan memverifikasi pembayaran dalam 1-2 hari kerja</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">2</span>
                                <div>
                                    <p class="font-medium">Aktivasi Akun</p>
                                    <p class="text-sm">Akun SITRA dan SIMY akan diaktifkan setelah verifikasi</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">3</span>
                                <div>
                                    <p class="font-medium">Mulai Belajar</p>
                                    <p class="text-sm">Anda akan mendapat akses ke materi dan jadwal kelas</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-6 mb-8">
                        <h4 class="text-lg font-semibold text-purple-900 mb-4">🎓 Akun Anda</h4>
                        <p class="text-purple-800 mb-4">Akun berikut telah dibuat secara otomatis:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-white p-4 rounded-lg border border-purple-200">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="bg-purple-600 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold">S</div>
                                    <div>
                                        <h5 class="font-semibold text-purple-900">SITRA</h5>
                                        <p class="text-sm text-purple-700">Platform Orang Tua</p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">Status: <span class="text-yellow-600 font-medium">Belum Aktif</span></p>
                                <a href="https://wa.me/6281234567890?text=Halo%20Saya%20ingin%20bergabung%20komunitas%20SITRA" target="_blank" class="inline-flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                    Bergabung Komunitas
                                </a>
                            </div>
                            <div class="bg-white p-4 rounded-lg border border-purple-200">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="bg-purple-600 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold">S</div>
                                    <div>
                                        <h5 class="font-semibold text-purple-900">SIMY</h5>
                                        <p class="text-sm text-purple-700">Platform Siswa</p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">Status: <span class="text-yellow-600 font-medium">Belum Aktif</span></p>
                                <a href="https://wa.me/6281234567890?text=Halo%20Saya%20ingin%20bergabung%20komunitas%20SIMY" target="_blank" class="inline-flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                    Bergabung Komunitas
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-8">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">📞 Butuh Bantuan?</h4>
                        <p class="text-gray-600 mb-4">Jika Anda memiliki pertanyaan atau membutuhkan bantuan, hubungi tim kami:</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                                WhatsApp Support
                            </a>
                            <a href="mailto:support@sibali.id" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Email Support
                            </a>
                        </div>
                    </div>

                    <!-- Back to Home -->
                    <div class="text-center">
                        <a href="{{ route('welcome') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-primary-600 to-secondary-600 text-white px-8 py-4 rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-200 shadow-lg hover:shadow-xl font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
