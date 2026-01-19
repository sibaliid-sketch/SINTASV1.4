<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique(); // ORD1029384756
            $table->string('student_id')->nullable()->unique(); // ST4821
            $table->foreignId('program_id')->constrained('programs');
            $table->foreignId('schedule_id')->constrained('schedules');
            $table->foreignId('promo_id')->nullable()->constrained('promos');
            
            // Data Siswa
            $table->string('student_name');
            $table->date('student_dob');
            $table->string('student_phone');
            $table->string('student_email');
            $table->string('student_gender')->nullable();
            $table->string('student_address')->nullable();
            $table->string('education_level'); // TK, SD, SMP, SMA, Mahasiswa, Umum
            $table->string('class_level')->nullable(); // Kelas/Semester
            
            // Data Pendaftar (yang mendaftar)
            $table->boolean('is_self_register'); // true = siswa daftar sendiri, false = orang tua daftar
            
            // Data Orang Tua (jika diperlukan)
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('parent_email')->nullable();
            $table->string('parent_relationship')->nullable(); // Ayah, Ibu, Wali
            $table->string('parent_address')->nullable();
            
            // Status Registrasi
            $table->enum('status', [
                'draft',
                'pending_payment',
                'awaiting_verification',
                'active',
                'onboarding_complete',
                'cancelled',
                'refund_processed'
            ])->default('draft');
            
            // Info Biaya
            $table->decimal('base_price', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total_price', 12, 2);
            
            // Info Pembayaran
            $table->string('payment_method')->nullable(); // bank_transfer, etc.
            $table->enum('payment_status', ['unpaid', 'paid', 'pending', 'rejected'])->default('unpaid');
            $table->date('payment_deadline')->nullable();
            $table->timestamp('payment_verified_at')->nullable();
            
            // Invoice & Kuitansi
            $table->string('invoice_id')->nullable()->unique(); // INV/01/26/4821
            $table->string('receipt_id')->nullable()->unique(); // KUI/01/26/2309
            $table->string('onboarding_id')->nullable()->unique(); // ONBRD54321
            $table->string('contract_id')->nullable()->unique(); // KTR/STU/26.01/ST4821
            
            // Pembatalan
            $table->string('cancellation_id')->nullable()->unique(); // CNCL54321
            $table->string('refund_id')->nullable()->unique(); // RFND54321
            $table->enum('cancellation_type', ['before_start', 'during_class', 'after_class'])->nullable();
            $table->decimal('refund_percentage', 5, 2)->nullable();
            $table->decimal('refund_amount', 12, 2)->nullable();
            $table->text('cancellation_reason')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('student_id');
            $table->index('status');
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
