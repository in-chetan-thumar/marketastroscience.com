<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRegistrationRequest;
use App\Http\Requests\EventOtpVerifyRequest;
use App\Http\Requests\EventResendOtpRequest;
use App\Models\EventRegistration;
use App\Services\WhatsAppService;
use App\Services\QRCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        return view('frontend.event-landing');
    }

    public function register(EventRegistrationRequest $request)
    {

        try {
            DB::beginTransaction();

            // Generate OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $otpExpiry = now()->addMinutes(5);

            // Create registration record with validated data
            $validated = $request->validated();
            $registration = EventRegistration::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'mobile_number' => $validated['mobile_number'],
                'whatsapp_number' => $validated['whatsapp_number'],
                'trading_experience' => $validated['trading_experience'] ?? null,
                'birth_date' => $validated['birth_date'] ?? null,
                'otp' => $otp,
                'otp_expiry' => $otpExpiry,
                'registration_id' => 'MAS' . strtoupper(Str::random(8)),
                'status' => 'pending_verification'
            ]);

            // Send OTP via WhatsApp
            $otpSent = $this->sendWhatsAppOTP($validated['whatsapp_number'], $otp);
            
            if (!$otpSent) {
                \Log::warning('OTP WhatsApp message failed to send', [
                    'registration_id' => $registration->registration_id,
                    'whatsapp_number' => $validated['whatsapp_number']
                ]);
                // Continue anyway - user might still receive it
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registration initiated. Please check your WhatsApp for OTP.',
                'registration_id' => $registration->registration_id
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            \Log::error('Event registration failed', [
                'error' => $e->getMessage(),
                'email' => $request->validated()['email'] ?? 'unknown',
                'mobile' => $request->validated()['mobile_number'] ?? 'unknown'
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Registration failed due to a server error. Please try again later.'
            ], 500);
        }
    }

    public function verifyOtp(EventOtpVerifyRequest $request)
    {

        $validated = $request->validated();
        
        $registration = EventRegistration::where('registration_id', $validated['registration_id'])
            ->where('status', 'pending_verification')
            ->first();
            
        // Check if registration exists and OTP matches
        if (!$registration || $registration->otp !== $validated['otp']) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP. Please check and try again.'
            ], 400);
        }
        
        // Check if OTP has expired
        if ($registration->otp_expiry < now()) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please request a new one.'
            ], 400);
        }


        try {
            DB::beginTransaction();

            // Update registration status
            $registration->update([
                'status' => 'verified',
                'verified_at' => now(),
                'otp' => null,
                'otp_expiry' => null
            ]);

            // Generate QR code and send via WhatsApp
            $qrCode = $this->generateQRCode($registration);
            $qrSent = $this->sendWhatsAppQR($registration->whatsapp_number, $qrCode, $registration);
            
            if (!$qrSent) {
                \Log::warning('Registration confirmation WhatsApp message failed to send', [
                    'registration_id' => $registration->registration_id,
                    'whatsapp_number' => $registration->whatsapp_number
                ]);
                // Continue anyway - registration is still valid
            }

            // Send confirmation email
            $this->sendConfirmationEmail($registration);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registration verified successfully! Check your WhatsApp for QR code.',
                'redirect_url' => route('event.success', $registration->registration_id)
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Verification failed. Please try again.'
            ], 500);
        }
    }

    public function resendOtp(EventResendOtpRequest $request)
    {
        $validated = $request->validated();
        
        $registration = EventRegistration::where('registration_id', $validated['registration_id'])
            ->where('status', 'pending_verification')
            ->first();

        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'Registration not found or already verified.'
            ], 400);
        }

        try {
            // Generate new OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $otpExpiry = now()->addMinutes(5);

            $registration->update([
                'otp' => $otp,
                'otp_expiry' => $otpExpiry
            ]);

            // Send new OTP via WhatsApp
            $otpSent = $this->sendWhatsAppOTP($registration->whatsapp_number, $otp);
            
            if (!$otpSent) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send OTP to your WhatsApp. Please try again.'
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'New OTP sent to your WhatsApp.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to resend OTP', [
                'error' => $e->getMessage(),
                'registration_id' => $validated['registration_id']
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend OTP due to server error. Please try again.'
            ], 500);
        }
    }

    public function success($registrationId)
    {
        $registration = EventRegistration::where('registration_id', $registrationId)
            ->where('status', 'verified')
            ->first();

        if (!$registration) {
            abort(404, 'Registration not found');
        }

        return view('frontend.event-success', compact('registration'));
    }

    public function generateReferral(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'registration_id' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $registration = EventRegistration::where('registration_id', $request->registration_id)->first();

        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'Registration not found.'
            ], 404);
        }

        if (!$registration->referral_code) {
            $registration->generateReferralCode();
        }

        return response()->json([
            'success' => true,
            'referral_code' => $registration->referral_code
        ]);
    }

    public function invitePage(Request $request)
    {
        $referralCode = $request->query('ref');
        $referrer = null;
        
        if ($referralCode) {
            $referrer = EventRegistration::where('referral_code', $referralCode)->first();
        }
        
        return view('frontend.event-invite', compact('referralCode', 'referrer'));
    }

    public function feedbackPage(Request $request)
    {
        $registrationId = $request->query('reg');
        $registration = null;
        
        if ($registrationId) {
            $registration = EventRegistration::where('registration_id', $registrationId)
                ->where('attended', true)
                ->first();
        }
        
        return view('frontend.event-feedback', compact('registration'));
    }

    public function submitFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'registration_id' => 'required|string',
            'overall_rating' => 'required|integer|min:1|max:5',
            'liked_aspects' => 'array',
            'what_learned' => 'nullable|string|max:1000',
            'improvements' => 'nullable|string|max:1000',
            'would_recommend' => 'required|string',
            'future_interests' => 'array',
            'additional_comments' => 'nullable|string|max:1000',
            'subscribe_newsletter' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $registration = EventRegistration::where('registration_id', $request->registration_id)
            ->where('attended', true)
            ->first();

        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'Registration not found or not marked as attended.'
            ], 400);
        }

        if ($registration->feedback_submitted) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback already submitted for this registration.'
            ], 400);
        }

        try {
            $feedbackData = [
                'overall_rating' => $request->overall_rating,
                'liked_aspects' => json_encode($request->liked_aspects ?? []),
                'what_learned' => $request->what_learned,
                'improvements' => $request->improvements,
                'would_recommend' => $request->would_recommend,
                'future_interests' => json_encode($request->future_interests ?? []),
                'additional_comments' => $request->additional_comments,
                'subscribe_newsletter' => $request->boolean('subscribe_newsletter')
            ];

            $registration->update([
                'feedback' => json_encode($feedbackData),
                'feedback_rating' => $request->overall_rating,
                'feedback_submitted' => true,
                'feedback_submitted_at' => now()
            ]);

            // Send bonus materials email
            $this->sendBonusMaterials($registration);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your feedback! Check your email for bonus materials.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit feedback. Please try again.'
            ], 500);
        }
    }

    private function sendBonusMaterials($registration)
    {
        // TODO: Send email with bonus materials
        \Log::info("Bonus materials sent to {$registration->email}");
        return true;
    }

    private function sendWhatsAppOTP($whatsappNumber, $otp)
    {
        try {
            $whatsAppService = new WhatsAppService();
            return $whatsAppService->sendOTP($whatsappNumber, $otp);
        } catch (\Exception $e) {
            \Log::error('Failed to send WhatsApp OTP', [
                'whatsapp_number' => $whatsappNumber,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    private function sendWhatsAppQR($whatsappNumber, $qrCodePath, $registration)
    {
        try {
            $whatsAppService = new WhatsAppService();
            return $whatsAppService->sendRegistrationConfirmation($whatsappNumber, $registration, $qrCodePath);
        } catch (\Exception $e) {
            \Log::error('Failed to send WhatsApp QR confirmation', [
                'whatsapp_number' => $whatsappNumber,
                'registration_id' => $registration->registration_id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    private function generateQRCode($registration)
    {
        try {
            $qrService = new QRCodeService();
            return $qrService->generateRegistrationQR($registration);
        } catch (\Exception $e) {
            \Log::error('Failed to generate QR code', [
                'registration_id' => $registration->registration_id,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    private function sendConfirmationEmail($registration)
    {
        // TODO: Implement email confirmation using Laravel's mail system
        \Log::info("Confirmation email sent to {$registration->email}");
        
        return true;
    }
}