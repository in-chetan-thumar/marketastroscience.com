<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EventRegistration;
use App\Services\WhatsAppService;

class SendFeedbackRequests extends Command
{
    protected $signature = 'event:send-feedback {--all : Send to all attendees who haven\'t submitted feedback}';
    protected $description = 'Send feedback requests to event attendees';

    private $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        parent::__construct();
        $this->whatsAppService = $whatsAppService;
    }

    public function handle()
    {
        $this->info('Starting feedback request process...');
        
        $query = EventRegistration::where('attended', true)
            ->where('feedback_submitted', false);
            
        if (!$this->option('all')) {
            // Only send to those who attended but haven't been asked for feedback yet
            $query->whereDoesntHave('feedbackRequests');
        }
        
        $registrations = $query->get();

        if ($registrations->isEmpty()) {
            $this->info('No registrations need feedback requests.');
            return;
        }

        $sent = 0;
        foreach ($registrations as $registration) {
            if ($this->whatsAppService->sendFeedbackRequest($registration->whatsapp_number, $registration)) {
                $sent++;
                $this->info("✓ Sent feedback request to {$registration->full_name}");
                
                // Mark that we've sent the feedback request
                // You might want to create a separate table to track this
                
            } else {
                $this->error("✗ Failed to send feedback request to {$registration->full_name}");
            }
            
            // Small delay between messages
            usleep(500000); // 500ms
        }
        
        $this->info("Sent {$sent} out of {$registrations->count()} feedback requests.");
    }
}