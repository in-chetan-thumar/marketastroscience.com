<?php

namespace App\Console\Commands;

use App\Services\WhatsAppService;
use Illuminate\Console\Command;

class TestWhatsAppIntegration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whatsapp:test 
                            {phone : The phone number to send test message to}
                            {--type=otp : Type of test (otp|status)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test WhatsApp MSG91 integration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $phone = $this->argument('phone');
        $type = $this->option('type');
        
        $whatsAppService = new WhatsAppService();
        
        // Validate phone number
        if (!preg_match('/^[6-9][0-9]{9}$/', $phone)) {
            $this->error('Invalid phone number. Please provide a 10-digit Indian mobile number starting with 6-9.');
            return 1;
        }
        
        $this->info("Testing WhatsApp integration...");
        $this->info("Phone: +91{$phone}");
        $this->info("Test type: {$type}");
        
        // Check configuration
        if (!$whatsAppService->isConfigured()) {
            $this->error('MSG91 API is not properly configured. Please check your .env file.');
            $this->info('Required environment variables:');
            $this->line('- MSG91_AUTH_KEY');
            $this->line('- MSG91_INTEGRATED_NUMBER');
            $this->line('- MSG91_NAMESPACE');
            return 1;
        }
        
        switch ($type) {
            case 'otp':
                $testOtp = '123456';
                $this->info("Sending test OTP: {$testOtp}");
                $result = $whatsAppService->sendOTP($phone, $testOtp);
                break;
                
            case 'status':
                $this->info('Checking API status...');
                $status = $whatsAppService->getApiStatus();
                $this->info('API Status: ' . json_encode($status, JSON_PRETTY_PRINT));
                return 0;
                
            default:
                $this->error('Invalid test type. Use: otp, status');
                return 1;
        }
        
        if ($result) {
            $this->success('✅ WhatsApp message sent successfully!');
            return 0;
        } else {
            $this->error('❌ Failed to send WhatsApp message. Check logs for details.');
            return 1;
        }
    }
}