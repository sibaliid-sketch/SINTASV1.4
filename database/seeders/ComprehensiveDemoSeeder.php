<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Welcomeguest\Service;
use App\Models\General\Program;
use App\Models\General\Schedule;
use App\Models\General\Registration;
use App\Models\General\PaymentProof;
use App\Models\SINTAS\Attendance;
use App\Models\SIMY\Material;
use App\Models\SIMY\Assignment;
use App\Models\SIMY\AssignmentSubmission;
use App\Models\SIMY\Quiz;
use App\Models\SIMY\QuizQuestion;
use App\Models\SIMY\QuizOption;
use App\Models\SIMY\QuizAttempt;
use App\Models\SIMY\QuizAnswer;
use App\Models\SIMY\StudentProgress;
use App\Models\SIMY\StudentAchievement;
use App\Models\SIMY\StudentCertificate;
use App\Models\General\ChatMessage;
use App\Models\General\ClassMessage;
use App\Models\General\ClassAnnouncement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ComprehensiveDemoSeeder extends Seeder
{
    public function run(): void
    {
        // 0. Create Guardian (Parent)
        $guardian = User::updateOrCreate(
            ['email' => 'guardian@sintasv1.test'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password123'),
                'role' => 'parent',
                'department' => 'sitra',
                'position' => 'parent',
                'level' => 'user',
                'phone' => '081234567890',
                'address' => 'Jl. Sudirman No. 123, Jakarta'
            ]
        );

        // 1. Create Teachers/Instructors
        $teachers = [
            [
                'name' => 'Dr. Ahmad Santoso',
                'email' => 'ahmad.teacher@sintasv1.test',
                'role' => 'karyawan',
                'department' => 'academic',
                'position' => 'Teacher',
                'level' => 'Senior',
            ],
            [
                'name' => 'Ibu Siti Nurhaliza',
                'email' => 'siti.teacher@sintasv1.test',
                'role' => 'karyawan',
                'department' => 'academic',
                'position' => 'Teacher',
                'level' => 'Senior',
            ]
        ];

        foreach ($teachers as $teacherData) {
            User::updateOrCreate(
                ['email' => $teacherData['email']],
                array_merge($teacherData, ['password' => Hash::make('password123')])
            );
        }

        // 2. Create Students with parent linkage
        $guardian = User::where('email', 'guardian@sintasv1.test')->first();

        $students = [
            [
                'name' => 'Ahmad Rahman',
                'email' => 'ahmad.student@sintasv1.test',
                'parent_id' => $guardian->id,
                'date_of_birth' => Carbon::parse('2010-05-15'),
                'phone' => '081234567890',
                'address' => 'Jl. Sudirman No. 123, Jakarta'
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti.student@sintasv1.test',
                'parent_id' => $guardian->id,
                'date_of_birth' => Carbon::parse('2011-08-20'),
                'phone' => '081234567891',
                'address' => 'Jl. Thamrin No. 456, Jakarta'
            ]
        ];

        $createdStudents = [];
        foreach ($students as $studentData) {
            $student = User::updateOrCreate(
                ['email' => $studentData['email']],
                array_merge($studentData, [
                    'password' => Hash::make('password123'),
                    'role' => 'siswa'
                ])
            );
            $createdStudents[] = $student;
        }

        // 3. Create comprehensive program data
        $service = Service::first();
        if (!$service) {
            $service = Service::create([
                'name' => 'Layanan Pembelajaran',
                'description' => 'Layanan pembelajaran untuk siswa',
                'category' => 'education',
                'is_active' => true
            ]);
        }

        $program = Program::updateOrCreate(
            ['name' => 'Paket Belajar Matematika Dasar'],
            [
                'service_id' => $service->id,
                'description' => 'Program pembelajaran matematika untuk siswa SD-SMP',
                'education_level' => 'SD',
                'class_mode' => 'online',
                'service_type' => 'Regular-in Class',
                'duration' => 24,
                'price' => 500000,
                'curriculum' => 'Kurikulum matematika dasar meliputi operasi bilangan, geometri, dan aljabar sederhana',
                'max_students' => 20,
                'is_active' => true
            ]
        );

        // 4. Create schedules for the program
        $schedules = [
            [
                'schedule_id' => 'SCH-MATH-001',
                'program_id' => $program->id,
                'day_of_week' => 'Monday',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
                'max_students' => 20,
                'start_date' => Carbon::now()->subDays(30),
                'notes' => 'Kelas matematika dasar'
            ],
            [
                'schedule_id' => 'SCH-MATH-002',
                'program_id' => $program->id,
                'day_of_week' => 'Wednesday',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
                'max_students' => 20,
                'start_date' => Carbon::now()->subDays(30),
                'notes' => 'Kelas matematika lanjutan'
            ]
        ];

        foreach ($schedules as $scheduleData) {
            Schedule::updateOrCreate(
                ['schedule_id' => $scheduleData['schedule_id']],
                $scheduleData
            );
        }

        // 5. Create registrations and payments for students
        foreach ($createdStudents as $student) {
            $registration = Registration::updateOrCreate(
                ['student_id' => $student->id, 'program_id' => $program->id],
                [
                    'order_id' => 'ORD' . str_pad($student->id, 6, '0', STR_PAD_LEFT),
                    'schedule_id' => 1, // Use first schedule
                    'student_name' => $student->name,
                    'student_dob' => $student->date_of_birth,
                    'student_phone' => $student->phone,
                    'student_email' => $student->email,
                    'student_address' => $student->address,
                    'education_level' => 'SD',
                    'is_self_register' => false,
                    'parent_name' => $guardian->name,
                    'parent_phone' => $guardian->phone,
                    'parent_email' => $guardian->email,
                    'status' => 'active',
                    'base_price' => $program->price,
                    'discount_amount' => 0,
                    'tax_amount' => 0,
                    'total_price' => $program->price,
                    'payment_method' => 'transfer_bank',
                    'payment_status' => 'paid',
                    'payment_deadline' => Carbon::now()->addDays(7),
                    'invoice_id' => 'INV/01/26/' . str_pad($student->id, 4, '0', STR_PAD_LEFT),
                    'contract_id' => 'KTR/STU/26.01/ST' . str_pad($student->id, 4, '0', STR_PAD_LEFT),
                ]
            );

            // Create payment proof
            PaymentProof::updateOrCreate(
                ['registration_id' => $registration->id],
                [
                    'file_path' => 'payment_proofs/' . $registration->order_id . '.pdf',
                    'file_name' => $registration->order_id . '_payment.pdf',
                    'bank_name' => 'BCA',
                    'sender_name' => $guardian->name,
                    'amount' => $program->price,
                    'transfer_date' => Carbon::now()->subDays(25),
                    'status' => 'verified',
                    'verified_at' => Carbon::now()->subDays(25)
                ]
            );
        }

        // 6. Create attendance records (simplified)
        foreach ($createdStudents as $student) {
            // Create attendance for today
            Attendance::updateOrCreate(
                [
                    'user_id' => $student->id,
                    'date' => Carbon::today()->format('Y-m-d')
                ],
                [
                    'check_in' => Carbon::now()->subHours(2),
                    'check_out' => Carbon::now()->subHours(1),
                    'status' => 'present',
                    'notes' => 'Hadir tepat waktu'
                ]
            );
        }

        // 7. Create SIMY Materials
        $materials = [
            [
                'program_id' => $program->id,
                'title' => 'Materi Operasi Bilangan',
                'description' => 'Pembelajaran tentang penjumlahan, pengurangan, perkalian, dan pembagian',
                'content' => 'Operasi bilangan adalah dasar matematika...',
                'type' => 'document',
                'media_url' => 'materials/math_operations.pdf',
                'order' => 1,
                'is_published' => true,
                'published_at' => Carbon::now()
            ],
            [
                'program_id' => $program->id,
                'title' => 'Video Pembelajaran Pecahan',
                'description' => 'Penjelasan lengkap tentang pecahan dan operasinya',
                'content' => 'Pecahan merupakan bagian dari bilangan...',
                'type' => 'video',
                'media_url' => 'materials/fractions_video.mp4',
                'order' => 2,
                'is_published' => true,
                'published_at' => Carbon::now()
            ]
        ];

        foreach ($materials as $materialData) {
            Material::updateOrCreate(
                ['program_id' => $materialData['program_id'], 'title' => $materialData['title']],
                $materialData
            );
        }

        // 8. Create Assignments
        $assignments = [
            [
                'program_id' => $program->id,
                'schedule_id' => 1,
                'teacher_id' => 2, // Use teacher
                'title' => 'Latihan Operasi Bilangan',
                'description' => 'Kerjakan soal-soal berikut dengan benar',
                'instructions' => 'Jawab semua soal dan upload foto hasil kerja',
                'due_date' => Carbon::now()->addDays(7),
                'max_score' => 100,
                'is_published' => true,
                'published_at' => Carbon::now()
            ]
        ];

        foreach ($assignments as $assignmentData) {
            $assignment = Assignment::updateOrCreate(
                ['program_id' => $assignmentData['program_id'], 'title' => $assignmentData['title']],
                $assignmentData
            );

            // Create submissions for students
            foreach ($createdStudents as $student) {
                AssignmentSubmission::updateOrCreate(
                    ['assignment_id' => $assignment->id, 'student_id' => $student->id],
                    [
                        'submission_text' => 'Jawaban tugas telah disubmit.',
                        'submission_file_url' => 'submissions/assignment_' . $assignment->id . '_student_' . $student->id . '.pdf',
                        'submitted_at' => Carbon::now()->subDays(rand(1, 5)),
                        'score' => rand(75, 95),
                        'feedback' => 'Bagus sekali! Kerja yang baik.',
                        'graded_at' => Carbon::now()->subDays(rand(1, 3)),
                        'graded_by' => 2, // teacher
                        'is_late' => false
                    ]
                );
            }
        }

        // 9. Create Quizzes
        $quiz = Quiz::updateOrCreate(
            ['program_id' => $program->id, 'title' => 'Kuis Matematika Dasar'],
            [
                'description' => 'Uji pemahaman materi operasi bilangan',
                'instruction' => 'Jawab semua soal dengan benar.',
                'total_questions' => 10,
                'passing_score' => 70,
                'time_limit' => 30,
                'attempt_limit' => 3,
                'is_published' => true,
                'published_at' => Carbon::now()
            ]
        );

        // Create quiz questions
        $questions = [
            [
                'question_text' => 'Berapakah hasil dari 15 + 27?',
                'question_type' => 'multiple_choice',
                'points' => 10,
                'correct_answer' => '42',
                'options' => ['40', '42', '45', '38']
            ]
        ];

        foreach ($questions as $index => $questionData) {
            $question = QuizQuestion::updateOrCreate(
                ['quiz_id' => $quiz->id, 'question_text' => $questionData['question_text']],
                [
                    'question_type' => $questionData['question_type'],
                    'points' => $questionData['points'],
                    'correct_answer' => $questionData['correct_answer'],
                    'order' => $index + 1
                ]
            );

            // Create options
            foreach ($questionData['options'] as $optionIndex => $option) {
                QuizOption::create([
                    'quiz_question_id' => $question->id,
                    'option_text' => $option,
                    'is_correct' => $option === $questionData['correct_answer'],
                    'order' => $optionIndex + 1
                ]);
            }
        }

        // Create quiz attempts for students
        foreach ($createdStudents as $student) {
            $attempt = QuizAttempt::firstOrCreate([
                'quiz_id' => $quiz->id,
                'student_id' => $student->id,
                'attempt_number' => 1
            ], [
                'started_at' => Carbon::now()->subDays(3),
                'completed_at' => Carbon::now()->subDays(3)->addMinutes(25),
                'score' => rand(80, 95),
                'total_points' => 10,
                'percentage' => rand(80, 95),
                'passed' => true
            ]);

            // Create answers
            $quizQuestions = QuizQuestion::where('quiz_id', $quiz->id)->get();
            foreach ($quizQuestions as $question) {
                $correctOption = QuizOption::where('quiz_question_id', $question->id)->where('is_correct', true)->first();
                QuizAnswer::updateOrCreate([
                    'quiz_attempt_id' => $attempt->id,
                    'quiz_question_id' => $question->id
                ], [
                    'selected_option_id' => $correctOption->id,
                    'is_correct' => true,
                    'points_earned' => $question->points
                ]);
            }
        }

        // 10. Create Student Progress
        foreach ($createdStudents as $student) {
            StudentProgress::updateOrCreate(
                ['student_id' => $student->id, 'program_id' => $program->id],
                [
                    'registration_id' => Registration::where('student_id', $student->id)->first()->id ?? null,
                    'total_materials' => 10,
                    'completed_materials' => rand(6, 9),
                    'total_assignments' => 8,
                    'completed_assignments' => 8,
                    'average_assignment_score' => rand(75, 95),
                    'total_quizzes' => 5,
                    'completed_quizzes' => 5,
                    'average_quiz_score' => rand(80, 95),
                    'overall_progress_percentage' => rand(60, 85),
                    'status' => 'on_track',
                    'started_at' => Carbon::now()->subDays(30),
                    'completed_at' => null
                ]
            );
        }

        // 11. Create Achievements
        $achievements = [
            'Penghargaan Kehadiran Terbaik',
            'Juara Kuis Matematika'
        ];

        foreach ($createdStudents as $student) {
            foreach ($achievements as $achievement) {
                StudentAchievement::updateOrCreate(
                    ['student_id' => $student->id, 'title' => $achievement],
                    [
                        'description' => 'Pencapaian akademik yang membanggakan',
                        'earned_at' => Carbon::now()->subDays(rand(10, 30)),
                        'program_id' => $program->id
                    ]
                );
            }
        }

        // 12. Create Certificates
        foreach ($createdStudents as $student) {
            StudentCertificate::updateOrCreate(
                ['student_id' => $student->id, 'program_id' => $program->id],
                [
                    'certificate_number' => 'CERT-' . strtoupper(substr(md5($student->id . $program->id), 0, 8)),
                    'issue_date' => Carbon::now()->subDays(rand(5, 15)),
                    'expiry_date' => Carbon::now()->addYears(2),
                    'certificate_url' => 'certificates/cert_' . $student->id . '_' . $program->id . '.pdf',
                    'verification_code' => 'VC-' . strtoupper(substr(md5($student->id . $program->id . 'verify'), 0, 12)),
                    'is_verified' => true,
                    'verified_at' => Carbon::now()->subDays(rand(4, 14))
                ]
            );
        }

        // 13. Create Chat Messages (SITRA Communication)
        $teacher = User::where('email', 'ahmad.teacher@sintasv1.test')->first();

        foreach ($createdStudents as $student) {
            ChatMessage::updateOrCreate(
                [
                    'sender_id' => $teacher->id,
                    'receiver_id' => $guardian->id,
                    'message' => 'Halo ' . $student->name . ', bagaimana progress belajar matematika?'
                ],
                [
                    'sender_type' => 'admin',
                    'is_read' => false,
                    'created_at' => Carbon::now()->subDays(2)
                ]
            );

            ChatMessage::updateOrCreate(
                [
                    'sender_id' => $guardian->id,
                    'receiver_id' => $teacher->id,
                    'message' => 'Alhamdulillah baik Pak. Anak saya sudah mulai paham materi.'
                ],
                [
                    'sender_type' => 'user',
                    'is_read' => true,
                    'created_at' => Carbon::now()->subDays(2)->addHours(2)
                ]
            );
        }

        // 14. Create Class Announcements
        ClassAnnouncement::updateOrCreate(
            ['program_id' => $program->id, 'title' => 'Pengumuman Ujian Tengah Semester'],
            [
                'content' => 'Ujian tengah semester akan dilaksanakan pada tanggal 15 bulan depan. Silakan persiapkan diri dengan baik.',
                'type' => 'urgent',
                'teacher_id' => $teacher->id,
                'published_at' => Carbon::now()
            ]
        );

        // 15. Create Class Messages (SIMY Forum)
        foreach ($createdStudents as $student) {
            ClassMessage::updateOrCreate(
                [
                    'program_id' => $program->id,
                    'sender_id' => $student->id,
                    'message' => 'Halo teman-teman, ada yang bisa bantu jelaskan soal nomor 5?'
                ],
                [
                    'type' => 'question',
                    'is_pinned' => false,
                    'created_at' => Carbon::now()->subDays(1)
                ]
            );
        }

        $this->command->info('Comprehensive demo data seeded successfully!');
        $this->command->info('You can now test all features:');
        $this->command->info('- SITRA: Login as guardian@sintasv1.test to see parent dashboard');
        $this->command->info('- SIMY: Login as ahmad.student@sintasv1.test or siti.student@sintasv1.test');
        $this->command->info('- SINTAS: Login with various admin/staff accounts');
    }
}
