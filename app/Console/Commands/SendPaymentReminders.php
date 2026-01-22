<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\General\Registration;
use App\Models\User;
use App\Models\General\Notification;
use Carbon\Carbon;

class SendPaymentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitra:payment-reminders {--days=7 : Number of days until due date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send payment reminders to parents via SITRA';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $dueDate = Carbon::now()->addDays($days);

        $this->info("Sending payment reminders for registrations due in {$days} days");

        // Get registrations due soon
        $registrations = Registration::whereDate('payment_due_date', '=', $dueDate->format('Y-m-d'))
            ->where('status', 'active')
            ->get();

        $count = 0;
        foreach ($registrations as $registration) {
            // Send reminder notification
            $parent = User::find($registration->student->parent_id);
            
            if ($parent) {
                Notification::create([
                    'user_id' => $parent->id,
                    'type' => 'payment_reminder',
                    'data' => [
                        'registration_id' => $registration->id,
                        'program_name' => $registration->program->name,
                        'amount' => $registration->remaining_amount,
                    ]
                ]);

                $count++;
                $this->line("Reminder sent to: {$parent->name}");
            }
        }

        $this->info("Sent {$count} payment reminders successfully!");
        return 0;
    }
}
