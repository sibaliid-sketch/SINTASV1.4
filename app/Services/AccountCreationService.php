<?php

namespace App\Services;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountCreationService
{
    /**
     * Create accounts for a verified registration
     */
    public static function createAccountsForRegistration(Registration $registration)
    {
        $serviceType = $registration->program->service_type;

        if ($serviceType === 'SIMY') {
            return self::createSimyAccounts($registration);
        } elseif ($serviceType === 'SITRA') {
            return self::createSitraAccounts($registration);
        } elseif ($serviceType === 'SINTAS') {
            return self::createSintasAccount($registration);
        }

        return false;
    }

    /**
     * Create SIMY accounts (student + parent if applicable)
     */
    private static function createSimyAccounts(Registration $registration)
    {
        $accounts = [];

        // Create student account
        $studentAccount = self::createStudentAccount($registration, 'SIMY');
        if ($studentAccount) {
            $accounts[] = $studentAccount;
        }

        // Create parent account if parent registration
        if ($registration->is_parent_register) {
            $parentAccount = self::createParentAccount($registration, 'SIMY');
            if ($parentAccount) {
                $accounts[] = $parentAccount;
            }
        }

        return $accounts;
    }

    /**
     * Create SITRA accounts (student + parent if applicable)
     */
    private static function createSitraAccounts(Registration $registration)
    {
        $accounts = [];

        // Create student account
        $studentAccount = self::createStudentAccount($registration, 'SITRA');
        if ($studentAccount) {
            $accounts[] = $studentAccount;
        }

        // Create parent account if parent registration
        if ($registration->is_parent_register) {
            $parentAccount = self::createParentAccount($registration, 'SITRA');
            if ($parentAccount) {
                $accounts[] = $parentAccount;
            }
        }

        return $accounts;
    }

    /**
     * Create SINTAS account (single account for adult)
     */
    private static function createSintasAccount(Registration $registration)
    {
        $accounts = [];

        // For SINTAS, create single account for the registrant
        $account = self::createAdultAccount($registration);
        if ($account) {
            $accounts[] = $account;
        }

        return $accounts;
    }

    /**
     * Create student account
     */
    private static function createStudentAccount(Registration $registration, string $portal)
    {
        $username = self::generateUsername($registration->student_name, 'student');
        $password = self::generatePassword();

        $user = User::create([
            'name' => $registration->student_name,
            'email' => self::generateStudentEmail($registration),
            'password' => Hash::make($password),
            'role' => 'student',
            'department' => strtolower($portal),
            'position' => 'student',
            'level' => 'user',
        ]);

        // Store generated credentials for email sending
        $user->generated_password = $password;
        $user->portal = $portal;

        return $user;
    }

    /**
     * Create parent account
     */
    private static function createParentAccount(Registration $registration, string $portal)
    {
        $username = self::generateUsername($registration->parent_name ?? $registration->student_name . '_parent', 'parent');
        $password = self::generatePassword();

        $user = User::create([
            'name' => $registration->parent_name ?? 'Parent of ' . $registration->student_name,
            'email' => self::generateParentEmail($registration),
            'password' => Hash::make($password),
            'role' => 'parent',
            'department' => strtolower($portal),
            'position' => 'parent',
            'level' => 'user',
        ]);

        // Store generated credentials for email sending
        $user->generated_password = $password;
        $user->portal = $portal;

        return $user;
    }

    /**
     * Create adult account for SINTAS
     */
    private static function createAdultAccount(Registration $registration)
    {
        $username = self::generateUsername($registration->student_name, 'adult');
        $password = self::generatePassword();

        $user = User::create([
            'name' => $registration->student_name,
            'email' => $registration->student_email ?? self::generateStudentEmail($registration),
            'password' => Hash::make($password),
            'role' => 'student',
            'department' => 'sintas',
            'position' => 'student',
            'level' => 'user',
        ]);

        // Store generated credentials for email sending
        $user->generated_password = $password;
        $user->portal = 'SINTAS';

        return $user;
    }

    /**
     * Generate unique username
     */
    private static function generateUsername(string $name, string $type): string
    {
        $base = Str::slug($name);
        $username = $base . '_' . $type;
        $counter = 1;

        while (User::where('name', $username)->exists()) {
            $username = $base . '_' . $type . '_' . $counter;
            $counter++;
        }

        return $username;
    }

    /**
     * Generate random password
     */
    private static function generatePassword(): string
    {
        return Str::random(8);
    }

    /**
     * Generate student email
     */
    private static function generateStudentEmail(Registration $registration): string
    {
        $base = Str::slug($registration->student_name);
        $email = $base . '@simy.local'; // Temporary email, should be replaced with actual domain
        $counter = 1;

        while (User::where('email', $email)->exists()) {
            $email = $base . $counter . '@simy.local';
            $counter++;
        }

        return $email;
    }

    /**
     * Generate parent email
     */
    private static function generateParentEmail(Registration $registration): string
    {
        $base = Str::slug($registration->parent_name ?? $registration->student_name . '_parent');
        $email = $base . '@sitra.local'; // Temporary email, should be replaced with actual domain
        $counter = 1;

        while (User::where('email', $email)->exists()) {
            $email = $base . $counter . '@sitra.local';
            $counter++;
        }

        return $email;
    }
}
