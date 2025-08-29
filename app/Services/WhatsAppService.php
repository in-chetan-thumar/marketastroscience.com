<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private $apiUrl;
    private $authKey;
    private $integratedNumber;
    private $namespace;
    private $templates;

    public function __construct()
    {
        $config = config('services.msg91');
        $this->apiUrl = $config['api_url'];
        $this->authKey = $config['auth_key'];
        $this->integratedNumber = $config['integrated_number'];
        $this->namespace = $config['namespace'];
        $this->templates = $config['templates'];
    }

    /**
     * Send OTP via WhatsApp using MSG91 template
     */
    public function sendOTP($toNumber, $otp)
    {
        if (!$this->isConfigured()) {
            Log::warning('MSG91 API not configured. OTP not sent.', [
                'to' => $toNumber,
                'otp' => '***'
            ]);
            return false;
        }

        $payload = [
            'integrated_number' => $this->integratedNumber,
            'content_type' => 'template',
            'payload' => [
                'messaging_product' => 'whatsapp',
                'type' => 'template',
                'template' => [
                    'name' => $this->templates['otp'],
                    'language' => [
                        'code' => 'en',
                        'policy' => 'deterministic'
                    ],
                    'namespace' => $this->namespace,
                    'to_and_components' => [
                        [
                            'to' => ['91' . $toNumber],
                            'components' => [
                                'body_1' => [
                                    'type' => 'text',
                                    'value' => $otp
                                ],
                                'button_1' => [
                                    'subtype' => 'url',
                                    'type' => 'text',
                                    'value' => route('event.landing')
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $this->sendMsg91Request($payload, 'OTP');
    }

    /**
     * Send QR code and registration confirmation using MSG91 template
     */
    public function sendRegistrationConfirmation($toNumber, $registration, $qrCodePath = null)
    {
        if (!$this->isConfigured()) {
            Log::warning('MSG91 API not configured. Registration confirmation not sent.', [
                'to' => $toNumber,
                'registration_id' => $registration->registration_id
            ]);
            return false;
        }

        $fullName = $registration->first_name . ' ' . $registration->last_name;
        
        $payload = [
            'integrated_number' => $this->integratedNumber,
            'content_type' => 'template',
            'payload' => [
                'messaging_product' => 'whatsapp',
                'type' => 'template',
                'template' => [
                    'name' => $this->templates['registration_success'],
                    'language' => [
                        'code' => 'en',
                        'policy' => 'deterministic'
                    ],
                    'namespace' => $this->namespace,
                    'to_and_components' => [
                        [
                            'to' => ['91' . $toNumber],
                            'components' => [
                                'body_1' => [
                                    'type' => 'text',
                                    'value' => $fullName
                                ],
                                'body_2' => [
                                    'type' => 'text',
                                    'value' => $registration->registration_id
                                ],
                                'body_3' => [
                                    'type' => 'text',
                                    'value' => 'January 15, 2025'
                                ],
                                'body_4' => [
                                    'type' => 'text',
                                    'value' => '7:00 PM IST'
                                ],
                                'button_2' => [
                                    'subtype' => 'url',
                                    'type' => 'text',
                                    'value' => route('event.success', $registration->registration_id)
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $result = $this->sendMsg91Request($payload, 'Registration Confirmation');
        
        // If QR code exists, send it as a follow-up message
        if ($qrCodePath && $result) {
            // Small delay before sending QR code
            sleep(2);
            return $this->sendQRCode($toNumber, $qrCodePath, $registration);
        }

        return $result;
    }

    /**
     * Send reminder messages
     */
    public function sendReminder($toNumber, $registration, $daysBefore)
    {
        switch ($daysBefore) {
            case 7:
                $message = "📅 *Reminder: 7 Days to Astro Trading Masterclass!*\n\n";
                $message .= "Hi {$registration->first_name}! Your amazing journey starts in just 7 days.\n\n";
                $message .= "📚 *Prepare for Success:*\n";
                $message .= "• Review your birth chart details\n";
                $message .= "• Install trading apps on your phone\n";
                $message .= "• Join our preparation group: [link]\n\n";
                $message .= "🎯 Registration ID: {$registration->registration_id}\n";
                $message .= "📅 Sep 15, 2025 | 2:00 PM IST";
                break;

            case 2:
                $message = "⚡ *2 Days to Go!* Get Ready for Astro Trading Masterclass\n\n";
                $message .= "Hi {$registration->first_name}! The big day is almost here.\n\n";
                $message .= "📋 *Final Checklist:*\n";
                $message .= "✅ Have your birth details ready\n";
                $message .= "✅ Ensure stable internet connection\n";
                $message .= "✅ Download Zoom app (virtual attendees)\n";
                $message .= "✅ Prepare questions for Q&A session\n\n";
                $message .= "📍 Venue details will be shared tomorrow.\n";
                $message .= "🎫 Your QR code will be shared 24 hours before.";
                break;

            case 1:
                $message = "🚀 *Tomorrow is the BIG DAY!*\n\n";
                $message .= "Hi {$registration->first_name}! Are you excited? We are! 🌟\n\n";
                $message .= "📍 *Event Venue:*\n";
                $message .= "Hotel Radisson Blue, Conference Hall\n";
                $message .= "MG Road, Bangalore - 560001\n";
                $message .= "🕐 Reporting Time: 1:30 PM\n\n";
                $message .= "🎫 *Your Entry QR Code:* [QR code will be sent in next message]\n\n";
                $message .= "📱 *Virtual Link:* zoom.us/j/astrotrading2025\n";
                $message .= "🔑 Meeting ID: 123-456-789\n\n";
                $message .= "💼 *What to Bring:*\n";
                $message .= "• Government ID for verification\n";
                $message .= "• Notebook and pen\n";
                $message .= "• Birth chart details\n";
                $message .= "• Positive energy! ✨";
                break;

            case 0:
                $message = "🎯 *TODAY IS THE DAY!*\n\n";
                $message .= "Good morning {$registration->first_name}! 🌅\n\n";
                $message .= "Your Astro Trading Masterclass begins in a few hours!\n\n";
                $message .= "⏰ *Quick Reminders:*\n";
                $message .= "• Event starts at 2:00 PM IST\n";
                $message .= "• Arrive by 1:30 PM for registration\n";
                $message .= "• Have your QR code ready\n";
                $message .= "• Bring government ID\n\n";
                $message .= "🎁 *Special Surprise:* First 20 attendees get exclusive bonus materials!\n\n";
                $message .= "See you there! 🚀";
                break;
        }

        return $this->sendMessage($toNumber, $message);
    }

    /**
     * Send feedback request
     */
    public function sendFeedbackRequest($toNumber, $registration)
    {
        $message = "🙏 *Thank You for Attending Astro Trading Masterclass!*\n\n";
        $message .= "Hi {$registration->first_name}!\n\n";
        $message .= "We hope you enjoyed the masterclass and gained valuable insights! 🌟\n\n";
        $message .= "📝 *Please share your feedback:*\n";
        $message .= "Your experience helps us improve and serve you better.\n\n";
        $message .= "👉 Feedback Link: [link will be provided]\n\n";
        $message .= "🎁 *Post-Event Support:*\n";
        $message .= "• Access to recorded session\n";
        $message .= "• 3-month community membership\n";
        $message .= "• Monthly follow-up sessions\n\n";
        $message .= "Next event announcements coming soon!\n\n";
        $message .= "Thank you,\nMarket Astro Science Team";

        return $this->sendMessage($toNumber, $message);
    }

    /**
     * Send referral invitation
     */
    public function sendReferralInvitation($toNumber, $referrerName, $referralCode)
    {
        $message = "🎯 *Exclusive Invitation to Astro Trading Masterclass!*\n\n";
        $message .= "Hi! Your friend *{$referrerName}* has invited you to join an amazing event.\n\n";
        $message .= "✨ *What's Special:*\n";
        $message .= "• Learn cosmic trading secrets\n";
        $message .= "• Get ₹500 off with referral code\n";
        $message .= "• Join 15,000+ successful traders\n\n";
        $message .= "🎫 *Event:* Astro Trading Masterclass 2025\n";
        $message .= "📅 Sep 15, 2025 | 2:00 PM IST\n";
        $message .= "💰 Price: ₹999 (₹500 off!)\n\n";
        $message .= "🔥 *Your Referral Code:* *{$referralCode}*\n\n";
        $message .= "👉 Register now: [registration link]\n\n";
        $message .= "Limited seats available!";

        return $this->sendMessage($toNumber, $message);
    }

    /**
     * Send MSG91 API request
     */
    private function sendMsg91Request($payload, $messageType = 'Message')
    {
        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'authkey' => $this->authKey
                ])
                ->post($this->apiUrl, $payload);

            $responseData = $response->json();

            if ($response->successful() && isset($responseData['type']) && $responseData['type'] === 'success') {
                Log::info($messageType . ' sent successfully via MSG91', [
                    'to' => $payload['payload']['template']['to_and_components'][0]['to'] ?? 'unknown',
                    'template' => $payload['payload']['template']['name'] ?? 'unknown',
                    'response' => $responseData
                ]);
                return true;
            } else {
                Log::error('Failed to send ' . $messageType . ' via MSG91', [
                    'status' => $response->status(),
                    'response' => $responseData
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('MSG91 API exception for ' . $messageType, [
                'error' => $e->getMessage(),
                'payload' => $payload
            ]);
            return false;
        }
    }
    
    /**
     * Send QR code as image via WhatsApp
     */
    private function sendQRCode($toNumber, $qrCodePath, $registration)
    {
        // For now, we'll use a simple text message with QR info
        // In production, you might want to upload the QR code to a CDN and send the URL
        $message = "🎫 *Your Event QR Code*\n\n";
        $message .= "Registration ID: {$registration->registration_id}\n";
        $message .= "Please save this for event entry.\n\n";
        $message .= "See you at the masterclass! 🌟";
        
        return $this->sendSimpleMessage($toNumber, $message);
    }
    
    /**
     * Send basic text message (fallback)
     */
    private function sendSimpleMessage($toNumber, $message)
    {
        // Fallback simple message sending - implement if needed
        Log::info('Simple message would be sent', [
            'to' => $toNumber,
            'message' => substr($message, 0, 100) . '...'
        ]);
        return true;
    }

    /**
     * Send image via WhatsApp
     */
    private function sendImage($toNumber, $imagePath, $caption = '')
    {
        if (!$this->apiUrl || !$this->apiKey) {
            Log::warning('MSG19 API not configured. Image not sent.', [
                'to' => $toNumber,
                'image_path' => $imagePath
            ]);
            return false;
        }

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey
                ])
                ->attach('image', file_get_contents($imagePath), basename($imagePath))
                ->post($this->apiUrl . '/send-media', [
                    'from' => $this->fromNumber,
                    'to' => '+91' . $toNumber,
                    'caption' => $caption,
                    'type' => 'image'
                ]);

            if ($response->successful()) {
                Log::info('WhatsApp image sent successfully', [
                    'to' => $toNumber,
                    'image_path' => $imagePath,
                    'message_id' => $response->json('message_id')
                ]);
                return true;
            } else {
                Log::error('Failed to send WhatsApp image', [
                    'to' => $toNumber,
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('WhatsApp image sending exception', [
                'to' => $toNumber,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Send bulk messages (for reminders)
     */
    public function sendBulkReminders($registrations, $daysBefore)
    {
        $results = [];
        
        foreach ($registrations as $registration) {
            $result = $this->sendReminder(
                $registration->whatsapp_number,
                $registration,
                $daysBefore
            );
            
            $results[] = [
                'registration_id' => $registration->registration_id,
                'phone' => $registration->whatsapp_number,
                'sent' => $result
            ];
            
            // Small delay between messages to avoid rate limiting
            usleep(200000); // 200ms delay
        }
        
        return $results;
    }

    /**
     * Verify if MSG91 API is configured
     */
    public function isConfigured()
    {
        return !empty($this->apiUrl) && !empty($this->authKey) && !empty($this->integratedNumber);
    }

    /**
     * Get MSG91 API status
     */
    public function getApiStatus()
    {
        if (!$this->isConfigured()) {
            return ['status' => 'not_configured'];
        }

        try {
            // Test with a simple API call
            $testPayload = [
                'integrated_number' => $this->integratedNumber,
                'content_type' => 'text',
                'payload' => [
                    'text' => 'Test message',
                    'to' => ['919999999999'] // Test number
                ]
            ];
            
            $response = Http::timeout(10)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'authkey' => $this->authKey
                ])
                ->post($this->apiUrl, $testPayload);

            return [
                'status' => $response->successful() ? 'active' : 'error',
                'response' => $response->json()
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'error' => $e->getMessage()
            ];
        }
    }
}