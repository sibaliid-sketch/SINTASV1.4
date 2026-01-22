<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\General\ChatMessage;
use Carbon\Carbon;

class ChatMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users for testing
        $users = User::take(5)->get();

        if ($users->isEmpty()) {
            // Create some test users if none exist
            User::create([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('password'),
                'department' => 'operations',
                'position' => 'Staff',
                'level' => 'Junior',
            ]);
            User::create([
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => bcrypt('password'),
                'department' => 'it',
                'position' => 'Staff',
                'level' => 'Junior',
            ]);
            User::create([
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'password' => bcrypt('password'),
                'department' => 'operations',
                'position' => 'Staff',
                'level' => 'Senior',
            ]);
            User::create([
                'name' => 'Alice Brown',
                'email' => 'alice@example.com',
                'password' => bcrypt('password'),
                'department' => 'it',
                'position' => 'Staff',
                'level' => 'Senior',
            ]);
            User::create([
                'name' => 'Charlie Wilson',
                'email' => 'charlie@example.com',
                'password' => bcrypt('password'),
                'department' => 'academic',
                'position' => 'Staff',
                'level' => 'Junior',
            ]);

            $users = User::take(5)->get();
        }

        // Sample chat messages for Operations department
        $operationsMessages = [
            [
                'sender_id' => $users->where('department', 'operations')->first()?->id ?? $users->first()->id,
                'message' => 'Halo admin, saya butuh bantuan dengan task operations hari ini.',
                'department' => 'operations',
                'source' => 'user',
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'sender_id' => 1, // Admin
                'message' => 'Baik, ada apa masalahnya? Saya siap membantu.',
                'department' => 'operations',
                'source' => 'admin',
                'created_at' => Carbon::now()->subHours(2)->addMinutes(5),
            ],
            [
                'sender_id' => $users->where('department', 'operations')->first()?->id ?? $users->first()->id,
                'message' => 'Deadline task sudah dekat tapi belum selesai. Bisa bantu prioritaskan?',
                'department' => 'operations',
                'source' => 'user',
                'created_at' => Carbon::now()->subHours(2)->addMinutes(10),
            ],
            [
                'sender_id' => 1, // Admin
                'message' => 'Tentu, saya akan cek status task Anda dan bantu koordinasi dengan tim.',
                'department' => 'operations',
                'source' => 'admin',
                'created_at' => Carbon::now()->subHours(2)->addMinutes(15),
            ],
            [
                'sender_id' => $users->where('department', 'operations')->skip(1)->first()?->id ?? $users->skip(1)->first()->id,
                'message' => 'Admin, ada issue dengan sistem reporting operations.',
                'department' => 'operations',
                'source' => 'user',
                'created_at' => Carbon::now()->subHours(1),
            ],
            [
                'sender_id' => 1, // Admin
                'message' => 'Baik, bisa jelaskan lebih detail masalahnya?',
                'department' => 'operations',
                'source' => 'admin',
                'created_at' => Carbon::now()->subHours(1)->addMinutes(3),
            ],
        ];

        // Sample chat messages for IT department
        $itMessages = [
            [
                'sender_id' => $users->where('department', 'it')->first()?->id ?? $users->first()->id,
                'message' => 'Halo admin, laptop saya bermasalah. Tidak bisa connect ke wifi kantor.',
                'department' => 'it',
                'source' => 'user',
                'created_at' => Carbon::now()->subHours(3),
            ],
            [
                'sender_id' => 1, // Admin
                'message' => 'Baik, saya akan bantu troubleshoot. Coba restart laptop dulu.',
                'department' => 'it',
                'source' => 'admin',
                'created_at' => Carbon::now()->subHours(3)->addMinutes(2),
            ],
            [
                'sender_id' => $users->where('department', 'it')->first()?->id ?? $users->first()->id,
                'message' => 'Sudah di-restart tapi masih sama. Error message: "Unable to join network"',
                'department' => 'it',
                'source' => 'user',
                'created_at' => Carbon::now()->subHours(3)->addMinutes(5),
            ],
            [
                'sender_id' => 1, // Admin
                'message' => 'Oke, sepertinya ada masalah dengan konfigurasi wifi. Saya akan remote access untuk cek.',
                'department' => 'it',
                'source' => 'admin',
                'created_at' => Carbon::now()->subHours(3)->addMinutes(7),
            ],
            [
                'sender_id' => $users->where('department', 'it')->skip(1)->first()?->id ?? $users->skip(1)->first()->id,
                'message' => 'Admin, aplikasi internal error saat login. Bisa bantu?',
                'department' => 'it',
                'source' => 'user',
                'created_at' => Carbon::now()->subHours(1)->addMinutes(30),
            ],
            [
                'sender_id' => 1, // Admin
                'message' => 'Tentu, error message apa yang muncul? Saya akan cek log sistem.',
                'department' => 'it',
                'source' => 'admin',
                'created_at' => Carbon::now()->subHours(1)->addMinutes(32),
            ],
            [
                'sender_id' => $users->where('department', 'it')->skip(1)->first()?->id ?? $users->skip(1)->first()->id,
                'message' => 'Error: "Invalid credentials" padahal password sudah benar.',
                'department' => 'it',
                'source' => 'user',
                'created_at' => Carbon::now()->subHours(1)->addMinutes(35),
            ],
            [
                'sender_id' => 1, // Admin
                'message' => 'Baik, sepertinya ada sync issue dengan database user. Saya akan reset cache dan coba lagi.',
                'department' => 'it',
                'source' => 'admin',
                'created_at' => Carbon::now()->subHours(1)->addMinutes(37),
            ],
        ];

        // Insert messages
        foreach ($operationsMessages as $message) {
            ChatMessage::create($message);
        }

        foreach ($itMessages as $message) {
            ChatMessage::create($message);
        }

        // Create some recent messages for active chats
        $recentOperationsMessages = [
            [
                'sender_id' => $users->where('department', 'operations')->first()?->id ?? $users->first()->id,
                'message' => 'Admin, update progress task terakhir dong.',
                'department' => 'operations',
                'source' => 'user',
                'created_at' => Carbon::now()->subMinutes(10),
            ],
            [
                'sender_id' => 1, // Admin
                'message' => 'Task sudah 80% selesai. Akan selesai hari ini juga.',
                'department' => 'operations',
                'source' => 'admin',
                'created_at' => Carbon::now()->subMinutes(5),
            ],
        ];

        $recentItMessages = [
            [
                'sender_id' => $users->where('department', 'it')->first()?->id ?? $users->first()->id,
                'message' => 'Thanks admin, wifi sudah normal sekarang!',
                'department' => 'it',
                'source' => 'user',
                'created_at' => Carbon::now()->subMinutes(15),
            ],
            [
                'sender_id' => 1, // Admin
                'message' => 'Bagus! Ada masalah lain?',
                'department' => 'it',
                'source' => 'admin',
                'created_at' => Carbon::now()->subMinutes(12),
            ],
        ];

        foreach ($recentOperationsMessages as $message) {
            ChatMessage::create($message);
        }

        foreach ($recentItMessages as $message) {
            ChatMessage::create($message);
        }

        $this->command->info('Chat messages seeded successfully!');
    }
}
