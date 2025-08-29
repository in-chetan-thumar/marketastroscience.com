<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EventRegistration;
use App\Services\WhatsAppService;
use Carbon\Carbon;

class SendEventReminders extends Command
{
    protected $signature = 'event:send-reminders {type=all : Type of reminder (7day, 2day, 1day, today, all)}';
    protected $description = 'Send WhatsApp reminders to event registrants';

    private $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        parent::__construct();
        $this->whatsAppService = $whatsAppService;
    }

    public function handle()
    {
        $type = $this->argument('type');
        
        $this->info('Starting event reminder process...');
        
        switch ($type) {
            case '7day':
                $this->send7DayReminders();
                break;
            case '2day':
                $this->send2DayReminders();
                break;
            case '1day':
                $this->send1DayReminders();
                break;
            case 'today':
                $this->sendTodayReminders();
                break;
            case 'all':
                $this->sendAllReminders();
                break;
            default:
                $this->error('Invalid reminder type. Use: 7day, 2day, 1day, today, or all');
                return;
        }
        
        $this->info('Event reminder process completed.');
    }

    private function send7DayReminders()
    {
        $this->info('Sending 7-day reminders...');
        
        $registrations = EventRegistration::verified()
            ->where('reminder_sent_7_days', false)
            ->get();

        if ($registrations->isEmpty()) {
            $this->info('No registrations need 7-day reminders.');
            return;
        }

        $sent = 0;
        foreach ($registrations as $registration) {
            if ($this->whatsAppService->sendReminder($registration->whatsapp_number, $registration, 7)) {
                $registration->update(['reminder_sent_7_days' => true]);
                $sent++;
                $this->info("✓ Sent 7-day reminder to {$registration->full_name}");
            } else {
                $this->error("✗ Failed to send 7-day reminder to {$registration->full_name}");
            }
            
            // Small delay between messages
            usleep(500000); // 500ms
        }
        
        $this->info("Sent {$sent} out of {$registrations->count()} 7-day reminders.");
    }

    private function send2DayReminders()
    {
        $this->info('Sending 2-day reminders...');
        
        $registrations = EventRegistration::verified()
            ->where('reminder_sent_2_days', false)
            ->get();

        if ($registrations->isEmpty()) {
            $this->info('No registrations need 2-day reminders.');
            return;
        }

        $sent = 0;
        foreach ($registrations as $registration) {
            if ($this->whatsAppService->sendReminder($registration->whatsapp_number, $registration, 2)) {
                $registration->update(['reminder_sent_2_days' => true]);
                $sent++;
                $this->info("✓ Sent 2-day reminder to {$registration->full_name}");
            } else {
                $this->error("✗ Failed to send 2-day reminder to {$registration->full_name}");
            }
            
            usleep(500000); // 500ms
        }
        
        $this->info("Sent {$sent} out of {$registrations->count()} 2-day reminders.");
    }

    private function send1DayReminders()
    {
        $this->info('Sending 1-day reminders...');
        
        $registrations = EventRegistration::verified()
            ->where('reminder_sent_1_day', false)
            ->get();

        if ($registrations->isEmpty()) {
            $this->info('No registrations need 1-day reminders.');
            return;
        }

        $sent = 0;
        foreach ($registrations as $registration) {
            if ($this->whatsAppService->sendReminder($registration->whatsapp_number, $registration, 1)) {
                $registration->update(['reminder_sent_1_day' => true]);
                $sent++;
                $this->info("✓ Sent 1-day reminder to {$registration->full_name}");
            } else {
                $this->error("✗ Failed to send 1-day reminder to {$registration->full_name}");
            }
            
            usleep(500000); // 500ms
        }
        
        $this->info("Sent {$sent} out of {$registrations->count()} 1-day reminders.");
    }

    private function sendTodayReminders()
    {
        $this->info('Sending day-of-event reminders...');
        
        $registrations = EventRegistration::verified()
            ->where('day_of_reminder_sent', false)
            ->get();

        if ($registrations->isEmpty()) {
            $this->info('No registrations need day-of reminders.');
            return;
        }

        $sent = 0;
        foreach ($registrations as $registration) {
            if ($this->whatsAppService->sendReminder($registration->whatsapp_number, $registration, 0)) {
                $registration->update(['day_of_reminder_sent' => true]);
                $sent++;
                $this->info("✓ Sent day-of reminder to {$registration->full_name}");
            } else {
                $this->error("✗ Failed to send day-of reminder to {$registration->full_name}");
            }
            
            usleep(500000); // 500ms
        }
        
        $this->info("Sent {$sent} out of {$registrations->count()} day-of reminders.");
    }

    private function sendAllReminders()
    {
        // This would typically be scheduled based on event date
        // For demo purposes, we'll send appropriate reminders based on current date
        
        $eventDate = Carbon::parse('2025-09-15');
        $today = Carbon::today();
        $daysUntilEvent = $today->diffInDays($eventDate, false);

        $this->info("Days until event: {$daysUntilEvent}");

        if ($daysUntilEvent == 7) {
            $this->send7DayReminders();
        } elseif ($daysUntilEvent == 2) {
            $this->send2DayReminders();
        } elseif ($daysUntilEvent == 1) {
            $this->send1DayReminders();
        } elseif ($daysUntilEvent == 0) {
            $this->sendTodayReminders();
        } else {
            $this->info('No reminders scheduled for today based on event date.');
        }
    }
}