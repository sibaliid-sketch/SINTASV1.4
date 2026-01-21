<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Privat',
                'code' => 'PVT',
                'description' => 'Pembelajaran one-on-one dengan tutor pribadi, jadwal fleksibel, dan materi disesuaikan. Cocok untuk siswa yang membutuhkan perhatian khusus dan pembelajaran yang dipersonalisasi.',
                'class_mode' => 'both',
                'education_levels' => ['TK/Sederajat', 'SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat', 'Mahasiswa', 'Umum'],
                'for_parent_register' => true,
                'for_self_register' => true,
                'min_age' => null,
                'max_age' => null,
                'features' => 'One-on-one learning, Jadwal fleksibel, Materi disesuaikan, Perhatian penuh dari tutor, Lokasi di rumah siswa',
                'is_active' => true,
            ],
            [
                'name' => 'Regular',
                'code' => 'REG',
                'description' => 'Pembelajaran berkelompok di kelas Sibali dengan jadwal tetap dan kurikulum terstruktur. Memberikan pengalaman belajar interaktif dengan teman sebaya.',
                'class_mode' => 'both',
                'education_levels' => ['TK/Sederajat', 'SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat', 'Mahasiswa', 'Umum'],
                'for_parent_register' => true,
                'for_self_register' => true,
                'min_age' => null,
                'max_age' => null,
                'features' => 'Pembelajaran berkelompok, Jadwal tetap, Kurikulum terstruktur, Interaksi dengan teman sebaya, Kelas di Sibali',
                'is_active' => true,
            ],
            [
                'name' => 'Rumah Belajar',
                'code' => 'RBL',
                'description' => 'Pembelajaran berkelompok kecil (minimal 2 siswa) di rumah siswa dengan suasana nyaman dan familiar. Harga lebih terjangkau dengan kualitas pembelajaran tetap terjaga.',
                'class_mode' => 'both',
                'education_levels' => ['TK/Sederajat', 'SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat', 'Mahasiswa', 'Umum'],
                'for_parent_register' => true,
                'for_self_register' => false,
                'min_age' => null,
                'max_age' => null,
                'features' => 'Kelompok kecil (>=2 siswa), Belajar di rumah, Suasana nyaman, Harga lebih terjangkau, Pembelajaran efektif',
                'is_active' => true,
            ],
            [
                'name' => 'Teman Belajar',
                'code' => 'TMB',
                'description' => 'Program pendampingan belajar komprehensif untuk semua mata pelajaran. Membantu siswa dalam mengerjakan PR, memahami materi, dan membangun kebiasaan belajar yang baik.',
                'class_mode' => 'offline',
                'education_levels' => ['SD/Sederajat'],
                'for_parent_register' => true,
                'for_self_register' => false,
                'min_age' => null,
                'max_age' => null,
                'features' => 'Pendampingan semua mapel, Bantuan PR, Membangun kebiasaan belajar, Suasana santai & memotivasi',
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['code' => $service['code']],
                $service
            );
        }
    }
}
