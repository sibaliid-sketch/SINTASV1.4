<?php

namespace App\Services;

use App\Models\General\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountCreationService
{
    /**
     * Create accounts for a verified registration
     * 
     * Logic:
     * 1. Parent registers child -> Create SIMY (student) + SITRA (parent)
     * 2. Student registers self (18+) -> Create SIMY (student) with payment features
     * 3. Student registers self (<18) -> Create SIMY (student) + SITRA (parent)
     */
    public static function createAccountsForRegistration(Registration $registration): array
    {
        $accounts = [];

        if (!$registration->is_self_register) {
            // Parent is registering child
            $accounts = self::createParentChildAccounts($registration);
        } else {
            // Student is registering self
            if ($registration->student_age >= 18) {
                // Adult student - create SIMY with payment features
                $accounts = self::createAdultStudentAccount($registration);
            } else {
                // Underage student - create SIMY + SITRA for parent
                $accounts = self::createUnderageStudentAccounts($registration);
            }
        }

        // Send credentials via email
        foreach ($accounts as $account) {
            self::sendAccountCredentials($account);
        }

        return $accounts;
    }

    /**
     * Create accounts when parent registers child
     * SIMY for student + SITRA for parent
     */
    private static function createParentChildAccounts(Registration $registration): array
    {
        $accounts = [];

        // Create SITRA account for parent first (to get parent ID)
        $parentAccount = self::createParentSitraAccount($registration);
        if ($parentAccount) {
            $accounts['parent'] = $parentAccount;
        }

        // Create SIMY account for student (LMS access) and link to parent
        $studentAccount = self::createStudentSimyAccount($registration, $parentAccount->id ?? null);
        if ($studentAccount) {
            $accounts['student'] = $studentAccount;
        }

        return $accounts;
    }

    /**
     * Create account for adult student (18+)
     * SIMY with payment management features
     */
    private static function createAdultStudentAccount(Registration $registration): array
    {
        $accounts = [];

        $password = self::generatePassword();
        $email = $registration->student_email ?? self::generateStudentEmail($registration);

        $user = User::create([
            'name' => $registration->student_name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'student',
            'department' => 'simy',
            'position' => 'student',
            'level' => 'user',
        ]);

        $user->generated_password = $password;
        $user->portal = 'SIMY';
        $user->has_payment_features = true; // Flag for payment features

        $accounts['student'] = $user;

        return $accounts;
    }

    /**
     * Create accounts for underage student (<18)
     * SIMY for student + SITRA for parent
     */
    private static function createUnderageStudentAccounts(Registration $registration): array
    {
        $accounts = [];

        // Create SITRA account for parent first (to get parent ID)
        $parentAccount = self::createParentSitraAccount($registration);
        if ($parentAccount) {
            $accounts['parent'] = $parentAccount;
        }

        // Create SIMY account for student and link to parent
        $studentAccount = self::createStudentSimyAccount($registration, $parentAccount->id ?? null);
        if ($studentAccount) {
            $accounts['student'] = $studentAccount;
        }

        return $accounts;
    }

    /**
     * Create SIMY account for student (LMS access)
     */
    private static function createStudentSimyAccount(Registration $registration, ?int $parentId = null): User
    {
        $password = self::generatePassword();
        $email = $registration->student_email ?? self::generateStudentEmail($registration);

        $user = User::create([
            'name' => $registration->student_name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'siswa',
            'department' => 'simy',
            'position' => 'student',
            'level' => 'user',
            'parent_id' => $parentId,
        ]);

        $user->generated_password = $password;
        $user->portal = 'SIMY';

        return $user;
    }

    /**
     * Create SITRA account for parent (payment & monitoring)
     */
    private static function createParentSitraAccount(Registration $registration): User
    {
        $password = self::generatePassword();
        $email = $registration->parent_email ?? self::generateParentEmail($registration);

        $user = User::create([
            'name' => $registration->parent_name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'parent',
            'department' => 'sitra',
            'position' => 'parent',
            'level' => 'user',
        ]);

        $user->generated_password = $password;
        $user->portal = 'SITRA';

        return $user;
    }

    /**
     * Send account credentials via email
     */
    private static function sendAccountCredentials(User $user): void
    {
        RegistrationEmailService::sendAccountCredentials(
            $user->email,
            $user->name,
            $user->email, // Using email as username
            $user->generated_password,
            $user->portal
        );
    }

    /**
     * Generate random password
     */
    private static function generatePassword(): string
    {
        return Str::random(10) . rand(10, 99);
    }

    /**
     * Generate student email
     */
    private static function generateStudentEmail(Registration $registration): string
    {
        $base = Str::slug($registration->student_name);
        $email = $base . '@student.sibali.id';
        $counter = 1;

        while (User::where('email', $email)->exists()) {
            $email = $base . $counter . '@student.sibali.id';
            $counter++;
        }

        return $email;
    }

    /**
     * Generate parent email
     */
    private static function generateParentEmail(Registration $registration): string
    {
        $base = Str::slug($registration->parent_name ?? $registration->student_name . '-parent');
        $email = $base . '@parent.sibali.id';
        $counter = 1;

        while (User::where('email', $email)->exists()) {
            $email = $base . $counter . '@parent.sibali.id';
            $counter++;
        }

        return $email;
    }
}
