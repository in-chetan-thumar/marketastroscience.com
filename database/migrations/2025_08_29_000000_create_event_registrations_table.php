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
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('mobile_number');
            $table->string('whatsapp_number');
            $table->string('trading_experience')->nullable();
            $table->date('birth_date')->nullable();
            
            // OTP verification
            $table->string('otp', 6)->nullable();
            $table->timestamp('otp_expiry')->nullable();
            
            // Registration status
            $table->enum('status', ['pending_verification', 'verified', 'confirmed', 'cancelled', 'attended'])
                  ->default('pending_verification');
            $table->timestamp('verified_at')->nullable();
            
            
            // Event attendance
            $table->boolean('attended')->default(false);
            $table->timestamp('checked_in_at')->nullable();
            
            // QR code and communication
            $table->string('qr_code_path')->nullable();
            $table->boolean('reminder_sent_7_days')->default(false);
            $table->boolean('reminder_sent_2_days')->default(false);
            $table->boolean('reminder_sent_1_day')->default(false);
            $table->boolean('day_of_reminder_sent')->default(false);
            
            // Feedback
            $table->boolean('feedback_submitted')->default(false);
            $table->text('feedback')->nullable();
            $table->integer('feedback_rating')->nullable();
            $table->timestamp('feedback_submitted_at')->nullable();
            
            // Referral system
            $table->string('referral_code')->nullable()->unique();
            $table->string('referred_by')->nullable();
            
            // Additional tracking
            $table->string('source')->nullable(); // How they found the event
            $table->json('utm_parameters')->nullable(); // Marketing tracking
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['status', 'created_at']);
            $table->index(['email', 'status']);
            $table->index(['mobile_number', 'status']);
            $table->index(['whatsapp_number', 'status']);
            $table->index('referral_code');
            $table->index('referred_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};